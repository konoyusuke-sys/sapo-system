<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Models\Forms;
use App\Models\FormSenderGroups;
use App\Models\FormSenders;
use App\Models\HistoryForm;

class FormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Forms::paginate(20);
        return view('form.index',compact('forms'));       
    }

    public function list(Request $request, $form_id)
    {
        $lists = $this->filteredHistoryFormsQuery($form_id, $request)->orderByDesc('id')->paginate(20)->withQueryString();
        $pref = config('custom.prefecture');
        $sender_categories = $this->sortedSenderGroupCategories();

        return view('form.list', compact('lists', 'form_id', 'pref', 'sender_categories'));
    }

    /**
     * 申込履歴CSV（16列のみ：申込日～他社借入金額）。
     */
    public function exportHistoryCsv(Request $request, $form_id)
    {
        $rows = $this->filteredHistoryFormsQuery($form_id, $request)->orderByDesc('id')->get();

        $pref = config('custom.prefecture');
        $job = config('custom.job');
        $birthYearLabels = config('lead_form.birth_year_label', []);

        $filename = 'form_history_'.$form_id.'_'.date('Ymd_His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
        ];

        $self = $this;
        $callback = function () use ($rows, $pref, $job, $birthYearLabels, $self) {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

            $headings = [
                '申込日', '名前', 'フリガナ', '生年月日', '携帯電話番号', '固定電話番号',
                'メールアドレス', 'LINE ID', '郵便番号', '自宅住所', '職業', '勤務先名',
                '勤務先電話番号', '月収', '他社借入件数', '他社借入金額',
            ];
            fputcsv($out, $headings);

            foreach ($rows as $row) {
                fputcsv($out, $self->buildHistoryCsvRow($row, $pref, $job, $birthYearLabels));
            }

            fclose($out);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    /**
     * @param  \App\Models\HistoryForm  $row
     */
    protected function buildHistoryCsvRow($row, array $pref, array $job, array $birthYearLabels): array
    {
        $by = (string) $row->birth_year;
        $yearLabel = $birthYearLabels[$by] ?? $by;
        $birthday = $yearLabel.'年'.(int) $row->birth_month.'月'.(int) $row->birth_date.'日';

        $prefName = $this->mapLabel($pref, $row->pref_id);
        $address = trim(implode(' ', array_filter([
            $prefName,
            $row->addr1,
            $row->addr2,
            $row->addr3,
        ], function ($p) {
            return $p !== null && $p !== '';
        })));

        return [
            $this->formatExportDateTimeForCsv($row->created_at),
            $row->name,
            $row->kana,
            $birthday,
            $row->mobile,
            $row->tel,
            $row->email,
            $row->line_id,
            $row->postal_code,
            $address,
            $this->mapLabel($job, $row->job_type),
            $row->company_name,
            $row->company_tel,
            $row->salary_type,
            $row->debt_count,
            $row->debt_amount,
        ];
    }

    protected function filteredHistoryFormsQuery($form_id, Request $request)
    {
        $query = HistoryForm::where('form_id', $form_id);
        $name = $request->input('name', '');
        $kana = $request->input('kana', '');
        $email = $request->input('email', '');
        $query->when($name, function ($query, $name) {
            return $query->where('name', 'like', '%'.$name.'%');
        });
        $query->when($kana, function ($query, $kana) {
            return $query->where('kana', 'like', '%'.$kana.'%');
        });
        $query->when($email, function ($query, $email) {
            return $query->where('email', 'like', '%'.$email.'%');
        });

        $dateFrom = $request->input('date_from');
        if (is_string($dateFrom) && trim($dateFrom) !== '') {
            try {
                $from = Carbon::parse($dateFrom)->startOfDay();
                $query->where('created_at', '>=', $from);
            } catch (\Throwable $e) {
                // 無効な日付は無視
            }
        }
        $dateTo = $request->input('date_to');
        if (is_string($dateTo) && trim($dateTo) !== '') {
            try {
                $to = Carbon::parse($dateTo)->endOfDay();
                $query->where('created_at', '<=', $to);
            } catch (\Throwable $e) {
                // 無効な日付は無視
            }
        }

        if ($request->filled('sent_category_id')) {
            $allowed = array_map('strval', array_keys($this->sortedSenderGroupCategories()));
            $cid = (string) $request->input('sent_category_id');
            if (in_array($cid, $allowed, true)) {
                $query->where('sent_category_id', (int) $cid);
            }
        }

        return $query;
    }

    protected function mapLabel($map, $key)
    {
        if ($key === null || $key === '') {
            return '';
        }
        if (! is_array($map)) {
            return '';
        }

        if (array_key_exists($key, $map)) {
            return $map[$key];
        }
        $stringKey = (string) $key;
        if (array_key_exists($stringKey, $map)) {
            return $map[$stringKey];
        }

        return '';
    }

    /**
     * @param  mixed  $value
     */
    protected function formatExportDateTime($value): string
    {
        if ($value === null || $value === '') {
            return '';
        }
        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y-m-d H:i:s');
        }

        return (string) $value;
    }

    /**
     * Excel で日時が数値扱いになり列幅不足で ### になるのを避けるため、和文の固定文字列として出力する。
     *
     * @param  mixed  $value
     */
    protected function formatExportDateTimeForCsv($value): string
    {
        if ($value === null || $value === '') {
            return '';
        }
        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y年m月d日 H時i分s秒');
        }
        $str = trim((string) $value);
        if ($str === '') {
            return '';
        }
        try {
            return Carbon::parse($str)->timezone(config('app.timezone'))->format('Y年m月d日 H時i分s秒');
        } catch (\Throwable $e) {
            return $str;
        }
    }

    /**
     * カテゴリID順に並べた通知グループマスタ（プルダウン表示の乱れ防止）。
     */
    protected function sortedSenderGroupCategories(): array
    {
        $cat = config('custom.SenderGroupCategory', []);
        if (! is_array($cat)) {
            return [];
        }
        uksort($cat, function ($a, $b) {
            return (int) $a <=> (int) $b;
        });

        return $cat;
    }

    /**
     * 指定フォームで未使用のカテゴリのみ（新規グループ追加用）。
     */
    protected function categoriesAvailableForNewGroup(int $form_id): array
    {
        $all = $this->sortedSenderGroupCategories();
        $used = FormSenderGroups::where('form_id', $form_id)
            ->pluck('category_id')
            ->filter(function ($id) {
                return $id !== null && $id !== '';
            })
            ->map(function ($id) {
                return (int) $id;
            })
            ->all();
        $usedSet = array_fill_keys($used, true);
        $out = [];
        foreach ($all as $id => $label) {
            if (! isset($usedSet[(int) $id])) {
                $out[$id] = $label;
            }
        }

        return $out;
    }

    public function detail($form_id)
    {
        $form = Forms::where('id',$form_id)->first();
        // $status = $this->getArrayStatus();
        $status = config('custom.status');
        return view('form.detail',compact('form','status'));       
    }

    public function update_form(Request $request)
    {
        $data = $request->all();
        $rule  =  array(
            'status'       => 'required',
            'name'       => 'required',
            'from_name'       => 'required',
            'from_email'       => 'required|email',
            'mail_title'       => 'required',
            'mail_body'       => 'required',
        ) ;
        
        $validator = Validator::make($data,$rule);
        
        if ($validator->fails()) {
            $this->flashMessage('error', '入力内容に誤りがあります。', 'error');
            return redirect()->back()->withErrors($validator);
        }

        $form = Forms::where('id',$data['id'])->first();
        $form->slug = $data['slug'];
        $form->name = $data['name'];
        $form->comment = $data['comment'];
        $form->mail_title = $data['mail_title'];
        $form->mail_body = $data['mail_body'];
        $form->from_name = $data['from_name'];
        $form->from_email = $data['from_email'];
        $form->memo = $data['memo'];
        $form->status = $data['status'];
        $form->save();
        
        $this->flashMessage('check', '内容を登録しました。', 'success');
        return redirect()->back();
        

    }

    public function group_index($form_id)
    {
        $groups = FormSenderGroups::where('form_id', $form_id)->orderBy('category_id', 'asc')->get();
        $group_category = $this->sortedSenderGroupCategories();

        return view('form.group.index', compact('groups', 'form_id', 'group_category'));
    }

    public function group_detail($id)
    {
        
        $group = FormSenderGroups::find($id);
        $form_id = $group->form_id;
        $group_category = $this->sortedSenderGroupCategories();
        $status = config('custom.status');
        $expectation = config('custom.expectation');
        $job = config('custom.job');
        $pref = config('custom.prefecture');
        $mode = 'update';
        return view('form.group.detail',compact('group','group_category','status','form_id','mode','expectation','job','pref'));       
    }

    public function group_add($id)
    {
        $form_id = $id;
        $group = new FormSenderGroups();
        $group_category = $this->sortedSenderGroupCategories();
        $categoriesForAdd = $this->categoriesAvailableForNewGroup((int) $form_id);
        $status = config('custom.status');
        $expectation = config('custom.expectation');
        $job = config('custom.job');
        $pref = config('custom.prefecture');
        $mode = 'add';

        return view('form.group.detail', compact('group', 'group_category', 'categoriesForAdd', 'status', 'form_id', 'mode', 'expectation', 'job', 'pref'));
    }

    public function update_group(Request $request)
    {
        $data = $request->all();
        
        if ($data['mode'] == 'update') {
            $rule  =  array(
                'status'       => 'required',
                'name'       => 'required',
                'from_name'       => 'required',
                'from_email'       => 'required|email',
                'mail_title'       => 'required',
                'mail_body'       => 'required',
            ) ;
        }else{
            $rule  =  array(
                'category_id'       => [
                    'required',
                    Rule::unique('dtb_form_sender_group', 'category_id')->where(function ($query) use ($data) {
                        return $query->where('form_id', (int) ($data['form_id'] ?? 0));
                    }),
                ],
                'status'       => 'required',
                'name'       => 'required',
                'from_name'       => 'required',
                'from_email'       => 'required|email',
                'mail_title'       => 'required',
                'mail_body'       => 'required',
            ) ;
        }
        
        
        $messages = [
            'category_id.unique' => 'このカテゴリには既にグループが登録されています。未使用のカテゴリ（親、A管理・A群～O管理・O群）を選択してください。',
        ];

        $validator = Validator::make($data, $rule, $messages);
        
        if ($validator->fails()) {
            $this->flashMessage('error', '入力内容に誤りがあります。', 'error');
            return redirect()->back()->withErrors($validator);
        }

        if ($data['mode'] == 'update') {

            $form = FormSenderGroups::where('id',$data['id'])->first();
            $form->name = $data['name'];
            $form->form_id = $data['form_id'];
            $form->comment = $data['comment'] ?? null;
            $form->mail_title = $data['mail_title'];
            $form->mail_body = $data['mail_body'];
            $form->from_name = $data['from_name'];
            $form->from_email = $data['from_email'];
            $form->status = $data['status'];
            $form->except_year = isset($data['except_year']) ? $data['except_year'] :'';
            $form->except_expectation =  isset($data['except_expectation']) ? json_encode($data['except_expectation']):'';
            $form->except_job = isset($data['except_job']) ? json_encode($data['except_job']):'';
            $form->except_pref = isset($data['except_pref']) ? json_encode($data['except_pref']):'';
            $form->save();
            $this->flashMessage('check', '内容を登録しました。', 'success');
            return redirect()->back();

        }else{

            $form = new FormSenderGroups();
            $form->name = $data['name'];
            $form->form_id = $data['form_id'];
            $form->category_id = $data['category_id'];
            $form->comment = $data['comment'] ?? null;
            $form->mail_title = $data['mail_title'];
            $form->mail_body = $data['mail_body'];
            $form->from_name = $data['from_name'];
            $form->from_email = $data['from_email'];
            $form->status = $data['status'];
            $form->save();
            $this->flashMessage('check', '内容を登録しました。', 'success');
            return redirect()->route('form.group.index',[$data['form_id']]);

        }
        

    }

    public function delete_group(Request $request){
        $data = $request->all();
        $id = $data['id'];
        FormSenderGroups::where('id',$data['id'])->delete();
        return response()->json(['message' => '削除しました。']);
    }

    public function sender_index($form_id,$group_id)
    {
        
        $senders = FormSenders::where('group_id',$group_id)->get();
        $group = FormSenderGroups::find($group_id);
        $group_category = $this->sortedSenderGroupCategories();
        return view('form.sender.index',compact('senders', 'group','form_id','group_category','group_id'));       
    }

    public function sender_detail($sender_id)
    {
        
        $sender = FormSenders::find($sender_id);
        $form_id = $sender->form_id;
        $group_id = $sender->group_id;
        $group_category = $this->sortedSenderGroupCategories();
        $status = config('custom.status');
        $mode = 'update';
        return view('form.sender.detail',compact('sender','group_category','status','form_id','mode','group_id'));       
    }

    public function sender_add($group_id)
    {
        
        $form_id = FormSenderGroups::find($group_id)->form_id;
        $sender = new FormSenders();
        $group_category = $this->sortedSenderGroupCategories();
        $status = config('custom.status');
        $mode = 'add';
        return view('form.sender.detail',compact('sender','group_category','status','form_id','mode','group_id'));       
    }

    public function update_sender(Request $request)
    {
        $data = $request->all();
        
        $rule  =  array(
            
            'status'       => 'required',
            'email'       => 'required|email',
        ) ;
        
        $validator = Validator::make($data,$rule);
        
        if ($validator->fails()) {
            $this->flashMessage('error', '入力内容に誤りがあります。', 'error');
            return redirect()->back()->withErrors($validator);
        }

        if ($data['mode'] == 'update') {

            $form = FormSenders::find($data['id']);
            $form->email = $data['email'];
            $form->status = $data['status'];
            $form->save();
            $this->flashMessage('check', '内容を登録しました。', 'success');
            return redirect()->back();

        }else{

            $sender = new FormSenders();
            $sender->group_id = $data['group_id'];
            $sender->form_id = $data['form_id'];
            $sender->email = $data['email'];
            $sender->status = $data['status'];
            
            $sender->save();
            $this->flashMessage('check', '内容を登録しました。', 'success');
            return redirect()->route('form.sender.index',[$data['form_id'],$data['group_id']]);

        }
        

    }

    public function delete_sender(Request $request){
        $data = $request->all();
        $id = $data['id'];
        FormSenders::where('id',$data['id'])->delete();
        return response()->json(['message' => '削除しました。']);
    }



    public function getArrayStatus() {
		$return = array();
		$return[1]        = '有効';
		$return[0]        = '無効';
		return $return;
	}

    public function getArraySenderGroupCategory()
    {
        return config('custom.SenderGroupCategory', []);
    }

}

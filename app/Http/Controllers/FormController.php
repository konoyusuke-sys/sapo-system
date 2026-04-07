<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
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
        $lists = $this->filteredHistoryFormsQuery($form_id, $request)->orderByDesc('id')->paginate(20);
        $pref = config('custom.prefecture');

        return view('form.list', compact('lists', 'form_id', 'pref'));
    }

    /**
     * 申込履歴をCSVでダウンロード（一覧と同一の検索条件、登録時の全項目＋コードの表示名）。
     */
    public function exportHistoryCsv(Request $request, $form_id)
    {
        $rows = $this->filteredHistoryFormsQuery($form_id, $request)->orderByDesc('id')->get();

        $pref = config('custom.prefecture');
        $job = config('custom.job');
        $expect = config('custom.expectation');
        $connect = config('custom.connect');
        $statusLabels = config('custom.status');
        $category = config('custom.SenderGroupCategory');
        $sexLabels = config('custom.sex');

        $filename = 'form_history_'.$form_id.'_'.date('Ymd_His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
        ];

        $self = $this;
        $callback = function () use ($rows, $pref, $job, $expect, $connect, $statusLabels, $category, $sexLabels, $self) {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

            $headings = [
                'ID', 'フォームID', '登録日時', '氏名', 'フリガナ', 'メールアドレス', 'LINE ID',
                '勤務先名', '勤務先電話番号', '性別(値)', '性別', '生年', '生月', '生日',
                '郵便番号', '都道府県ID', '都道府県', '市区町村', '番地等', '建物名等',
                '携帯電話', '固定電話', 'ご要望・コメント',
                '月収(入力値)', '業種(自由項目2)', '職業ID', '職業', '所得種別(自由項目4)',
                '他者借入件数', '他者借入金額', '借入希望金額ID', '借入希望金額',
                '希望連絡時間帯ID', '希望連絡時間帯', '管理メモ',
                'IPアドレス', 'ホスト名', 'User-Agent',
                'ステータス(値)', 'ステータス', '送信カテゴリID', '送信カテゴリ',
                '削除フラグ', '最終更新日時', '更新日時',
            ];
            fputcsv($out, $headings);

            foreach ($rows as $row) {
                $createdAt = $self->formatExportDateTime($row->created_at);
                $updatedAt = $self->formatExportDateTime($row->updated_at);

                fputcsv($out, [
                    $row->id,
                    $row->form_id,
                    $createdAt,
                    $row->name,
                    $row->kana,
                    $row->email,
                    $row->line_id,
                    $row->company_name,
                    $row->company_tel,
                    $row->sex,
                    $self->mapLabel($sexLabels, $row->sex),
                    $row->birth_year,
                    $row->birth_month,
                    $row->birth_date,
                    $row->postal_code,
                    $row->pref_id,
                    $self->mapLabel($pref, $row->pref_id),
                    $row->addr1,
                    $row->addr2,
                    $row->addr3,
                    $row->mobile,
                    $row->tel,
                    $row->comment,
                    $row->salary_type,
                    $row->industry_type,
                    $row->job_type,
                    $self->mapLabel($job, $row->job_type),
                    $row->income_type,
                    $row->debt_count,
                    $row->debt_amount,
                    $row->expectation_amount,
                    $self->mapLabel($expect, $row->expectation_amount),
                    $row->connect_hour_type,
                    $self->mapLabel($connect, $row->connect_hour_type),
                    $row->memo,
                    $row->user_ip,
                    $row->user_host,
                    $row->user_agent,
                    $row->status,
                    $self->mapLabel($statusLabels, $row->status),
                    $row->sent_category_id,
                    $self->mapLabel($category, $row->sent_category_id),
                    $row->del_flg,
                    $row->last_update_date,
                    $updatedAt,
                ]);
            }

            fclose($out);
        };

        return new StreamedResponse($callback, 200, $headers);
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
        $groups = FormSenderGroups::orderBy('category_id','asc')->get();
        $group_category = config('custom.SenderGroupCategory');
        return view('form.group.index',compact('groups','form_id','group_category'));       
    }

    public function group_detail($id)
    {
        
        $group = FormSenderGroups::find($id);
        $form_id = $group->form_id;
        $group_category = config('custom.SenderGroupCategory');
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
        $group_category = config('custom.SenderGroupCategory');
        $status = config('custom.status');
        $expectation = config('custom.expectation');
        $job = config('custom.job');
        $pref = config('custom.prefecture');
        $mode = 'add';
        return view('form.group.detail',compact('group','group_category','status','form_id','mode','expectation','job','pref'));       
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
                'category_id'       => 'required',
                'status'       => 'required',
                'name'       => 'required',
                'from_name'       => 'required',
                'from_email'       => 'required|email',
                'mail_title'       => 'required',
                'mail_body'       => 'required',
            ) ;
        }
        
        
        $validator = Validator::make($data,$rule);
        
        if ($validator->fails()) {
            $this->flashMessage('error', '入力内容に誤りがあります。', 'error');
            return redirect()->back()->withErrors($validator);
        }

        if ($data['mode'] == 'update') {

            $form = FormSenderGroups::where('id',$data['id'])->first();
            $form->name = $data['name'];
            $form->form_id = $data['form_id'];
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
            $form->comment = $data['comment'];
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
        $group_category = config('custom.SenderGroupCategory');
        return view('form.sender.index',compact('senders', 'group','form_id','group_category','group_id'));       
    }

    public function sender_detail($sender_id)
    {
        
        $sender = FormSenders::find($sender_id);
        $form_id = $sender->form_id;
        $group_id = $sender->group_id;
        $group_category = config('custom.SenderGroupCategory');
        $status = config('custom.status');
        $mode = 'update';
        return view('form.sender.detail',compact('sender','group_category','status','form_id','mode','group_id'));       
    }

    public function sender_add($group_id)
    {
        
        $form_id = FormSenderGroups::find($group_id)->form_id;
        $sender = new FormSenders();
        $group_category = config('custom.SenderGroupCategory');
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
        $return = [];
        // $return[0] = "親";
        $return[1] = "A管理";
        $return[2] = "A群";
        $return[3] = "B管理";
        $return[4] = "B群";
        $return[5] = "C管理";
        $return[6] = "C群";
        $return[7] = "D管理";
        $return[8] = "D群";
        $return[9] = "E管理";
        $return[10] = "E群";
        $return[11] = "F管理";
        $return[12] = "F群";
        $return[13] = "G管理";
        $return[14] = "G群";
        $return[15] = "H管理";
        $return[16] = "H群";
        $return[17] = "I管理";
        $return[18] = "I群";
        $return[19] = "J管理";
        $return[20] = "J群";
        $return[21] = "K管理";
        $return[22] = "K群";
        $return[23] = "L管理";
        $return[24] = "L群";
        $return[25] = "M管理";
        $return[26] = "M群";
        $return[27] = "N管理";
        $return[28] = "N群";
        $return[29] = "O管理";
        $return[30] = "O群";
        $return[31] = "P管理";
        $return[32] = "P群";
        $return[33] = "Q管理";
        $return[34] = "Q群";
        $return[35] = "R管理";
        $return[36] = "R群";
        $return[37] = "S管理";
        $return[38] = "S群";
        $return[39] = "T管理";
        $return[40] = "T群";
        $return[41] = "U管理";
        $return[42] = "U群";
        $return[43] = "V管理";
        $return[44] = "V群";
        $return[45] = "W管理";
        $return[46] = "W群";
        $return[47] = "X管理";
        $return[48] = "X群";
        $return[49] = "Y管理";
        $return[50] = "Y群";
        $return[51] = "Z管理";
        $return[52] = "Z群";

        return $return;
    }

}

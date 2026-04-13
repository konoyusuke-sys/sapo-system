<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\HistoryForm;
use App\Models\Forms;
use App\Models\FormSenderGroups;
use App\Models\FormSenders;

use App\Libraries\JPHPMailer;


use App\Mail\ReplyEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return view('home');       
    }
    public function form(Request $request)
    {
        $restore = null;
        if ($request->query('back') === '1' && session()->has('form_lead_pending')) {
            $restore = session('form_lead_pending');
        }

        return view('form', ['restore' => $restore]);
    }

    public function display(LeadFormRequest $request)
    {
        $validated = $request->validated();
        unset($validated['個人情報保護方針']);

        $token = Str::random(40);
        session([
            'form_lead_pending' => $validated,
            'form_lead_token' => $token,
        ]);

        return view('display', [
            'lead' => $validated,
            'confirmToken' => $token,
        ]);
    }
    public function disclaimer()
    {
        return view('disclaimer');       
    }
    public function information()
    {
        return view('information');       
    }
    public function policy()
    {
        return view('policy');       
    }
    public function post_form(Request $request)
    {
        $request->validate([
            'confirm_token' => 'required|string',
        ]);

        if (
            $request->input('confirm_token') !== session('form_lead_token')
            || ! is_array(session('form_lead_pending'))
        ) {
            return redirect()
                ->route('form_index')
                ->withErrors(['session' => '確認画面の有効期限が切れたか、既に送信済みです。お手数ですが最初から入力してください。']);
        }

        $data = session('form_lead_pending');
        session()->forget(['form_lead_token', 'form_lead_pending']);
        
        $last = HistoryForm::latest()->first();
        $lastSentCategoryId = $last ? (int) $last->sent_category_id : 0;
        $target = $lastSentCategoryId + 1;
        $maxCat = (int) config('custom.sender_category_max_id', 30);
        if ($target > $maxCat) {
            $target = 1;
        }

        $senders = FormSenderGroups::leftJoin('dtb_form_sender', 'dtb_form_sender_group.id', '=', 'dtb_form_sender.group_id')
                     ->select('dtb_form_sender_group.*', 'dtb_form_sender.email')
                     ->where('dtb_form_sender_group.status', 1) 
                     ->where('dtb_form_sender.status', 1) 
                     ->orderBy('dtb_form_sender_group.category_id', 'asc')
                     ->get();
        $sender_arr = $senders->toArray();
        $sent_category_id = $this->findnearestValue($sender_arr,$target,$data);

        
        
        $user_host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
        $user_agent = htmlspecialchars(
            $_SERVER["HTTP_USER_AGENT"],
            ENT_QUOTES
        );

        $form = new HistoryForm();
        $form->form_id = 1;
        $form->name = $data['name_sei'].$data['name_mei'];
        $form->kana = $data['name_kana'];
        $form->email = $data['your_mail'];
        $form->line_id = $data['your_line'] ?? '';
        $form->company_name = $data['your_company'];
        $form->company_tel = $data['your_company_tel'];
        $form->birth_year = $data['birth_year'];
        $form->birth_month = $data['birth_month'];
        $form->birth_date = $data['birth_date'];
        $form->postal_code = $data['your_postnum'];
        $form->pref_id = $data['pref_id'];
        $form->addr1 = $data['addr1'];
        $form->addr2 = $data['addr2'];
        $form->addr3 = $data['addr3'] ?? '';
        $form->mobile = $data['your_mobile'];
        $form->tel = $data['your_tel'] ?? '';
        $form->comment = $data['your_message'] ?? '';
        $form->salary_type = $data['income'];
        $form->job_type = $data['job'];
        $form->debt_count = $data['your_borrowing_num'];
        $form->debt_amount = $data['your_borrowing_num2'];
        $form->expectation_amount = $data['desired_borrowing'];
        $form->connect_hour_type = $data['time'];
        $form->user_ip = $_SERVER["REMOTE_ADDR"];
        $form->user_host = $user_host;
        $form->user_agent = $user_agent;
        $form->connect_hour_type = $data['time'];
        $form->status = 1;
        $form->sent_category_id = $sent_category_id;
        $form->save();

        $pref = config('custom.prefecture');
        $job = config('custom.job');
        $connect = config('custom.connect');
        $expect = config('custom.expectation');

        $placeholders = [
            '%%name%%' => $data['name_sei'].$data['name_mei'],
            '%%email%%' => $data['your_mail'],
            '%%kana%%' => $data['name_kana'],
            '%%line_id%%' => $data['your_line'] ?? '',
            '%%company_name%%' => $data['your_company'],
            '%%company_tel%%' => $data['your_company_tel'],
            '%%birthday%%' => $data['birth_year'].'年'.$data['birth_month'].'月'.$data['birth_date'].'日',
            '%%postal_code%%' => $data['your_postnum'],
            '%%pref_id%%' => $pref[$data['pref_id']],
            '%%addr1%%' => $data['addr1'],
            '%%addr2%%' => $data['addr2'],
            '%%addr3%%' => $data['addr3'] ?? '',
            '%%tel%%' => $data['your_tel'] ?? '',
            '%%mobile%%' => $data['your_mobile'],
            '%%job_type%%' => $job[$data['job']],
            '%%income%%' => $data['income'],
            '%%debt_count%%' => $data['your_borrowing_num'],
            '%%debt_amount%%' => $data['your_borrowing_num2'],
            '%%expectation_amount%%' => $expect[$data['desired_borrowing']] ?? '',
            '%%connect_hour_type%%' => $connect[$data['time']],
            '%%comment%%' => $data['your_message'] ?? '',
            '%%user_ip%%' => $_SERVER["REMOTE_ADDR"],
            '%%user_host%%' => $user_host,
            '%%user_agent%%' => $user_agent,
            '%%created_at%%' => date('Y-m-d')
        ];

        $dtb_form = Forms::where('id', 1)->first();
        if ($dtb_form) {
            $mail_body = $dtb_form->mail_body;
            $message = str_replace(array_keys($placeholders), array_values($placeholders), $mail_body);
            $mail_data['message'] = nl2br($message);
            $fromEmail = filter_var(trim((string) $dtb_form->from_email), FILTER_VALIDATE_EMAIL)
                ? trim($dtb_form->from_email)
                : config('mail.from.address');
            $mail_data['from_email'] = $fromEmail ?: config('mail.from.address');
            $mail_data['from_name'] = $dtb_form->from_name ?: config('mail.from.name');
            $mail_data['subject'] = $dtb_form->mail_title;

            try {
                Mail::to($data['your_mail'])->send(new ReplyEmail($mail_data));
            } catch (\Throwable $e) {
                Log::error('Lead form user confirmation mail failed', [
                    'to' => $data['your_mail'],
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return redirect('/thanks');        
    }
    
    public function thanks(){
        return view('thanks');
    }

    public function mail_schedule(){
        $lists = HistoryForm::where('form_id',1)->where('status',1)->get();
        $lists = $lists->toArray();
        // dd($lists);
        // die();
        foreach ($lists as $key => $list) {
            $this->send_mail($list);
        }
    }

    public function send_mail($data){
        // dd($data);
        // die();

        $pref = config('custom.prefecture');
        $job = config('custom.job');
        $connect = config('custom.connect');
        $expectation = config('custom.expectation');

        $placeholders = [
            '%%name%%' => $data['name'],
            '%%email%%' => $data['email'],
            '%%kana%%' => $data['kana'],
            '%%line_id%%' => $data['line_id'],
            '%%company_name%%' => $data['company_name'],
            '%%company_tel%%' => $data['company_tel'],
            '%%birthday%%' => $data['birth_year'].'年'.$data['birth_month'].'月'.$data['birth_date'].'日',
            '%%pref_id%%' => $pref[$data['pref_id']],
            '%%postal_code%%' => $data['postal_code'],
            '%%addr1%%' => $data['addr1'],
            '%%addr2%%' => $data['addr2'],
            '%%addr3%%' => $data['addr3'],
            '%%tel%%' => $data['tel'],
            '%%mobile%%' => $data['mobile'],
            '%%job_type%%' => $job[$data['job_type']],
            '%%income%%' => $data['salary_type'],
            '%%debt_count%%' => $data['debt_count'],
            '%%debt_amount%%' => $data['debt_amount'],
            '%%expectation_amount%%' => $expectation[$data['expectation_amount']],
            '%%connect_hour_type%%' => $connect[$data['connect_hour_type']],
            '%%comment%%' => $data['comment'],
            '%%user_ip%%' => $data["user_ip"],
            '%%user_host%%' => $data["user_host"],
            '%%user_agent%%' => $data["user_agent"],
            '%%created_at%%' => date('Y-m-d H:i:s',strtotime($data["created_at"]))
        ];
        if ($data['sent_category_id'] !== 0 ) {
            $categories = [0, $data['sent_category_id']];
        }else{
            $categories = [0];
        }
        
        $senders = FormSenderGroups::leftJoin('dtb_form_sender', 'dtb_form_sender_group.id', '=', 'dtb_form_sender.group_id')
                     ->select('dtb_form_sender_group.*', 'dtb_form_sender.email')
                     ->where('dtb_form_sender_group.status', 1) 
                     ->where('dtb_form_sender.status', 1) 
                     ->whereIn('dtb_form_sender_group.category_id', $categories) 
                     ->orderBy('dtb_form_sender_group.category_id', 'asc')
                     ->get();
        // dd($senders);
        // die();
        foreach ($senders as $key => $sender) {

            

            $mail_body = $sender->mail_body;
            $message = str_replace(array_keys($placeholders), array_values($placeholders), $mail_body);
            $mail_data['message'] = nl2br($message);
            $fromEmail = filter_var(trim((string) $sender->from_email), FILTER_VALIDATE_EMAIL)
                ? trim($sender->from_email)
                : config('mail.from.address');
            $mail_data['from_email'] = $fromEmail ?: config('mail.from.address');
            $mail_data['from_name'] = $sender->from_name ?: config('mail.from.name');
            $mail_data['subject'] = $sender->mail_title;
            
            try {
                Mail::to($sender->email)->send(new ReplyEmail($mail_data));
                $form = HistoryForm::find($data['id']);
                if ($form) {
                    $form->status = 0;
                    $form->save();
                }
            } catch (\Throwable $e) {
                Log::error('Scheduled notification mail failed', [
                    'to' => $sender->email,
                    'group_id' => $sender->group_id ?? null,
                    'error' => $e->getMessage(),
                ]);
            }
            

        }

    }

    public function findnearestValue($sender_arr, $target, $data){

        $greaterValues = [];
        $smallerValues = [];

        foreach ($sender_arr as $key => $value) {
            $send_flg = true;
            $except_year = $value['except_year'];
            $except_expectation = $value['except_expectation'] !=='' ? json_decode($value['except_expectation']):[];
            $except_job = $value['except_job'] !=='' ? json_decode($value['except_job']):[];
            $except_pref = $value['except_pref'] !=='' ? json_decode($value['except_pref']):[];

            if($except_year !==''){
                if($except_year < $data['birth_year'] ){
                    $send_flg = false;
                }
            }
            if(!empty($except_expectation)){
                if(in_array($data['desired_borrowing'],$except_expectation)){
                    $send_flg = false;
                }
            }
            if(!empty($except_job)){
                if(in_array($data['job'],$except_job)){
                    $send_flg = false;
                }
            }
            if(!empty($except_pref)){
                if(in_array($data['pref_id'],$except_pref)){
                    $send_flg = false;
                }
            }
            

            if ($value['category_id'] >= $target && $send_flg) {
                $greaterValues[] = $value['category_id']; 
            }elseif($value['category_id'] < $target && $send_flg){
                if ($value['category_id'] != 0) {
                    $smallerValues[] = $value['category_id'];
                }
                
            }
        }
        
        if (!empty($greaterValues)) {
            $smallest = min($greaterValues);
           
        }elseif(!empty($smallerValues)){
            $smallest = min($smallerValues);
            
        }else{
            $smallest = 0;
        }
        
        return $smallest;
    }

    public function test(){
        $last = HistoryForm::latest()->first();
        $lastSentCategoryId = $last ? (int) $last->sent_category_id : 0;
        $target = $lastSentCategoryId + 2;
        $maxCat = (int) config('custom.sender_category_max_id', 30);
        if ($target > $maxCat) {
            $target = 1;
        }

        $senders = FormSenderGroups::leftJoin('dtb_form_sender', 'dtb_form_sender_group.id', '=', 'dtb_form_sender.group_id')
                     ->select('dtb_form_sender_group.*', 'dtb_form_sender.email')
                     ->where('dtb_form_sender_group.status', 1) 
                     ->where('dtb_form_sender.status', 1) 
                     ->orderBy('dtb_form_sender_group.category_id', 'asc')
                     ->get();
        $sender_arr = $senders->toArray();
        dd($target);
    }


}

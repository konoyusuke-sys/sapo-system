<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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

    public function list($form_id)
    {
        $request = Request()->all();
        $query = HistoryForm::where('form_id',$form_id);
        $request['name'] = isset($request['name'])?$request['name']:'';
        $request['kana'] = isset($request['kana'])?$request['kana']:'';
        $request['email'] = isset($request['email'])?$request['email']:'';
        $query->when($request['name'], function ($query, $name) {
            return $query->where('name', 'like', "%{$name}%");
        });
        $query->when($request['kana'], function ($query, $kana) {
            return $query->where('kana', 'like', "%{$kana}%");
        });
        $query->when($request['email'], function ($query, $email) {
            return $query->where('email', 'like', "%{$email}%");
        });
        $lists = $query->paginate(20);
        $pref = config('custom.prefecture');
        
        return view('form.list',compact('lists','form_id','pref'));       
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

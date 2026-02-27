@extends('layouts.AdminLTE.index')

@section('icon_page', 'edit')

@section('title', 'フォーム ')
@section('sub_title', 'Form ')

@section('menu_pagina')	

@section('content')
<div class="nav-tabs-custom box-solid-header mb20">
	<ul class="nav nav-tabs">
		<li class="active"><a href="">基本設定</a></li>
		<li class="noactive"><a  href="{{ route('form.group.index',[$form->id]) }}">通知先設定</a></li>
		
	</ul>
</div>
<form name="form1" id="form1" method="post" action="{{route('form.update')}}" class="form-horizontal">
	@csrf
	<input type="hidden" name="mode" value="confirm">
	<input type="hidden" name="id" value="{{$form->id}}">
	<input type="hidden" name="slug" value="{{$form->slug}}">

	<!-- row Start -->
	<div class="row">
		<!-- col Start -->
		<div class="col-md-8 col-lg-9">

			<!-- row Start -->
			<div class="row">
				<!-- col Start -->
				<div class="col-sm-12">
					<!-- box Start -->
					<div class="box box-solid">
						<div class="box-body">
							<div class="form-group @if($errors->has('name')) has-error @endif">
								<div class="col-sm-12 col-xs-12">
									@if($errors->has('name'))
									<span class="text-red">※ タイトルが入力されていません。</span>
									@endif
									<input type="text" name="name" value="{{$form->name}}" class="form-control input-lg" id="name" placeholder="タイトルを入力してください">
								</div>
							</div>
							
						</div>
					</div>
					<!-- box End -->
				</div>
				<!-- col End -->
			</div>
			<!-- row End -->

			<!-- row Start -->
			<div class="row">
				<!-- col Start -->
				<div class="col-sm-12">
					<!-- box Start -->
					<div class="box box-solid">
						<div class="box-body">
							<h3 class="page-header">ページ設定</h3>
							<div class="form-group">
								<label for="comment" class="col-sm-12 control-label text-start label-left">ページ上部</label>
								<div class="col-sm-12 col-xs-12">
									<textarea name="comment" rows="5" class="form-control ckeditor">{{$form->comment}}</textarea>
								</div>
							</div>
						</div>
					</div>
					<!-- box End -->
				</div>
				<!-- col End -->
			</div>
			<!-- row End -->

			<!-- row Start -->
			<div class="row">
				<div class="col-xs-12">
					<!-- box Start -->
					<div class="box box-solid">
						<!-- box-body Start -->
						<div class="box-body">
							<h3 class="page-header">メール設定（申込者向けメール）</h3>
							<!-- row Start -->
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group @if($errors->has('from_name')) has-error @endif">
										<label for="from_name" class="col-sm-2 control-label">送信者名</label>
										<div class="col-sm-10 col-xs-12">
										@if($errors->has('from_name'))
										<span class="text-red">※ 送信者名が入力されていません。</span>
										@endif
											<input type="text" name="from_name" value="{{$form->from_name}}" class="form-control" id="from_name">
										</div>
									</div>
									<div class="form-group @if($errors->has('from_email')) has-error @endif">
										<label for="from_email" class="col-sm-2 control-label">送信者メールアドレス</label>
										<div class="col-sm-10 col-xs-12">
											@if($errors->has('from_email'))
											<span class="text-red">※ 送信者メールアドレスが入力されていません。</span>
											@endif
											<input type="text" name="from_email" value="{{$form->from_email}}" class="form-control" id="from_email">
										</div>
									</div>
									<div class="form-group @if($errors->has('mail_title')) has-error @endif">
										<label for="mail_title" class="col-sm-2 control-label">メールタイトル</label>
										<div class="col-sm-10 col-xs-12">
											@if($errors->has('mail_title'))
											<span class="text-red">※ メールタイトルが入力されていません。</span>
											@endif
											<input type="text" name="mail_title" value="{{$form->mail_title}}" class="form-control" id="mail_title">
										</div>
									</div>
									<div class="form-group @if($errors->has('mail_body')) has-error @endif">
										<label for="mail_body" class="col-sm-2 control-label">メール本文</label>
										<div class="col-sm-10 col-xs-12">
											
											<div>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('name','mail_body'); return false;">氏名</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('email','mail_body'); return false;">メールアドレス</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('line_id','mail_body'); return false;">LINE ID</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('kana','mail_body'); return false;">お名前ふりがな</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('company_name','mail_body'); return false;">勤め先会社名</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('company_tel','mail_body'); return false;">勤務先電話番号</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('birthday','mail_body'); return false;">生年月日</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('postal_code','mail_body'); return false;">郵便番号</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('pref_id','mail_body'); return false;">都道府県</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('addr1','mail_body'); return false;">市区町村</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('addr2','mail_body'); return false;">番地等</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('addr3','mail_body'); return false;">建物名・部屋番号</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('mobile','mail_body'); return false;">携帯電話番号</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('tel','mail_body'); return false;">固定電話番号</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('job_type','mail_body'); return false;">職業</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('income','mail_body'); return false;">月収</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('debt_count','mail_body'); return false;">他社借入件数</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('debt_amount','mail_body'); return false;">他社借入金額</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('expectation_amount','mail_body'); return false;">希望額</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('connect_hour_type','mail_body'); return false;">希望連絡時間帯</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('comment','mail_body'); return false;">その他ご要望など</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('user_ip','mail_body'); return false;">IPアドレス</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('user_host','mail_body'); return false;">ホスト名</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('user_agent','mail_body'); return false;">エージェント名</button>
												<button class="btn btn-xs btn-default mb3" onclick="surroundHTML('created_at','mail_body'); return false;">受付日時</button>
											</div>
											@if($errors->has('mail_body'))
											<span class="text-red">※ メール本文が入力されていません。</span>
											@endif
											<textarea name="mail_body" rows="10" class="form-control" id="mail_body">{{$form->mail_body}}</textarea>
										</div>
									</div>
								</div>
							</div>
							<!-- row End -->
						</div>
						<!-- box-body End -->
					</div>
					<!-- box End -->
				</div>
			</div>
			<!-- row End -->
			<!-- row Start -->
			<div class="row">
				<!-- col Start -->
				<div class="col-sm-12">
					<!-- box Start -->
					<div class="box box-solid">
						<div class="box-body">
							<h3 class="page-header">備考欄</h3>
							<div class="form-group">
								<div class="col-sm-12 col-xs-12">
									<textarea name="memo" rows="5" class="form-control">{{$form->memo}}</textarea>
								</div>
							</div>
						</div>
					</div>
					<!-- box End -->
				</div>
				<!-- col End -->
			</div>
			<!-- row End -->

		</div>
		<!-- col End -->

		<!-- col Start -->
		<div class="col-md-4 col-lg-3">

			<!-- row Start -->
			<div class="row">
				<!-- col Start -->
				<div class="col-sm-12">
					<!-- box Start -->
					<div class="box box-solid">
						<div class="box-header">
							<h3 class="box-title">公開</h3>
						</div>
						<div class="box-body">

							<!-- row Start -->
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group @if($errors->has('status')) has-error @endif">
										<label for="status" class="col-sm-4 control-label">ステータス</label>
										<div class="col-sm-8 col-xs-12">
											@if($errors->has('status'))
											<span class="text-red">※ ステータスが入力されていません。</span>
											@endif
											<select name="status" class="form-control" id="status">
												<option value="">選択してください</option>
												@foreach($status as $key => $item)
												<option label="{{$item}}" value="{{$key}}" @if($form->status == $key) selected="selected" @endif>{{$item}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
							<!-- row End -->

						</div>
						<div class="box-footer">
							<div class="clearfix">
								<div class="pull-right">
									<div class="text-right">
										<button type="submit" name="subm" class="btn btn-primary">更新</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- box End -->
				</div>
				<!-- col End -->
			</div>
			<!-- row End -->

		</div>
		<!-- col End -->
	</div>
	<!-- row End -->

</form> 
@endsection

@push('scripts')
  <script src="{{ asset('custom/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('custom/ckeditor/ckeditor.origin.js') }}"></script>
  <script src="{{ asset('custom/ckeditor/config.js') }}"></script>
  <script src="{{ asset('custom/jquery/jquery.Caret.js') }}"></script>
@endpush
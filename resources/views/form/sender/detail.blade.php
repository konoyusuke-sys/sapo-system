@extends('layouts.AdminLTE.index')

@section('icon_page', 'edit')

@section('title', 'フォーム ')
@section('sub_title', 'Form ')

@section('menu_pagina')	

@section('content')
<div class="nav-tabs-custom box-solid-header mb20">
	<ul class="nav nav-tabs">
		<li class="noactive"><a href="{{ route('form.detail',[$form_id]) }}">基本設定</a></li>
		<li class="active"><a  href="{{ route('form.group.index',[$form_id]) }}">通知先設定</a></li>
		
	</ul>
</div>
<form name="form1" id="form1" method="post" action="{{route('form.sender.update')}}" class="form-horizontal">
	@csrf
	<input type="hidden" name="id" value="{{$sender->id}}">
	<input type="hidden" name="mode" value="{{$mode}}">
	<input type="hidden" name="form_id" value="{{$form_id}}">
	<input type="hidden" name="group_id" value="{{$group_id}}">

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
								<label for="email" class="col-sm-12 control-label text-start label-left">メールアドレス</label>
								<div class="col-sm-12 col-xs-12">
									@if($errors->has('email'))
									<span class="text-red">※ メールアドレスが入力されていません。</span>
									@endif
									<input type="email" name="email" value="{{$sender->email}}" class="form-control input-lg" id="name" placeholder="タイトルを入力してください">
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
												<option label="{{$item}}" value="{{$key}}" @if($sender->status == $key) selected="selected" @endif>{{$item}}</option>
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
		
	</div>
	<!-- row End -->

</form> 
@endsection

@push('scripts')
  
@endpush
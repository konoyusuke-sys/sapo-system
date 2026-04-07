@extends('layouts.AdminLTE.index')

@section('icon_page', 'edit')

@section('title', 'フォーム ')
@section('sub_title', 'Form ')

@section('menu_pagina')	

@section('content')
<!-- search Start -->
<div class="row">
	<div class="col-xs-12">
		<!-- box Start -->
		<div class="box box-solid">
			<form name="form1" method="get" action="{{route('form.list',[$form_id])}}" class="form-horizontal">
				@csrf
				<!-- box-body Start -->
				<div class="box-body">
					<!-- row Start -->
					<div class="row">
						<div class="col-sm-4">
							<!--{assign var="param" value="name"}-->
							<div class="form-group">
								<label for="" class="col-lg-3 col-md-12 col-md-label-left control-label">氏名</label>
								<div class="col-lg-9 col-md-12">
									<input type="text" name="name" value="{{ request()->input('name') }}" class="form-control input-sm" id="">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							
							<div class="form-group">
								<label for="" class="col-lg-3 col-md-12 col-md-label-left control-label">フリガナ</label>
								<div class="col-lg-9 col-md-12">
									<input type="text" name="kana" value="{{ request()->input('kana') }}" class="form-control input-sm" id="">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="" class="col-lg-3 col-md-12 col-md-label-left control-label">E-Mail</label>
								<div class="col-lg-9 col-md-12">
									<input type="text" name="email" value="{{ request()->input('email') }}" class="form-control input-sm" id="">
								</div>
							</div>
						</div>
					</div>
					<!-- row End -->

					<div class="collapse mt10<!--{if $arrForm.s}--> in<!--{/if}-->" id="collapseExample">

					

					</div>
				</div>
				<!-- box-body End -->
				<div class="box-footer text clearfix">
					
					<div class="pull-right text-right">
						<a href="{{route('form.list',[$form_id])}}" class="btn btn-sm btn-default">条件リセット</a>
						<button type="submit" class="btn btn-sm btn-primary">検索</button>
					</div>
				</div>
			</form>
		</div>
		<!-- box End -->
	</div>
</div>
<!-- search End -->

	<!-- list Start -->
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-solid">
				<div class="box-header">
					<div class="box-tools clearfix">
						<div class="pull-left pt3">
							<span class="label label-info">該当件数</span> {{$lists->total()}} 件
						</div>
						<div class="pull-left">
							<a href="{{ route('form.list.export', ['form_id' => $form_id] + request()->only(['name', 'kana', 'email'])) }}" class="btn btn-sm btn-success" style="margin-left:8px;">
								<i class="fa fa-download"></i> CSVダウンロード（全件・検索条件適用）
							</a>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-height-sm v-middle">
						<tbody>
							<tr class="table-head bg-gray">
								<th class="text-center" width="10%">受付日時</th>
								<th class="text-center" width="8%">氏名</th>
								<th class="text-center">E-Mail</th>
								<th class="text-center" width="8%">会社名</th>
								<th class="text-center">住所</th>
								<th class="text-center" width="10%">TEL</th>
								<th>本文</th>
							</tr>
							@foreach($lists as $key => $val)
							<tr>
								<td class="text-center">{{date('Y/m/d H:i',strtotime($val->created_at))}}</td>
								<td class="text-center">{{$val->name}}</td>
								<td class="text-center">{{$val->email}}</td>
								<td class="text-center">{{$val->company_name}}</td>
								<td class="text-center">{{$pref[$val->pref_id]}}{{$val->addr1}}{{$val->addr2}}{{$val->addr3}}</td>
								<td class="text-center">{{$val->tel}}</td>
								<td>{{$val->comment}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>
			</div>
			<div class="col-md-12 text-center">
				<nav>
					{{$lists->links()}}
				</nav>
			</div>
		</div>
	</div>
	<!-- list End -->

@endsection
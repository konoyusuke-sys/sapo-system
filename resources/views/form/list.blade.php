@extends('layouts.AdminLTE.index')

@section('icon_page', 'edit')

@section('title', 'フォーム ')
@section('sub_title', 'Form ')

@section('menu_pagina')	

@section('content')
<div class="nav-tabs-custom box-solid-header mb20">
	<ul class="nav nav-tabs">
		<li class="noactive"><a href="{{ route('form.index') }}">フォーム一覧</a></li>
		<li class="noactive"><a href="{{ route('form.detail',[$form_id]) }}">基本設定</a></li>
		<li class="noactive"><a href="{{ route('form.group.index',[$form_id]) }}">通知先設定</a></li>
		<li class="active"><a href="#">登録リスト</a></li>
	</ul>
</div>
<!-- search Start -->
<div class="row">
	<div class="col-xs-12">
		<div class="box box-solid">
			<form name="form1" method="get" action="{{ route('form.list',[$form_id]) }}" class="form-horizontal">
				<div class="box-body">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-lg-3 col-md-12 col-md-label-left control-label">氏名</label>
								<div class="col-lg-9 col-md-12">
									<input type="text" name="name" value="{{ request('name') }}" class="form-control input-sm" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-lg-3 col-md-12 col-md-label-left control-label">フリガナ</label>
								<div class="col-lg-9 col-md-12">
									<input type="text" name="kana" value="{{ request('kana') }}" class="form-control input-sm" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-lg-3 col-md-12 col-md-label-left control-label">E-Mail</label>
								<div class="col-lg-9 col-md-12">
									<input type="text" name="email" value="{{ request('email') }}" class="form-control input-sm" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-lg-3 col-md-12 col-md-label-left control-label">期間（From）</label>
								<div class="col-lg-9 col-md-12">
									<input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control input-sm">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-lg-3 col-md-12 col-md-label-left control-label">期間（To）</label>
								<div class="col-lg-9 col-md-12">
									<input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control input-sm">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-lg-3 col-md-12 col-md-label-left control-label">通知先</label>
								<div class="col-lg-9 col-md-12">
									<select name="sent_category_id" class="form-control input-sm">
										<option value="">すべて</option>
										@foreach($sender_categories as $cid => $clabel)
										<option value="{{ $cid }}" @if((string) request('sent_category_id') === (string) $cid) selected @endif>{{ $clabel }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer clearfix">
					<div class="pull-left pt5">
						<span class="label label-info">該当件数</span> {{ $lists->total() }} 件
					</div>
					<div class="pull-right text-right">
						<a href="{{ route('form.list.export', ['form_id' => $form_id] + request()->only(['name', 'kana', 'email', 'date_from', 'date_to', 'sent_category_id'])) }}" class="btn btn-sm btn-success">
							<i class="fa fa-download"></i> CSVエクスポート
						</a>
						<a href="{{ route('form.list',[$form_id]) }}" class="btn btn-sm btn-default">条件リセット</a>
						<button type="submit" class="btn btn-sm btn-primary">検索</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- search End -->

	<div class="row">
		<div class="col-sm-12">
			<div class="box box-solid">
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
								<td class="text-center">{{ date('Y/m/d H:i', strtotime($val->created_at)) }}</td>
								<td class="text-center">{{ $val->name }}</td>
								<td class="text-center">{{ $val->email }}</td>
								<td class="text-center">{{ $val->company_name }}</td>
								<td class="text-center">{{ $pref[$val->pref_id] ?? '' }}{{ $val->addr1 }}{{ $val->addr2 }}{{ $val->addr3 }}</td>
								<td class="text-center">{{ $val->tel }}</td>
								<td>{{ $val->comment }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-12 text-center">
				<nav>{{ $lists->links() }}</nav>
			</div>
		</div>
	</div>

@endsection

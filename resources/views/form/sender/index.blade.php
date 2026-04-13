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
<div class="box box-primary">
    <div class="box-header">
      <div class="box-tools clearfix">
        <div class="pull-left pt3">
          <span class="label label-info">該当件数</span> {{count($senders)}} 件
        </div>
		<div class="pull-right">
			<a class="btn btn-sm btn-success" href="{{route('form.sender.add',[$group_id])}}" >新規追加</a>
		</div>
      </div>

    </div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">	
					<div class="table-responsive">
						<table id="tabelapadrao" class="table table-hover table-height-sm v-middle">
							<thead>
								<tr class="table-head bg-gray" >			 
									<th width="15%" class="text-center">カテゴリ</th>			 
									<th>グループ</th>
									<th>送信先メールアドレス</th>
									<th width="10%">&nbsp;</th>			 
								</tr>
							</thead>
							<tbody>
                
								@foreach($senders as $sender)
									
										<tr>
											<td class="text-center">{{ $group_category[$group->category_id] ?? ('カテゴリID '.$group->category_id) }}</td>             
											<td>{{$group->name}}</td>     
											<td><a href="{{route('form.sender.detail',[$sender->id])}}">{{$sender->email}}</a></td>     
											<td class="text-right">
												
												<a href="#" onclick="delete_sender({{$sender->id}})" title="削除" class="btn btn-sm btn-default ">
													削除
												</a>
											</td> 
										</tr>
									
								@endforeach
							</tbody>
							
						</table>
					</div>
				</div>				
				
			</div>
		</div>
</div> 

<script>


	function delete_sender(id){
		if (confirm("本当に削除しますか？")) {
			$.ajax({
				url: '{{route('form.sender.delete')}}',
				type: 'POST',
				data: {
					id: id,
					_token: '{{ csrf_token() }}' 
				},
				success: function(response) {
					alert(response.message)
					location.reload(); 
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText); 
				}
			});
		}


			
	}

	
</script>
@endsection


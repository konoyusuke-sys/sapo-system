@extends('layouts.AdminLTE.index')

@section('icon_page', 'edit')

@section('title', 'フォーム ')
@section('sub_title', 'Form ')

@section('menu_pagina')	

@section('content')
<div class="nav-tabs-custom box-solid-header mb20">
	<ul class="nav nav-tabs">
		<li class="noactive"><a href="{{ route('form.detail',[$form_id]) }}">基本設定</a></li>
		<li class="active"><a  href="">通知先設定</a></li>
		
	</ul>
</div>
<div class="box box-primary">
    <div class="box-header">
      <div class="box-tools clearfix">
        <div class="pull-left pt3">
          <span class="label label-info">該当件数</span> {{count($groups)}} 件
        </div>
		<div class="pull-right">
			<a class="btn btn-sm btn-success" href="{{route('form.group.add',[$form_id])}}" >新規追加</a>
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
									<th>タイトル</th>
									<th width="10%">&nbsp;</th>			 
								</tr>
							</thead>
							<tbody>
                
								@foreach($groups as $group)
									
										<tr>
											<td class="text-center">{{$group_category[$group->category_id]}}</td>             
											<td><a href="{{route('form.group.detail',[$group->id])}}">{{$group->name}}</a></td>     
											<td class="text-right d-flex">
												<a href="{{route('form.sender.index',[$form_id,$group->id])}}"  class="btn btn-sm btn-primary mr3">
													メールアドレス設定
												</a>
												<a href="#" onclick="delete_group({{$group->id}})" title="削除" class="btn btn-sm btn-warning">
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


	function delete_group(id){
		if (confirm("本当に削除しますか？")) {
			$.ajax({
				url: '{{route('form.group.delete')}}',
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


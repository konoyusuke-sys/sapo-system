@extends('layouts.AdminLTE.index')

@section('icon_page', 'edit')

@section('title', 'フォーム ')
@section('sub_title', 'Form ')

@section('menu_pagina')	

@section('content')
<div class="box box-primary">
    <div class="box-header">
      <div class="box-tools clearfix">
        <div class="pull-left pt3">
          <span class="label label-info">該当件数</span> {{$forms->total()}} 件
        </div>
      </div>
    </div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">	
					<div class="table-responsive">
						<table id="tabelapadrao" class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>			 
									<th>スラッグ</th>			 
									<th>タイトル</th>
												 
									<th class="text-center"></th>			 
								</tr>
							</thead>
							<tbody>
                
								@foreach($forms as $form)
									
										<tr>
											<td>{{$form->slug}}</td>             
											<td><a href="{{ route('form.detail',[$form->id]) }}">{{$form->name}}</a></td>     
											<td class="text-center"> 
												 <a class="btn btn-primary  btn-xs" href="{{route('form.list',[$form->id])}}" title=""><i class="fa fa-eye">   </i>登録リスト</a>
												 
											</td> 
										</tr>
									
								@endforeach
							</tbody>
							<tfoot>
								<tr>		 
                  <th>スラッグ</th>			 
									<th>タイトル</th>
									<th class="text-center"></th>				 
								</tr>
							</tfoot>
						</table>
					</div>
				</div>				
				<div class="col-md-12 text-center">
					{{ $forms->links() }}
				</div>
			</div>
		</div>
</div> 
@endsection
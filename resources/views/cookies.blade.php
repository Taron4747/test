	@extends('layouts.app')

@section('cookie')

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
	<div class="panel panel-flat">
			
						<div class="panel-heading">
							<h5 class="panel-title">Просмотр Пакетов Cookie</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
						
						</div>

						<table id="example" class="display">
							<thead>
							
							</thead>
		
						</table>
					</div>

		            <!-- Horizontal form modal -->
					<div id="modal_form_horizontal" class="modal fade">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">Редактировать cookie</h5>
								</div>

								<form id="AddCookie"  method="post" action="add-cookie" class="form-horizontal">
									@csrf
									<input type="hidden" name="cookie_id" id="cookie_id" value="">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label col-sm-3">IP Server Puck</label>
											<div class="col-sm-9">
												<input type="text" name="ip" id="ip" value="{{old('ip')}}" placeholder="" class="form-control">
												@if ($errors->has('ip'))
				                                    <span class="text-danger">{{ $errors->first('ip') }}</span>
				                                @endif
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3">Puck Name	</label>
											<div class="col-sm-9">
												<input type="text" name="name" id="name" value="{{old('name')}}" placeholder="" class="form-control">
												@if ($errors->has('name'))
				                                    <span class="text-danger">{{ $errors->first('name') }}</span>
				                                @endif
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-3">Puck Description
												</label>
											<div class="col-sm-9">
												<input type="text" name="description" value="{{old('description')}}" id="description" placeholder="Укажите примечание к пакету." class="form-control">
												@if ($errors->has('description'))
				                                    <span class="text-danger">{{ $errors->first('description') }}</span>
				                                @endif
											</div>
										</div>




							

									
									</div>

									<div class="modal-footer">
										<button type="button" class="btn btn-cookie" data-dismiss="modal">Close</button>
										<button type="submit" id="submitCookie" class="btn btn-primary">Добавить</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					</div>
					<div id="modal_form_inline" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content text-center">
								<div class="modal-header">
									<h5 class="modal-title">Удалить выбранный cookie</h5>
								</div>
								<div style="display: flex;justify-content: center;margin-top: 30px;">
								<form action="remove-cookie" method="post" class="form-inline">
									@csrf

									<input type="hidden" id="removeCookie"  name="id" value="">
									<div class="modal-footer text-center">
										<button type="text" class="btn btn-danger">Да</button>
									</div>
								</form>
									<div class="modal-footer text-center">

										<button data-dismiss="modal" type="text"   class="btn btn-primary">Нет</button>
									</div>
									</div>
							</div>
						</div>
					</div>

					<button id="add-cookie" style="display: none;" type="text" data-toggle="modal" data-target="#modal_form_horizontal"  class="btn btn-primary"></button>

					
					@if (count($errors))
      
			  <script type="text/javascript">
                  $(document).ready(function () {

			  		$('#add-cookie').click()
        });

			  	  </script>
					@endif
    <script type="text/javascript" src="assets/js/main/cookie.js"></script>
               <script type="text/javascript">
                  $(document).ready(function () {
                    
            $('#example').DataTable({
                // "processing": true,
                // "serverSide": true,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": true,
                "searching": false,
                "sorting": true,
                 "paging": true,
                 "ordering":'isSorted',
                 "order": [],
                "ajax":{
                         "url": "/cookie-data",
                         "data":"{}",
                         "dataType": "json",
                         "type": "POST",
                         "data":{ _token: "{{csrf_token()}}"}
                       },
                "columns":  [
                    { "data": "ip","title": "IP Server Puck"},  
                    { "data": "name","title": "Puck Name"},  
                    { "data": "description","title": "Puck Description"},
                    { "data": "action","title": "Action"},
                  
                 
                   


    
                ],    
                "fnRowCallback": function( nRow ) {
                  
               
                }    

            });
        });
        </script>

@endsection

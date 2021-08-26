	@extends('layouts.app')

@section('link')
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Добавление И редактирование Пакетов Ссылок

</span> </h4>
                        </div>

                        <div class="heading-elements">
                           
                        </div>
                    </div>

                
                </div>
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
	<div class="panel panel-flat">
					<div class="panel-heading" style="border-color: #ddd;">
							<h5 class="panel-title">Добавление  Пакетов Ссылок</h5>
							<br>
							<button id="add-link" type="button" data-toggle="modal" data-target="#modal_form_horizontal" class="btn btn-primary">Добавить  <i class="icon-arrow-right14 position-right"></i></button>
						</div>

						<div class="panel-heading">
							<h5 class="panel-title">Просмотр Пакетов Ссылок</h5>
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
									<h5 class="modal-title">Добавить пакет Ссылок</h5>
								</div>

								<form id="AddLink" id="name" method="post" action="add-link" class="form-horizontal">
									@csrf
									<input type="hidden" name="link_id" id="link_id" value="">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label col-sm-3">Site</label>
											<div class="col-sm-9">
												<input type="text" name="name" id="name"  placeholder="Укажите ID пакета прокси или имя пакета." class="form-control">
												@if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-sm-3">Description</label>
											<div class="col-sm-9">
												<input type="text" name="description" id="description" placeholder="Укажите примечание к пакету." class="form-control">
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-sm-3">Link List</label>
											<div class="col-sm-9">
												<textarea rows="5" name="link_list" id="link_list" cols="5" class="form-control" placeholder=""></textarea>
													@if ($errors->has('link_list'))
                                    <span class="text-danger">{{ $errors->first('link_list') }}</span>
                                @endif
													<span class="help-block">Добавляемые ссылки не должны иметь специальных разделителей, каждая ссылка указывается с новой строки.</span>
											</div>

										</div>
					


							

									
									</div>

									<div class="modal-footer">
										<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
										<button type="submit" id="submitLink" class="btn btn-primary">Добавить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
										<div id="linkListModal" class="modal fade">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">Link List</h5>
								</div>

								<form  class="form-horizontal">
									<div class="modal-body">
			

										<div class="form-group">
											<div class="col-sm-12">
												<textarea disabled="disabled" rows="5" id="linkList" cols="5" class="form-control" placeholder=""></textarea>
												
													
											</div>

										</div>
										</div>
				</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									</div>
							</div>
						</div>
					</div>
					<div id="modal_form_inline" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content text-center">
								<div class="modal-header">
									<h5 class="modal-title">Удалить выбранный link</h5>
								</div>
								<div style="display: flex;justify-content: center;margin-top: 30px;">
								<form action="remove-link" method="post" class="form-inline">
									@csrf

									<input type="hidden" id="removeLink"  name="id" value="">
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
					<button id="openLinkList" style="display: none;" type="text" data-toggle="modal" data-target="#linkListModal"  class="btn btn-primary"></button>

					
					@if (count($errors))
      
			  <script type="text/javascript">
                  $(document).ready(function () {

			  		$('#add-link').click()
        });

			  	  </script>
					@endif
    <script type="text/javascript" src="assets/js/main/link.js"></script>
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
                         "url": "/link-data",
                         "data":"{}",
                         "dataType": "json",
                         "type": "POST",
                         "data":{ _token: "{{csrf_token()}}"}
                       },
                "columns":  [
                    { "data": "id","title": "#"},  
                    { "data": "name","title": "ID Package Link"},  
                    { "data": "description","title": "Description"},
                    { "data": "action","title": "Action"},
                  
                 
                   
              
    
                ],    
                "fnRowCallback": function( nRow ) {
                  
               
                }    

            });
        });
        </script>

@endsection

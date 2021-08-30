@extends('layouts.app')

@section('settings')
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Добавление И редактирование основных настроек

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
							<h5 class="panel-title">Добавление  основных настроек </h5>
							<br>
							<button id="add-setting" type="button" data-toggle="modal" data-target="#modal_form_horizontal" class="btn btn-primary">Добавить  <i class="icon-arrow-right14 position-right"></i></button>
						</div>

						<div class="panel-heading">
							<h5 class="panel-title">Основные настройки</h5>
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

	
                <div id="modal_form_horizontal" class="modal fade">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Редактирование настроек сервера</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>  
                            <form id="AddSetting" id="name" method="post" action="add-setting" class="form-horizontal">
                                    @csrf

                                    <input type="hidden" name="setting_id" id="setting_id" value="">

                            <div class="modal-body">
                                <input type="hidden" name="hiddenChange" value="addNew">
                                <div class="form-group m-form__group">
                                    <label for="ip_server">IP Server</label>
                                    <input type="text" class="form-control m-input" id="ip_server" aria-describedby="emailHelp" placeholder="89.223.98.1" name="ip_server" value="{{old('ip_server')}}">
                                    @if ($errors->has('ip_server'))
                                    <span class="text-danger">{{ $errors->first('ip_server') }}</span>
                                @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="CtRInput">CTR</label>
                                    <input type="text" class="form-control m-input" id="CtRInput" aria-describedby="emailHelp" placeholder="3" name="ctr" value="{{old('ctr')}}">
                                      @if ($errors->has('ctr'))
                                    <span class="text-danger">{{ $errors->first('ctr') }}</span>
                                @endif
                                </div><div class="form-group m-form__group">
                                    <label for="LogicLabel">Select server mode</label>
                                    <div class="m-radio-list">
                                        <label class="m-radio">Work<input type="radio" id="work" name="mode" value="1" checked="checked"><span></span>
                                        </label>
                                        <label class="m-radio">To Walk<input type="radio" id="walk" name="mode" value="2"><span></span></label>
                                        <label class="m-radio">New<input type="radio" id="new" name="mode" value="3"><span></span></label>
                                    </div>
                                </div>
                                <div class="m-form__group form-group">
                                    <label>Persent User-Agent Chrome</label>
                                    <div class="input-group m-form__group">
                                        <span class="input-group-addon">
                                            <label class="m-persent1UaCheckbox m-persent1UaCheckbox--single m-persent1UaCheckbox--state m-persent1UaCheckbox--state-success">
                                                <input type="checkbox" name="cbxChrome" id="percentChromCheckbox" value="1">
                                                <span></span>
                                            </label>
                                        </span>
                                        <span class="input-group-addon">%</span>
                                        <input type="text" class="form-control" aria-label="Text input with persent1UaCheckbox" name="persentChrome" id="persentChrome" value="{{old('persentChrome')}}">
                                          @if ($errors->has('persentChrome'))
                                    <span class="text-danger">{{ $errors->first('persentChrome') }}</span>
                                @endif
                                    </div>
                                </div>
                                <div class="m-form__group form-group"><label>Persent User-Agent Opera</label>
                                    <div class="input-group m-form__group"><span class="input-group-addon">
                                            <label class="m-persent2UaCheckbox m-persent2UaCheckbox--single m-persent2UaCheckbox--state m-persent2UaCheckbox--state-success">
                                                <input type="checkbox" id="cbxOpera" name="cbxOpera" value="1">
                                                <span></span></label></span><span class="input-group-addon">%</span>
                                        <input type="text" value="{{old('persentOpera')}}" class="form-control" aria-label="Text input with persent2UaCheckbox" name="persentOpera" id="persentOpera">
                                          @if ($errors->has('persentOpera'))
                                    <span class="text-danger">{{ $errors->first('persentOpera') }}</span>
                                @endif
                                    </div>
                                </div>
                                <div class="m-form__group form-group"><label>Persent User-Agent Yandex Browser</label>
                                    <div class="input-group m-form__group">
                                        <span class="input-group-addon">
                                            <label class="m-persent3UaCheckbox m-persent3UaCheckbox--single m-persent3UaCheckbox--state m-persent3UaCheckbox--state-success">
                                                <input type="checkbox" id="cbxYandex" name="cbxYandex" value="1"><span></span></label>
                                        </span><span class="input-group-addon">%</span>
                                        <input type="text" value="{{old('persentYandex')}}" class="form-control" aria-label="Text input with persent3UaCheckbox" name="persentYandex" id="persentYandex">
                                          @if ($errors->has('persentYandex'))
                                    <span class="text-danger">{{ $errors->first('persentYandex') }}</span>
                                @endif
                                    </div>
                                </div>
                                <div class="form-group m-form__group"><label for="timeSessionVigulInput">Time to Walk Sec.</label>
                                    <input type="text" value="{{old('timeToWalk')}}" class="form-control m-input" aria-describedby="emailHelp" placeholder="600 - 3200" name="timeToWalk" id="timeToWalk">
                                      @if ($errors->has('timeToWalk'))
                                    <span class="text-danger">{{ $errors->first('timeToWalk') }}</span>
                                @endif
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Create &amp; Perevigyl</label>
                                    <div class="m-checkbox-list">
                                        <label class="m-checkbox">Authorization Mail Box ?
                                            <input type="checkbox" name="activeAuthMail" id="activeAuthMail" value="1"><span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="selectBaseMailList">Select Mail Base</label>
                                    <select class="form-control m-input" id="selectBaseMailList" name="select_mail_base">
                                        @foreach($mails as $mail)
                                        <option value="{{$mail->id}}">{{$mail->name}}</option>
                                        @endforeach
                                    </select>
                                      @if ($errors->has('select_mail_base'))
                                    <span class="text-danger">{{ $errors->first('select_mail_base') }}</span>
                                @endif
                                </div>
                                <div class="m-form__group form-group">
                                    <label>XPUTH</label>
                                    <div class="input-group m-form__group">
                                        <span class="input-group-addon">
                                            <label class="m-xPUTH m-xPUTH--single m-xPUTH--state m-xPUTH--state-success">
                                                <input type="checkbox" name="xputh_chb" id="xputh_chb"value="1">
                                                <span>
                                                    
                                                </span>
                                            </label>
                                        </span>
                                        <span class="input-group-addon">%</span>
                                        <input type="text" value="{{old('xputh_val')}}" class="form-control" aria-label="Text input with xPUTH" name="xputh_val" id="xputh_val">
                                          @if ($errors->has('xputh_val'))
                                    <span class="text-danger">{{ $errors->first('xputh_val') }}</span>
                                @endif
                                    </div>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="selectIpList">IP Proxy List</label>
                                    <select class="form-control m-input" id="selectIpList" name="proxy">
                                        @foreach($proxies as $proxy)
                                        <option value="{{$proxy->id}}">{{$proxy->name}}</option>
                                        @endforeach
                                    </select>
                                      @if ($errors->has('proxy'))
                                    <span class="text-danger">{{ $errors->first('proxy') }}</span>
                                @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="SelectCookiesIpList">Cookies List</label>
                                    <select class="form-control m-input" id="SelectCookiesIpList" name="cookies">
                                          @foreach($cookies as $cookie)
                                            <option value="{{$cookie->id}}">{{$cookie->name}}</option>
                                        @endforeach
                                    </select>
                                      @if ($errors->has('cookies'))
                                    <span class="text-danger">{{ $errors->first('cookies') }}</span>
                                @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="selectSiteList">Site</label>
                                    <select class="form-control m-input" id="selectSiteList" name="site">
                                        @foreach($links as $link)
                                            <option value="{{$link->id}}">{{$link->name}}</option>
                                        @endforeach
                                    </select>
                                      @if ($errors->has('cookies'))
                                    <span class="text-danger">{{ $errors->first('cookies') }}</span>
                                @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="NightTimeInput">Start Time</label>
                                    <input type="text" value="{{old('nignht_time')}}" class="form-control m-input"  aria-describedby="emailHelp" placeholder="240 - 380" name="nignht_time" id="nignht_time">
                                      @if ($errors->has('nignht_time'))
                                    <span class="text-danger">{{ $errors->first('nignht_time') }}</span>
                                @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="DayTimeInput">Add Time</label>
                                    <input type="text" value="{{old('day_time')}}" class="form-control m-input" id="day_time" aria-describedby="emailHelp" placeholder="120 - 150" name="day_time">
                                      @if ($errors->has('day_time'))
                                    <span class="text-danger">{{ $errors->first('day_time') }}</span>
                                @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="exampleTextarea">Description</label>
                                    <textarea class="form-control m-input" id="description" rows="3" id="description" name="description"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="general_btn" value="ok" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>



                <div id="settingListModal" class="modal fade">
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
                                            <textarea disabled="disabled" rows="5" id="settingList" cols="5" class="form-control" placeholder=""></textarea>


                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-setting" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
                </div>
                <div id="modal_form_inline" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content text-center">
                            <div class="modal-header">
                                <h5 class="modal-title">Удалить выбранный setting</h5>
                            </div>
                            <div style="display: flex;justify-content: center;margin-top: 30px;">
                                <form action="remove-setting" method="post" class="form-inline">
                                    @csrf
                                    
                                    <input type="hidden" id="removesetting"  name="id" value="">
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
                <button id="openLinkList" style="display: none;" type="text" data-toggle="modal" data-target="#settingListModal"  class="btn btn-primary"></button>


					@if (count($errors))

			  <script type="text/javascript">
                  $(document).ready(function () {

			  		$('#add-setting').click()
        });

			  	  </script>
					@endif
    <script type="text/javascript" src="assets/js/main/setting.js"></script>
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
                         "url": "/setting-data",
                         "data":"{}",
                         "dataType": "json",
                         "type": "POST",
                         "data":{ _token: "{{csrf_token()}}"}
                       },
                "columns":  [
                    { "data": "ip_server","title": "IP Server"},
                    { "data": "site","title": "Site"},
                    { "data": "description","title": "Description"},
                    { "data": "mode","title": "Change Logic"},
                    { "data": "proxy","title": "Proxy Package"},
                    { "data": "day_time","title": "Стартовое время"},
                    { "data": "nignht_time","title": "Если имеется реклама"},
                    { "data": "persentChrome","title": "% Cr"},
                    { "data": "persentOpera","title": "% Op"},
                    { "data": "persentYandex","title": "% Ya "},
                    { "data": "action","title": "Action"},
                ],
                "fnRowCallback": function( nRow ) {


                }

            });
        });
        </script>
<style>
    .m-radio-list{
        display: flex;
        flex-direction: column;
    }
    .m-radio-list .m-radio{
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    .m-radio-list .m-radio input{
        margin-right: 15px;
    }
    .m-form__group .m-form__group{
        display: flex;
    }
    .m-form__group .m-form__group .input-group-addon{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 36px;
        width:36px;
    }
    .m-form__group .m-form__group .input-group-addon label{
        margin: 0;
        height: 13px;
        width: 13px;
    }
</style>
@endsection

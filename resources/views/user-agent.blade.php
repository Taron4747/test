@extends('layouts.app')

@section('user-agent')
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User Agents
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
							<form action="add-user-agent" method='POST'>
								<input type="hidden" name="table" value="chrome">
									@csrf

								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">BROWSER CHROME :: Count = {{$chromeCount}}</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                	</ul>
					                	</div>
									</div>

									<div class="panel-body">

										<div class="form-group">
											<textarea name='ua' rows="5" cols="5" class="form-control" placeholder="">{{$chromeText}}</textarea>
										</div>

										<div class="text-right">
											<button type="submit" class="btn btn-primary">Submit </button>
										</div>
									</div>
								</div>
							</form>
										<form action="add-user-agent" method='POST'>
								<input type="hidden" name="table" value="opera">
									@csrf

								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">BROWSER OPERA  :: Count = {{$operaCount}}</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                	</ul>
					                	</div>
									</div>



									<div class="panel-body">

										<div class="form-group">
											<textarea name='ua' rows="5" cols="5" class="form-control" placeholder="">{{$operaText}}</textarea>
										</div>

										<div class="text-right">
											<button type="submit" class="btn btn-primary">Submit </button>
										</div>
									</div>
								</div>
							</form>
										<form action="add-user-agent" method='POST'>
								<input type="hidden" name="table" value="yandex">
									@csrf

								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">BROWSER YANDEX :: Count = {{$yandexCount}}</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                	</ul>
					                	</div>
									</div>

									<div class="panel-body">

										<div class="form-group">
											<textarea name='ua' rows="5" cols="5" class="form-control" placeholder="">{{$yandexText}}</textarea>
										</div>

										<div class="text-right">
											<button type="submit" class="btn btn-primary">Submit </button>
										</div>
									</div>
								</div>
							</form>
@endsection

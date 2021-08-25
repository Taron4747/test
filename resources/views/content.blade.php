@extends('layouts.app')

@section('content')
    <!-- Main navbar -->
    <div class="navbar navbar-default header-highlight">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">


         

            <div class="navbar-right">
                <ul class="nav navbar-nav">



                    <li class="dropdown dropdown-user">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <!-- <img src="assets/images/placeholder.jpg" alt=""> -->
                            <span>@if(Auth::user()) {{Auth::user()->name}} @endif</span>
                            <i class="caret"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                   

                            <li><a href="{{ route('logout') }}"><i class="icon-switch2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /main navbar -->
  <!-- @yield('content') -->

    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">



                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">

                              
                             
                            
                  
                                <li><a href="../../RTL/default/index.html"><i class="icon-width"></i> <span>RTL version</span></a></li>
                                <li><a href="/proxy"><i class="icon-width"></i> <span>Proxy</span></a></li>
  
                             
                             
                             
                             
                               

                            
                             

                            </ul>
                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Alpaca</span> - Advanced Examples</h4>
                        </div>

                        <div class="heading-elements">
                           
                        </div>
                    </div>

                
                </div>


                <div class="content">

              
                    </div>


                    <div class="footer text-muted">
                      
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

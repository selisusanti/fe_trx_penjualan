
<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Paspor - @yield('title')</title>

        <meta name="description" content="Paspor">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon-im.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}"> 
        <link rel="stylesheet" id="css-main" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
        <link rel="stylesheet" id="css-theme" href="{{ asset('/css/dashmix.css') }}">
        <link rel="stylesheet" id="css-plugin-table" href="{{ asset('/js/plugins/datatables/dataTables.bootstrap4.css') }}"> 
        <link rel="stylesheet" href="{{ asset('/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/responsive.bootstrap.min.css') }}">  
        <link rel="stylesheet" href="{{ asset('/css/responsive.bootstrap4.min.css') }}"> 

        <!-- for dialog -->
        <link rel="stylesheet" href="{{ asset('/js/plugins/sweetalert2/sweetalert2.min.css') }}">
        @yield('css_after')
        <!-- Scripts -->
        
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
        <script src="{{ asset('/js/dashmix.app.js') }}?time=random" type="text/javascript"></script> 
        <script src="{{ asset('/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}?time=random" type="text/javascript"></script>        
        <script src="{{ asset('/js/plugins/chart.js/Chart.bundle.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('/js/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/plugins/datatables/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/plugins/datatables/buttons/buttons.print.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/plugins/datatables/buttons/buttons.html5.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/plugins/datatables/buttons/buttons.flash.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/plugins/datatables/buttons/buttons.colVis.min.js') }}" type="text/javascript"></script>
       
        <!-- for dialog -->
        <script src="{{ asset('/js/plugins/es6-promise/es6-promise.auto.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/plugins/jquery-validation/jquery.validate.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/plugins/jquery-validation/additional-methods.js') }}" type="text/javascript"></script>    
        <script src="{{ asset('./js/laravel.app.js') }}?time=random" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

        <script>jQuery(function(){ Dashmix.helpers(['notify']); });</script>

        <script src="{{ asset('/js/plugins/custom/utilities.js') }}" type="text/javascript"></script>    

        @yield('js_before')
        <style>
            .img-logo {
                width: 142px;
            }
        </style>
    </head>
    <body>

        @include('layouts.utility.loader')
        
        <section id="loader" class="hide">
            <div class="overlay top"></div>
            <div class="spinner">
                <div class="cube1"></div>
                <div class="cube2"></div>
            </div>
        </section>

        <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed  main-content-narrow">
            
            <!-- Nav -->
            <nav id="sidebar" aria-label="Main Navigation">
                <!-- Side Header -->
                <!-- <div class="bg-header-dark grey"> -->
                <div class="">
                    <div class="content-header bg-white-10 ">
                        <!-- Logo -->
                        <a class="custom link-fx font-w600 font-size-lg logo-hover" href="/dashboard">
                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('/media/errors/404/notset.png') }}" alt="">
                                &nbsp;
                                <div class="text-left">
                                    <p class="font-size-base font-italic text-muted mb-0"></p>
                                </div>
                            </div>
                        </a>
                        <!-- END Logo -->

                        <!-- Options -->
                        <div>
                            <!-- Toggle Sidebar Style -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                            
                            <!-- END Toggle Sidebar Style -->

                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                                <i class="fa fa-times-circle"></i>
                            </a>
                            <!-- END Close Sidebar -->
                        </div>
                        <!-- END Options -->
                    </div>
                </div>
                <!-- END Side Header -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                       
                        <li class="nav-main-item">
                            <a class="nav-main-link link-button {{ Request::segment(1) ==  'dashboard' ? 'active' : ''}}" href="/dashboard">
                                <i class="nav-main-link-icon"></i>
                                <span class="nav-main-link-name">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-main-heading nav-main-item {{ in_array( Request::segment(1) , ['produk','suplier'])  ? 'open' : ''}}" style="text-transform: capitalize; padding-top:10px;"> 
        
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                <i class="nav-main-link-icon"></i>
                                <span class="nav-main-link-name">master</span>
                            </a>
                                <!-- Sub Menu -->
                            <ul class="nav-main-submenu" style="padding-left: 1px; background-color: #FFF;">
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-expand link-button {{ Request::segment(1) ==  'produk' ? 'active' : ''}}" href="/produk">
                                        <i class="nav-main-link-icon "></i>
                                        <span class="nav-main-link-name">Produk</span>
                                    </a>
                                </li>   
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-expand link-button" href="/suplier">
                                        <i class="nav-main-link-icon "></i>
                                        <span class="nav-main-link-name">Suplier</span>
                                    </a>
                                </li>  
                            </ul>
                        </li>
                        <li class="nav-main-item active">
                            <a class="nav-main-link link-button {{ Request::segment(1) ==  'transaksi' ? 'active' : ''}}" href="/transaksi">
                                <i class="nav-main-link-icon"></i>
                                <span class="nav-main-link-name">Transaksi</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link link-button" href="/logout">
                                <i class="nav-main-link-icon"></i>
                                <span class="nav-main-link-name">Logout</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </nav>
            <!-- End Nav -->

            <!-- Header -->
            <header id="page-header" class="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div>
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn  mr-1" data-toggle="layout" data-action="sidebar_toggle">
                            <!-- <i class="fa fa-fw fa-bars"></i> -->
                            <!-- <img class="img-logo" src="{{ asset('/media/logo-dirjen-imigrasi.png')}}" alt="Imigrasi"> -->
                        </button>
                        <!-- END Toggle Sidebar -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div>
                        <!-- User Dropdown -->
                        <div class="d-inline-block">
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                                    User Options
                                </div>
                                <div class="p-2">
                                    <a class="dropdown-item" href="/dashboard">
                                        <i class="far fa-fw fa-user mr-1"></i> Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- END User Dropdown -->

                        <!-- Notifications Dropdown -->
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-bell"></i>
                                <span class="badge badge-secondary badge-pill">@php if(!empty(Session::get('notif'))) echo count(Session::get('notif')); @endphp</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
                                <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                                    Notifications
                                </div>
                            </div>
                        </div>
                        <!-- END Notifications Dropdown -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Loader -->
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary-darker">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>

        <span id="modal-place">
        </span>
            <!-- END Main Container -->

            <!-- Footer -->
            <!-- <footer id="page-footer" class="bg-body-light">
                <div class="content py-0">
                    <div class="row font-size-sm">
                        <div class="col-sm-6 order-sm-1 text-center text-sm-left">
                            <a class="font-w600" href="https://www.imigrasi.go.id/" target="_blank">Paspor</a> &copy; <span data-toggle="year-copy">2018</span>
                        </div>
                    </div>
                </div>
            </footer> -->
            <!-- END Footer -->
            
        </div>

        <!-- END Page Container -->

        @yield('js_after')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

    </body>
</html>


@if(Session::has('error'))

<script type="text/javascript">
    var errorLogin = {!! json_encode(Session::get('error')) !!};

    $(document).ready(function(){
        Dashmix.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: errorLogin,
            allow_dismiss: true,
            timer: 15000
        });
    });
</script>
@endif

@if(Session::has('success'))

<script type="text/javascript">
    var errorLogin = {!! json_encode(Session::get('success')) !!};

    $(document).ready(function(){
        Dashmix.helpers('notify', {
            type: 'success',
            icon: 'fa fa-check mr-1',
            message: errorLogin,
            allow_dismiss: true,
            timer: 15000
        });
    });
</script>
@endif
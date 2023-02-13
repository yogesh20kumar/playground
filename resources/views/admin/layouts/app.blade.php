<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Online Booking - Admin</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet"
              href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!--ckeditor-->
        <script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/custom.css').'?t='.time() }}">

        <!-- jQuery -->
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('adminlte/dist/js/bootbox.min.js') }}"></script>
        <script src="{{ asset('adminlte/dist/js/bootbox.locales.min.js') }}"></script>
        <script>
            var GlobalVariable = {
                'base_url': '@php echo url("/");@endphp',
                'root_url': '{{ Request::server("SERVER_NAME") }}'
            }
        </script>
        <style>
            .help-block strong {
                color: red;
            }
            .card-primary:not(.card-outline) .card-header {
                background-color: #f1f1f1 !important;
                border-bottom: 0;
            }
            .swal2-title{
                font-size: 20px !important;
                color: #fff !important;
            }
            .swal2-toast{
                background: #ca7b60 !important;
            }
            .swal2-container{
                max-width: 670px !important;
            }
            .hide{
                display: none;
            }
            #swal2-content{
                font-size: 20px;
                font-weight: 500;
                color: #fff!important;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
                    </li>
                </ul>

                <!-- SEARCH FORM -->
             <!--    <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form> -->

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">

                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown d-none">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.logout') }}">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
            @include('admin.layouts.sidebar')
            <!-- Content Wrapper. Contains page content -->
            @yield('content')
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <!-- Default to the left -->
                <strong>Copyright &copy; {{ date('Y')}} <a href="#">Online Booking</a>.</strong> All
                rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.0.0
                </div>
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()
            });
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
        </script>
        <!-- Summernote -->
        <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('adminlte/plugins/fastclick/fastclick.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
        <script src="{{ asset('adminlte/dist/js/custom.js').'?t='.time() }}"></script>
        <script>
            $(function () {
                // CKEDITOR.replace('editor1')
                $('#summernote').summernote()

            })
        </script>
    </body>

</html>

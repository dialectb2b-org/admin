
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <title>DialectB2B</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/treeview/style.css') }}" rel="stylesheet">

        <!-- Sweet Alert -->
        <link href="{{ asset('assets/plugins/sweetalert/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/plugins/sweetalert/animate.css" rel="stylesheet') }}" type="text/css">
        <link href="{{ asset('assets/plugins/summernote/css/summernote.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/autocomplete.css') }}" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    </head>

    <body>
        <!-- Left Sidenav -->
        @include('layouts.partials.left_sidebar')
        <!-- end left-sidenav-->
        

        <div class="page-wrapper">
            <!-- Top Bar Start -->
            @include('layouts.partials.header')
            <!-- Top Bar End -->

            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page-Main-Content -->
                    @yield('content')
                    <!-- End Page-Main-Content -->
                    

                </div><!-- container -->

                <footer class="footer text-center text-sm-left">
                    &copy; {{ date('Y') }} DialectB2B <span class="d-none d-sm-inline-block float-right">Developed By <a href="#">Bourgeon Innovations Pvt Ltd</a></span>
                </footer><!--end footer-->
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        
        <!-- jQuery  -->
        
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/js/moment.js') }}"></script>
        <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/tippy/tippy.all.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/treeview/jstree.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/treeview/jquery.treeview.init.js') }}"></script>
        <script src="{{ asset('assets/plugins/summernote/js/summernote.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/autocomplete.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        @stack('scripts')
        <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('warning'))
                toastr.warning('{{ Session::get('warning') }}');    
            @endif
        });

        </script>
    </body>

</html>
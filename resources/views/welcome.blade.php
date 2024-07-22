<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>DialectB2B</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />


    </head>

    <body class="account-body accountbg">

        <!-- Log In page -->
        <div class="container">
            <div class="row vh-100 d-flex justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <a href="#" class="logo logo-admin">
                                            <img src="{{ asset('assets/img/dialect-logo.png') }}" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 font-weight-semibold text-white font-18"></h4>   
                                        <!-- <p class="text-muted  mb-0">Simply eliminates hustle.</p>   -->
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                     <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel"> 
                                            @if (session('status'))
                                                <div class="mb-4 font-medium text-sm text-green-600">
                                                    {{ session('status') }}
                                                </div>
                                            @endif                                       
                                            @if(count($user) > 0)
                                                @if (Route::has('login'))
                                                    @auth
                                                        <div class="form-group mb-0 row">
                                                            <div class="col-12">
                                                                <a href="{{ route('home') }}">
                                                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="button">Home <i class="fas fa-sign-in-alt ml-1"></i></button>
                                                                </a>    
                                                            </div><!--end col--> 
                                                        </div> <!--end form-group-->
                                                    @else
                                                        <div class="form-group mb-0 row">
                                                            <div class="col-12">
                                                                <a href="{{ route('login') }}">
                                                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="button">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                                                </a>    
                                                            </div><!--end col--> 
                                                        </div> <!--end form-group-->
                                                    @endauth                               
                                                @endif
                                            @else
                                                @if (Route::has('register'))
                                                    <div class="form-group mb-0 row">
                                                        <div class="col-12">
                                                            <a href="{{ route('register') }}">
                                                                <button class="btn btn-primary btn-block waves-effect waves-light" type="button">Get Started! <i class="fas fa-sign-in-alt ml-1"></i></button>
                                                            </a>    
                                                        </div><!--end col--> 
                                                    </div>
                                                @endif     
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div><!--end card-body-->
                                <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">Bourgeon Innovations Pvt Ltd © {{ date('Y') }}</span>                                            
                                </div>
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
        <!-- End Log In page -->

        


        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>

        
    </body>

</html>


       

          
           

         

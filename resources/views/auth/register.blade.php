<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Simbill</title>
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
                                        <!-- <h4 class="mt-3 mb-1 font-weight-semibold text-white font-18">Simbill</h4>   
                                        <p class="text-muted  mb-0">Simply eliminates hustle.</p>   -->
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="nav-border nav nav-pills" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active font-weight-semibold" data-toggle="tab" href="#LogIn_Tab" role="tab">{{ __('Register') }}</a>
                                        </li>
                                    </ul>
                                     <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel"> 
                                            @if (session('status'))
                                                <div class="mb-4 font-medium text-sm text-green-600">
                                                    {{ session('status') }}
                                                </div>
                                            @endif                                       
                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf
                                                <div class="form-group mb-2">
                                                    <label for="name">{{ __('Name') }}</label>
                                                    <div class="input-group">                                                                                         
                                                        <input type="text" class="form-control"  name="name" :value="old('name')" required autofocus autocomplete="name" />
                                                    </div>                                    
                                                </div><!--end form-group--> 
                                                <div class="form-group mb-2">
                                                    <label for="email">{{ __('Email') }}</label>
                                                    <div class="input-group">                                                                                         
                                                        <input id="email"  type="email" name="email" :value="old('email')" class="form-control"  required autofocus autocomplete="name" />
                                                    </div>                                    
                                                </div><!--end form-group--> 
                                                <div class="form-group mb-2">
                                                    <label for="userpassword">{{ __('Password') }}</label>                                            
                                                    <div class="input-group">                                  
                                                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                                                    </div>                               
                                                </div><!--end form-group--> 
                                                <div class="form-group mb-2">
                                                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>                                            
                                                    <div class="input-group">                                  
                                                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                                    </div>                               
                                                </div><!--end form-group-->                   
                                                <div class="form-group mb-0 row">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">{{ __('Register') }} <i class="fas fa-sign-in-alt ml-1"></i></button>
                                                    </div><!--end col--> 
                                                </div> <!--end form-group-->                           
                                            </form><!--end form-->
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


       

          
           

         

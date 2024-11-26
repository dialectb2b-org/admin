@extends('layouts.app')

@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">{{ __('Dashboard') }}</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">DialectB2B</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                <span class="day-name" id="Day_Name"></span>&nbsp;
                                <span class="" id="Select_date">{{ date('F d, Y') }}</span>
                                <i data-feather="calendar" class="align-self-center icon-xs ms-1"></i>
                            </a>
                        </div><!--end col--> 
                        <div class="col-auto align-self-center">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                <span class="day-name" id="Day_Name">Time:</span>&nbsp;
                                <span class="" id="tt">00:00:00 AM</span>
                                <i data-feather="calendar" class="align-self-center icon-xs ms-1"></i>
                            </a>
                        </div><!--end col-->  
                    </div><!--end row-->                                                              
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <!-- end page title end breadcrumb -->
    
        <!-- Registrations & Approvals -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Registrations & Approvals</div>
    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3"> 
                                <a href="{{ route('registration.index') }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="h4">{{ $forapproval ?? 0 }}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Registration Approval</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body--> 
                                </a>                   
                            </div>
                            
                            <div class="col-md-3">
                                <a href="{{ route('registration.todo') }}"> 
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="h4">{{ $todo ?? 0 }}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">To Do List</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->
                                </a>                     
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Registrations & Approvals End -->

        <!-- Clients -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Clients</div>
    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3"> 
                                <a href="{{ route('clients.unregistered.index') }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="h4">{{ $unregistered ?? 0 }}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Un-Registered Clients</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->  
                                </a>                   
                            </div>
                            <div class="col-md-3"> 
                                <a href="{{ route('clients.approved.index') }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="h4">{{ $approved ?? 0 }}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Approved Clients</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->  
                                </a>                   
                            </div>
                            <div class="col-md-3"> 
                                <a href="{{ route('clients.registered.index') }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="h4">{{ $registered ?? 0 }}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Registered Clients</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->  
                                </a>                   
                            </div>
                            <div class="col-md-3"> 
                                <a href="{{ route('clients.verified.index') }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="h4">{{ $verified ?? 0 }}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Verified Clients</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->   
                                </a>                  
                            </div>
                            <div class="col-md-3"> 
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col text-center">                                                                        
                                                <span class="h4">{{ $subscribed ?? 0 }}</span>      
                                                <h6 class="text-uppercase text-muted mt-2 m-0">Subscribed Clients</h6>                
                                            </div><!--end col-->
                                        </div> <!-- end row -->
                                    </div><!--end card-body-->
                                </div> <!--end card-body-->                     
                            </div>
                            <div class="col-md-3"> 
                                <a href="{{ route('clients.superseded.index') }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="h4">{{ $superseded ?? 0 }}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Superseded Clients</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->  
                                </a>                   
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('clients.disabled.index') }}"> 
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">                                                                        
                                                    <span class="h4">{{ $disabled ?? 0 }}</span>      
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Disabled / Freezed Clients</h6>                
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->  
                                </a>                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Clients End -->
        <div class="row">
                                                     
        </div><!--end row-->
        
    </div><!-- container -->
</div>
<!-- end page content -->
@endsection
@push('scripts')
<script>
function digi() {
  var date = new Date(),
      hour = date.getHours(),
      minute = checkTime(date.getMinutes()),
      ss = checkTime(date.getSeconds());

  function checkTime(i) {
    if( i < 10 ) {
      i = "0" + i;
    }
    return i;
  }

if ( hour > 12 ) {
  hour = hour - 12;
  if ( hour == 12 ) {
    hour = checkTime(hour);
  document.getElementById("tt").innerHTML = hour+":"+minute+":"+ss+" AM";
  }
  else {
    hour = checkTime(hour);
    document.getElementById("tt").innerHTML = hour+":"+minute+":"+ss+" PM";
  }
}
else {
  document.getElementById("tt").innerHTML = hour+":"+minute+":"+ss+" AM";;
}
var time = setTimeout(digi,1000);
}
digi();
</script>
@endpush

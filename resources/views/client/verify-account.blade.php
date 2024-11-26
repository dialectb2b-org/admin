@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i>Registration</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('registration.index') }}">Registration</a></li>
                        <li class="breadcrumb-item active">View Registration</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary" title="Back">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
                <div class="col-12">
                    <div class="card">                               
                        <div class="card-body">
                            <div class="dastone-profile">
                                <div class="row">
                                    <div class="col-lg-4  mb-3 mb-lg-0">
                                        <div class="dastone-profile-main">
                                            <div class="dastone-profile_user-detail">
                                                <h5 class="dastone-user-name">{{ $company->name }}</h5>
                                                <span class="badge badge-pill badge-{{ ($company->is_approved == 1) ? 'primary' : 'secondary' }}">
                                                    {{ ($company->is_approved == 1) ? 'Approved' : 'Pending' }}
                                                </span>
                                                <ul class="list-unstyled personal-detail mb-0">
                                                    <li class="mt-2"><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Mobile </b> : {{ $company->phone }}</li>
                                                    <li class="mt-2"><i class="ti ti-headphone me-2 text-secondary font-16 align-middle"></i> <b> Landline </b> : {{ $company->landline }}</li>
                                                    <li class="mt-2"><i class="ti ti-printer me-2 text-secondary font-16 align-middle"></i> <b> Fax </b> : {{ $company->fax }}</li>
                                                    <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : {{ $company->email }}</li>
                                                    <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Website </b> : {{ $company->domain }}</li>                                                  
                                                </ul>                                                        
                                            </div>  
                                        </div>                                                
                                    </div><!--end col-->
                                    
                                    <div class="col-lg-4 ms-auto align-self-center">
                                        <ul class="list-unstyled personal-detail mb-0">
                                            <li class="mt-2"><b> Address </b> : {{ $company->address }}</li>
                                            <li class="mt-2"><b> Building </b> : {{ $company->building }}</li>                                                  
                                            <li class="mt-2"><b> PO Box </b> : {{ $company->pobox }}</li>                                                                                                 
                                            <li class="mt-2"><b> Country </b> : {{ $company->country->name ?? '' }}</li>                                                                                                  
                                        </ul>      
                                    </div><!--end col-->
                                    <div class="col-lg-4 align-self-center">
                                        <ul class="list-unstyled personal-detail mb-0">
                                            <li class="mt-2"><b> Zone </b> : {{ $company->zone }}</li>
                                            <li class="mt-2"><b> Street </b> : {{ $company->street }}</li> 
                                            <li class="mt-2"><b> Unit </b> : {{ $company->unit }}</li>    
                                            <li class="mt-2"><b> Region </b> : {{ $company->region->name ?? '' }}</li>                                                                                                   
                                        </ul>                                   
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end f_profile-->                                                                                
                        </div><!--end card-body-->          
                    </div> <!--end card-->    
                </div><!--end col-->
            </div><!--end row-->

            <div class="row">
                <div class="col-12">
                    <div class="card">                               
                        <div class="card-body">
                            <div class="dastone-profile">
                                <div class="row">
                                    <div class="col-lg-12 align-self-center mb-3 mb-lg-0">
                                        <div class="dastone-profile-main">
                                            <div class="dastone-profile_user-detail">
                                               <h4 class="page-title">Account Verification</h4>                                                                                                         
                                            </div>
                                        </div>   
                                        <hr>                                             
                                    </div><!--end col-->
                                    
                                    <div class="col-lg-12 ms-auto align-self-center">
                                        <div class="table-responsive-sm">
                                            <table class="table table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Reference No :</th>
                                                        <th scope="col">{{ $payment->ref_no ?? '' }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr colspan="2">
                                                        <td>
                                                        <span class="badge badge-pill badge-{{ ($company->is_account_verified == 1) ? 'primary' : 'secondary' }}">
                                                            {{ ($company->is_account_verified == 1) ? 'Verified' : 'Pending' }}
                                                        </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <form action="{{ route('clients.verify-account-save') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="company_id" value="{{ $company->id }}" />
                                                            <div class="form-group">
                                                                <label>Remarks</label>
                                                                <textarea name="remarks" class="form-control"></textarea>
                                                            </div>
                                                            <div class="form-group float-right">
                                                                 <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                                                                 <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                                                            </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table><!--end /table-->
                                        </div><!--end /tableresponsive-->
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end f_profile-->                                                                                
                        </div><!--end card-body-->          
                    </div> <!--end card-->    
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->   
@endsection


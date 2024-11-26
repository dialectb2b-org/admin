@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i>Pre-Registration</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pre-registration.index') }}">Pre-Registration</a></li>
                        <li class="breadcrumb-item active">Manage Company</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('pre-registration.edit',$company->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Company">
                        Edit Company <i class="ml-2 fas fa-pencil-alt"></i></a>
                    <a href="{{ route('pre-registration.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back <i class="ml-2 fas fa-arrow-left"></i></a>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
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
                                                <ul class="list-unstyled personal-detail mb-0">
                                                    <li class="mt-2">
                                                        <b> Email </b> : {{ $company->email ?? '' }}</li>
                                                    <li class="mt-2">
                                                        <b> Country </b> : {{ $company->country->name ?? '' }}</li> 
                                                    <li class="mt-2">
                                                        <b> Categories </b> </li>        
                                                   
                                                </ul>
                                                <p>{{ $company->temp_categories ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                                

                            </div>
                            <!--end f_profile-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dastone-profile">
                                <div class="row">
                                    <div class="col-lg-12 align-self-center mb-3 mb-lg-0">
                                        <div class="dastone-profile-main">
                                            <div class="dastone-profile_user-detail">
                                                <h4 class="page-title">Business Categories</h4>
                                            </div>
                                        </div>
                                        <a href="{{ route('pre-registration.assign-category',$company->id) }}"
                                                   class="btn btn-primary float-right mb-3">Assign Business Category</a>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12 ms-auto align-self-center">
                                        <div class="card">
                                            <div class="card-body">
                                            
                                            <div class="table-responsive">
                                                <table class="table table-striped mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th class="text-right">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($company->activities as $ca)
                                                    <tr>
                                                        <td>{{ $ca->service->name ?? '' }}</td>
                                                        <td class="text-right">  
                                                            <a class="dropdown-item removeentry" href="#" data-id="{{ $ca->id }}" data-action="{{ route('pre-registration.delete',$ca->id) }}"> <i class="fas fa-trash-alt text-secondary font-16"></i></a>

                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <div class="text-center">
                                                            <h4>No Category Assigned!</h4>
                                                            <a href="{{ route('pre-registration.assign-category',$company->id) }}">
                                                                Assign Business Category
                                                            </a>
                                                        </div>
                                                    </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table><!--end /table-->
                                            </div>
                                               
                                            </div>
                                        </div>
                                        <!--end list-group-->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end f_profile-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->





        </div>
        <!--end page-title-box-->
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i>Non Mandatory Checklist</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('clients.registered.index') }}">Non Mandatory Criteria</a></li>
                        <li class="breadcrumb-item active">{{ $company->name ?? '' }}</li>
                        <li class="breadcrumb-item active">Checklist</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="#" class="btn btn-sm btn-outline-primary"
                        title="Go Back">
                        Go Back <i class="ml-2 fas fa-arrow-left"></i>
                    </a>
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
                                                <span
                                                    class="badge badge-pill badge-{{ ($company->is_approved == 1) ? 'primary' : 'secondary' }}">
                                                    {{ ($company->is_approved == 1) ? 'Approved' : 'Pending' }}
                                                </span>
                            
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
                                    <div class="col-lg-12 ms-auto align-self-center">
                                        <div class="card">
                                            <div class="card-body">
                                            <form action="{{ route('clients.registered.nonMandatoryDataRequest') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="company_id" value="{{ $company->id }}"/>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr class="bg-secondary">
                                                            <td class="text-center h2">Company Info</td>
                                                        </tr>
                                                        @if($company->website == null)
                                                        <tr>
                                                            <td>Website is missing <input type="hidden" name="missing_data[]" value="Website" /></td>
                                                        </tr>
                                                        @endif
                                                        @if($company->landline == null)
                                                        <tr>
                                                            <td>Landline is missing<input type="hidden" name="missing_data[]" value="Landline" /></td>
                                                        </tr>
                                                        @endif
                                                        @if($company->fax == null)
                                                        <tr>
                                                            <td>Fax is missing<input type="hidden" name="missing_data[]" value="Fax" /></td>
                                                        </tr>
                                                        @endif
                                                        @if($company->logo == null)
                                                        <tr>
                                                            <td>Logo is missing<input type="hidden" name="missing_data[]" value="Logo" /></td>
                                                        </tr>
                                                        @endif
                                                        <tr class="bg-secondary">
                                                            <td class="text-center h2">Company Info</td>
                                                        </tr>
                                                        @if($admin->mobile == null)
                                                        <tr>
                                                            <td>Admin Mobile No is missing<input type="hidden" name="admin_missing_data[]" value="Mobile No" /></td>
                                                        </tr>
                                                        @endif
                                                        @if($admin->landline == null)
                                                        <tr>
                                                            <td>Admin Landline No is missing<input type="hidden" name="admin_missing_data[]" value="Landline No" /></td>
                                                        </tr>
                                                        @endif
                                                        @if($procurement->mobile == null)
                                                        <tr>
                                                            <td>Procurement Mobile No is missing<input type="hidden" name="procurement_missing_data[]" value="Mobile No" /></td>
                                                        </tr>
                                                        @endif
                                                        @if($procurement->landline == null)
                                                        <tr>
                                                            <td>Procurement Landline No is missing<input type="hidden" name="procurement_missing_data[]" value="Landline No" /></td>
                                                        </tr>
                                                        @endif
                                                        @if($sales->mobile == null)
                                                        <tr>
                                                            <td>Sales Mobile No is missing<input type="hidden" name="sales_missing_data[]" value="Mobile No" /></td>
                                                        </tr>
                                                        @endif
                                                        @if($sales->landline == null)
                                                        <tr>
                                                            <td>Sales Landline No is missing<input type="hidden" name="sales_missing_data[]" value="Landline No" /></td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <td>
                                                                <button class="btn btn-block btn-primary" type="submit">Send Data Request</button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </form>
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
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i>Clients</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('registration.index') }}">Clients</a></li>
                        <li class="breadcrumb-item active">View Clients</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary" title="Back">
                        <i class="fas fa-arrow-left"></i>
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
                                                <ul class="list-unstyled personal-detail mb-0">
                                                    <li class="mt-2"><i
                                                            class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i>
                                                        <b> Mobile </b> : {{ $company->phone }}</li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-headphone me-2 text-secondary font-16 align-middle"></i>
                                                        <b> Landline </b> : {{ $company->landline }}</li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-printer me-2 text-secondary font-16 align-middle"></i>
                                                        <b> Fax </b> : {{ $company->fax }}</li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-email text-secondary font-16 align-middle me-2"></i>
                                                        <b> Email </b> : {{ $company->email }}</li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-email text-secondary font-16 align-middle me-2"></i>
                                                        <b> Website </b> : {{ $company->domain }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-4 ms-auto align-self-center">
                                        <ul class="list-unstyled personal-detail mb-0">
                                            <li class="mt-2"><b> Address </b> : {{ $company->address }}</li>
                                            <li class="mt-2"><b> Building </b> : {{ $company->building }}</li>
                                            <li class="mt-2"><b> PO Box </b> : {{ $company->pobox }}</li>
                                            <li class="mt-2"><b> Country </b> : {{ $company->country->name ?? '' }}</li>
                                        </ul>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 align-self-center">
                                        <ul class="list-unstyled personal-detail mb-0">
                                            <li class="mt-2"><b> Zone </b> : {{ $company->zone }}</li>
                                            <li class="mt-2"><b> Street </b> : {{ $company->street }}</li>
                                            <li class="mt-2"><b> Unit </b> : {{ $company->unit }}</li>
                                        </ul>
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
                                                <h4 class="page-title">Business Regions</h4>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12 ms-auto align-self-center">
                                        <div class="card">
                                            <div class="card-body">
                                                @forelse($companyLocations as $region)
                                                <span class="badge badge-outline-primary">{{ $region->name }}</span>
                                                @empty

                                                @endforelse
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
                                        <hr>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12 ms-auto align-self-center">
                                        <div class="card">
                                            <div class="card-body">
                                                @forelse($companyActivities as $ca)
                                                <span class="badge badge-outline-primary">{{ $ca->name }}</span>
                                                @empty

                                                @endforelse
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dastone-profile">
                                <div class="row">
                                    <div class="col-lg-12 align-self-center mb-3 mb-lg-0">
                                        <div class="dastone-profile-main">
                                            <div class="dastone-profile_user-detail">
                                                <h4 class="page-title">Document Verification</h4>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12 ms-auto align-self-center">
                                        <div class="table-responsive-sm">
                                            <table class="table table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Document</th>
                                                        <th scope="col">Document No.</th>
                                                        <th scope="col">Expiry Date</th>
                                                        <th scope="col">File</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>{{ $companyDocuments->document->name ?? '' }}</th>
                                                        <td>{{ $companyDocuments->doc_number ?? '' }}</td>
                                                        <td>{{ $companyDocuments->expiry_date ?? '' }}</td>
                                                        <td><a target="_blank"
                                                                href="{{ asset($companyDocuments->doc_file) }}">View
                                                                Document</a></td>
                                                        <td>
                                                            <span
                                                                class="badge badge-pill badge-{{ ($companyDocuments->is_doc_verified == 1) ? 'primary' : 'secondary' }}">
                                                                {{ ($company->is_doc_verified == 1) ? 'Verified' : 'Pending' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">
                                                            <div class="d-grid gap-2 float-right">
                                                                @if($company->is_doc_verified == 0)
                                                                <a type="button"
                                                                    href="{{ route('clients.verify-document',$company->id) }}"
                                                                    class="btn btn-outline-success btn-lg">Verify</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end /table-->
                                        </div>
                                        <!--end /tableresponsive-->
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
                                                <h4 class="page-title">Decleration</h4>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12 ms-auto align-self-center">
                                        @if($company->decleration !='')
                                        <div class="d-grid gap-2 float-center">
                                            <a href="{{ $company->decleration ?? '' }}" target="_blank"
                                                class="btn btn-outline-primary btn-lg">View Decleration</a>
                                        </div>
                                        @else
                                        <div class="float-center">Declaration not updated!</div>
                                        @endif
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
                                                <h4 class="page-title">Account Verification</h4>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12 ms-auto align-self-center">
                                        @if($payment)
                                        <div class="table-responsive-sm">
                                            <table class="table table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th colspan="4">Reference No.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="4">{{ $payment->ref_no }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end /table-->
                                        </div>
                                        <!--end /tableresponsive-->
                                        @else
                                        <div class="float-center">Account verification data not updated!</div>
                                        @endif
                                    </div>
                                    <!--end col-->
                                    @if($company->is_account_updated == 1)   
                                    <div class="col-lg-12 align-self-center mt-4">
                                        @if($company->is_account_verified == 0)   
                                        <form action="{{ route('registration.verifyAccount') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="company_id" value="{{ $company->id }}" />
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <textarea name="remarks" class="form-control"
                                                    placeholder="Enter your remarks"></textarea>
                                            </div>
                                            <div class="form-group float-right">
                                                <button type="submit" name="action" value="approve"
                                                    class="btn btn-success">
                                                    <i class="fa fa-check" aria-hidden="true"></i></button>
                                                <button type="submit" name="action" value="reject"
                                                    class="btn btn-danger">
                                                    <i class="fa fa-times" aria-hidden="true"></i></button>
                                            </div>
                                        </form>
                                        @else
                                            <p class="text-success float-right"><i class="fa fa-check" aria-hidden="true"></i> verified</p>
                                        @endif
                                    </div>
                                    @endif
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
                                                <h4 class="page-title">Users</h4>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12 ms-auto align-self-center">
                                        <div class="table-responsive-sm">
                                            <table class="table table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Role</th>
                                                        <th scope="col">Designation </th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Mobile</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($users as $key => $user)
                                                    <tr>
                                                        <th>{{$key +1}}</th>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->role }}</td>
                                                        <td>{{ $user->designation }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->mobile }}</td>
                                                        <td><span
                                                                class="badge badge-pill badge-{{ ($user->status == 1) ? 'primary' : 'secondary' }}">
                                                                {{ ($user->status == 1) ? 'Active' : 'Disabled' }}
                                                            </span></td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">No Data Found! </a></td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <!--end /table-->
                                        </div>
                                        <!--end /tableresponsive-->
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
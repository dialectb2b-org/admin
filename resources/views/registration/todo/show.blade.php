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
                        <li class="breadcrumb-item"><a href="{{ route('registration.todo') }}">To Do List</a></li>
                        <li class="breadcrumb-item active">{{ $company->name }}</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('registration.todo') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back<i class="ml-2 fas fa-arrow-left"></i>
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
                                                        <b> Mobile </b> : {{ $company->phone }}
                                                    </li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-headphone me-2 text-secondary font-16 align-middle"></i>
                                                        <b> Landline </b> : {{ $company->landline }}
                                                    </li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-printer me-2 text-secondary font-16 align-middle"></i>
                                                        <b> Fax </b> : {{ $company->fax }}
                                                    </li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-email text-secondary font-16 align-middle me-2"></i>
                                                        <b> Email </b> : {{ $company->email }}
                                                    </li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-email text-secondary font-16 align-middle me-2"></i>
                                                        <b> Website </b> : {{ $company->domain }}
                                                    </li>
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
                                                @forelse($company->locations as $loc)
                                                <span class="badge badge-outline-primary">{{ $loc->name ?? '' }}</span>
                                                @empty
                                                <p>Business regions not updated</p>
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
                                                @forelse($company->activities as $ca)
                                                <span class="badge badge-outline-primary">{{ $ca->name ?? '' }}</span>
                                                @empty
                                                <div class="float-center">Business categories not updated!</div>
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
                                            @if($company->document)
                                            <table class="table table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Document</th>
                                                        <th scope="col">Document No.</th>
                                                        <th scope="col">Expiry Date</th>
                                                        <th scope="col">File</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>{{ $company->document->document->name ?? '' }}</th>
                                                        <td>{{ $company->document->doc_number ?? '' }}</td>
                                                        <td>{{ $company->document->expiry_date ?? '' }}</td>
                                                        <td><a target="_blank"
                                                                href="{{ config('setup.application_url').$company->document->doc_file }}">View
                                                                Document</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end /table-->
                                            @else
                                            <div class="float-center">Document not updated!</div>
                                            @endif
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
                                        <div class="d-grid gap-2 text-center">
                                            <a href="{{ config('setup.application_url').$company->decleration ?? '' }}" target="_blank">View Decleration</a>
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
                                        @if($company->payment)
                                        <div class="table-responsive-sm">
                                            <table class="table table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">Reference No.</th>
                                                        <th colspan="2">Updated On.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">{{ $company->payment->ref_no ?? '' }}</td>
                                                        <td colspan="2">{{ $company->payment->created_at ?? '' }}</td>
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
                                                    @forelse ($company->users as $key => $user)
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <a href="{{ route('registration.todo.checklist',$company->id) }}"
                                class="btn btn-primary btn-block">Open Checklist</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page-title-box-->
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
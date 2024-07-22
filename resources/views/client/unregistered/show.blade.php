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
                        <li class="breadcrumb-item"><a href="{{ route('clients.unregistered.index') }}">Un Registered Clients</a></li>
                        <li class="breadcrumb-item active">{{ $company->name ?? '' }}</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('clients.unregistered.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back<i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-12">
                    @if($company->checklist)
                        <div class="alert alert-warning">
                            <h5>Checklist Remarks</h5>
                            <ul>
                                @if($company->checklist->company_name == 0)
                                <li>Company name is not matching with company document</li>
                                @endif
                                @if($company->checklist->country == 0)
                                <li>Country of operation is not matching with company document</li>
                                @endif
                                @if($company->checklist->document_type == 0)
                                <li>Invalid Document</li>
                                @endif
                                @if($company->checklist->document_no == 0)
                                <li>Document Number is not matching with company documents</li>
                                @endif
                                @if($company->checklist->expiry_date == 0)
                                <li>Expiry date is not matching with company documents</li>
                                @endif
                                @if($company->checklist->document == 0)
                                <li>Document file uploaded is invalid</li>
                                @endif
                                @if($company->checklist->declaration == 0)
                                    <li>Declaration file uploaded is invalid.</li>
                                @endif
                                @if($company->checklist->declaration_signature == 0)
                                    <li>Signature is missing or not found in declaration.</li>
                                @endif
                                @if($company->checklist->declaration_seal == 0)
                                    <li>Company Seal is missing or not clear in declaration.</li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dastone-profile">
                                <div class="row">
                                    <div class="col-lg-4  mb-3 mb-lg-0">
                                        <div class="dastone-profile-main">
                                            <div class="dastone-profile_user-detail">
                                                <h5 class="dastone-user-name">{{ $company->name ?? '' }}</h5>
                                                <span
                                                    class="badge badge-pill badge-{{ ($company->is_approved == 1) ? 'primary' : 'secondary' }}">
                                                    {{ ($company->is_approved == 1) ? 'Approved' : 'Pending' }}
                                                </span>
                                                <ul class="list-unstyled personal-detail mb-0">
                                                    <li class="mt-2"><i
                                                            class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i>
                                                        <b> Mobile </b> : {{ $company->phone ?? '' }}</li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-headphone me-2 text-secondary font-16 align-middle"></i>
                                                        <b> Landline </b> : {{ $company->landline ?? '' }}</li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-printer me-2 text-secondary font-16 align-middle"></i>
                                                        <b> Fax </b> : {{ $company->fax ?? '' }}</li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-email text-secondary font-16 align-middle me-2"></i>
                                                        <b> Email </b> : {{ $company->email ?? '' }}</li>
                                                    <li class="mt-2"><i
                                                            class="ti ti-email text-secondary font-16 align-middle me-2"></i>
                                                        <b> Website </b> : {{ $company->domain ?? '' }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-4 ms-auto align-self-center">
                                        <ul class="list-unstyled personal-detail mb-0">
                                            <li class="mt-2"><b> Address </b> : {{ $company->address ?? '' }}</li>
                                            <li class="mt-2"><b> Building </b> : {{ $company->building ?? '' }}</li>
                                            <li class="mt-2"><b> PO Box </b> : {{ $company->pobox ?? '' }}</li>
                                            <li class="mt-2"><b> Country </b> : {{ $company->country->name ?? '' }}</li>
                                        </ul>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 align-self-center">
                                        <ul class="list-unstyled personal-detail mb-0">
                                            <li class="mt-2"><b> Zone </b> : {{ $company->zone ?? '' }}</li>
                                            <li class="mt-2"><b> Street </b> : {{ $company->street ?? '' }}</li>
                                            <li class="mt-2"><b> Unit </b> : {{ $company->unit ?? '' }}</li>
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
                                                @if($company->locations)
                                                @forelse($company->locations as $loc)
                                                <span class="badge badge-outline-primary">{{ $loc->name }}</span>
                                                @empty
                                                <p>Business region not updated!</p>
                                                @endforelse
                                                @endif
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
                                                @if($company->activities)
                                                @forelse($company->activities as $ca)
                                                <span class="badge badge-outline-primary">{{ $ca->name ?? '' }}</span>
                                                @empty
                                                <p>Business categories not updated!</p>
                                                @endforelse
                                                @endif
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>{{ $company->document->document->name ?? '' }}</th>
                                                        <td>{{ $company->document->doc_number ?? '' }}</td>
                                                        <td>{{ $company->document->expiry_date ?? '' }}</td>
                                                        <td>@php $file = $company->document->doc_file ?? '' @endphp
                                                        @if($file)
                                                            <a target="_blank"
                                                                href="{{ config('setup.application_url').$file }}">View
                                                                Document</a>
                                                        @endif
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
        </div>
        <!--end page-title-box-->
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
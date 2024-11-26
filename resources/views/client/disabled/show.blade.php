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
                        <li class="breadcrumb-item"><a href="{{ route('clients.disabled.index') }}">( Deactivated / Freeze)</a></li>
                        <li class="breadcrumb-item active">{{ $company->name ?? '' }}</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('clients.disabled.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
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
                                                @forelse($company->locations as $loc)
                                                <span class="badge badge-outline-primary">{{ $loc->name ?? '' }}</span>
                                                @empty
                                                <p>Business regions not updated!</p>
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
                                                <p>Business categories not updated!</p>
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
                                        </div>
                                        <!--end /tableresponsive-->
                                        @if($company->document->updated_at < $company->checklist->updated_at)
                                        <div class="alert alert-warning">
                                            <ul>
                                                @if($company->checklist->document_type == 0)
                                                    <li>Invalid Document.</li>
                                                @endif
                                                @if($company->checklist->document_no == 0)
                                                    <li>Document Number is not matching with company documents.</li>
                                                @endif
                                                @if($company->checklist->expiry_date == 0)
                                                    <li>Expiry date is not matching with company documents.</li>
                                                @endif
                                                @if($company->checklist->document == 0)
                                                    <li>Document file uploaded is invalid.</li>
                                                @endif
                                            </ul>
                                        </div>
                                        @else
                                        <div class="alert alert-info">
                                            Document Resubmitted
                                        </div>
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
                                        @if($company->updated_at < $company->checklist->updated_at)
                                            <div class="alert alert-warning">
                                                <ul>
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
                                            @else
                                            <!-- <div class="alert alert-info">
                                                Declaration Resubmitted
                                            </div> -->
                                            @endif
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
                                                        <th colspan="2">Verified On.</th>
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
                                            @if($company->payment->updated_at > $company->checklist->updated_at)
                                            <div class="alert alert-warning">
                                                <ul>
                                                    @if($company->checklist->account == 0)
                                                        <li>Transaction details are invalid!.</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            @else
                                        <div class="alert alert-info">
                                            Account Details Resubmitted
                                        </div>
                                            @endif
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
                            <div class="col-lg-12 ms-auto align-self-center">
                                <!-- Button trigger modal -->
                                <a href="{{ route('clients.disabled.checklist',$company->id) }}" class="btn btn-warning">
                                Revert to registered
                                </a>
                                <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                                Revert
                                </button> -->
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
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Revert to approved : {{ $company->name ?? '' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('clients.disable.revert') }}" method="post">
            @csrf
            <input type="hidden" name="company_id" value="{{ $company->id }}"/>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-center table-warning" colspan="3">Document Verification</td>
                    </tr>
                    <tr>
                        <td>Document submitted is valid ?</td>
                        <td>{{ $company->document->document->name ?? '' }}</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="document_type" value="1">
                                <label class="form-check-label">
                                    <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="0"  name="document_type">
                                <label class="form-check-label">
                                    <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Document No. is valid ?</td>
                        <td>{{ $company->document->doc_number ?? '' }}</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="document_no" value="1">
                                <label class="form-check-label">
                                    <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="0" name="document_no">
                                <label class="form-check-label" for="inlineRadio1">
                                    <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>Expiry Date</td>
                        <td>{{ $company->document->expiry_date ?? '' }}</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"  name="exp_date" value="1">
                                <label class="form-check-label">
                                    <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="0" name="exp_date">
                                <label class="form-check-label">
                                    <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                </label>
                            </div>
                        </td>
                    </tr> -->
                    <tr>
                        <td>Uploaded document file is valid?</td>
                        <td><a target="_blank" href="{{ asset($company->document->doc_file) }}">View Document</a></td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="document" value="1">
                                <label class="form-check-label">
                                    <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="0" name="document">
                                <label class="form-check-label">
                                    <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center table-warning" colspan="3">Declaration</td>
                    </tr>
                    <tr>
                        <td colspan="2">Signature is valid ?</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="declaration_signature" value="1">
                                <label class="form-check-label">
                                    <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="declaration_signature" value="0">
                                <label class="form-check-label">
                                    <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                </label>
                            </div>
                            @error('declaration')
                                    <span>{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Company seal is valid ?</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="declaration_seal" id="declaration-1" value="1">
                                <label class="form-check-label">
                                    <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="declaration_seal" id="declaration-2" value="0">
                                <label class="form-check-label">
                                    <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                </label>
                            </div>
                            @error('declaration')
                                    <span>{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Uploaded file is valid ?</td>
                        <td>
                            <a href="{{ $company->decleration ?? '' }}" target="_blank">View Declaration</a>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="declaration" id="declaration-1" value="1">
                                <label class="form-check-label">
                                    <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="declaration" id="declaration-2" value="0">
                                <label class="form-check-label">
                                    <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                </label>
                            </div>
                            @error('declaration')
                                    <span>{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    @if($company->payment)
                    <tr>
                        <td class="text-center table-warning" colspan="3">Account Verification</td>
                    </tr>
                    <tr>
                        <td>Transaction details are valid?</td>
                        <td>{{ $company->payment->ref_no  }}</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="account" id="account-1" value="1">
                                <label class="form-check-label">
                                    <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="account" id="account-2" value="0">
                                <label class="form-check-label">
                                    <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                </label>
                            </div>
                            @error('account')
                                    <span>{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button class="btn btn-block btn-primary" type="submit">Proceed</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
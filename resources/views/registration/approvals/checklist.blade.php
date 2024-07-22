@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i>Registration Checklist</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('registration.index') }}">Registration
                                Approvals</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('registration.show',$company->id) }}">{{ $company->name ?? '' }}</a></li>
                        <li class="breadcrumb-item active">Checklist</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('registration.show',$company->id) }}" class="btn btn-sm btn-outline-primary"
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
                                            <form action="{{ route('registration.verifyChecklist') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="company_id" value="{{ $company->id }}"/>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td>Is the registration name consistent with the name in the Commercial Registration (CR)?</td>
                                                            <td>{{ $company->name ?? '' }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="company_name" value="1">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="0"  name="company_name">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('company_name')
                                                                        <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Is the registration country accurately reflecting the country information in the Commercial Registration (CR)?</td>
                                                            <td>{{ $company->country->name ?? '' }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="country" value="1">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="0"  name="country">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('country')
                                                                        <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center table-warning" colspan="3">Document Verification</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Is the document submitted for registration is a Commercial Registration (CR) ?</td>
                                                            <td>{{ $company->document->document->name ?? '' }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="doc_name" value="1">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="0"  name="doc_name">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('doc_name')
                                                                        <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Does the provided document number during registration match the CR number?</td>
                                                            <td>{{ $company->document->doc_number ?? '' }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="doc_num" value="1">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="0" name="doc_num">
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('doc_num')
                                                                        <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Does the document registration expiry match with the CR details?</td>
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
                                                                @error('exp_date')
                                                                        <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Has the uploaded CR document file been verified and considered valid for the registration process?</td>
                                                            <td><a target="_blank" href="{{ config('setup.application_url').$company->document->doc_file }}">View Document</a></td>
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
                                                                @error('document')
                                                                        <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center table-warning" colspan="3">Declaration</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">Is the signature on the declaration clear and visible for verification purposes?</td>
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
                                                                @error('declaration_signature')
                                                                        <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">Is the company seal clear and visible on the declaration document?</td>
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
                                                                @error('declaration_seal')
                                                                        <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Has the uploaded declaration document file been verified and considered valid for the registration process?</td>
                                                            <td>
                                                                <a href="{{ config('setup.application_url').$company->decleration ?? '' }}" target="_blank">View Decleration</a>
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
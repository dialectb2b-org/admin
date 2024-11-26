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
                                                            <td class="table-warning text-center">Mandatory Fields</td>
                                                            <td class="table-primary text-center">Non Mandatory Fields</td>
                                                        </tr>
                                                    </table>
                                                    <table class="table table-bordered">
                                                    <tr>
                                                            <td class="text-center table-warning" colspan="3">Document Verification</td>
                                                        </tr>
                                                        @if($company->document)
                                                        <tr>
                                                            <td>Document</td>
                                                            <td>{{ $company->document->document->name ?? '' }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="doc_name" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1"  name="doc_name">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Document No.</td>
                                                            <td>{{ $company->document->doc_number ?? '' }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="doc_num" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="doc_num">
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Expiry Date</td>
                                                            <td>{{ $company->document->expiry_date ?? '' }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"  name="exp_date" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="exp_date">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>File</td>
                                                            <td><a target="_blank" href="{{ asset($company->document->doc_file) }}">View Document</a></td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="document" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="document">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @else
                                                        <tr>
                                                            <td>File</td>
                                                            <td>Document not updated!</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="document" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="document">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <td class="text-center table-warning" colspan="3">Declaration</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Declaration</td>
                                                            <td>
                                                                @if($company->decleration !='')
                                                                    <a href="{{ $company->decleration ?? '' }}" target="_blank">View Decleration</a>
                                                                @else
                                                                    <div class="float-center">Declaration not updated!</div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="declaration" id="declaration-1" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="declaration" id="declaration-2" value="1">
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
                                                            <td class="text-center table-primary" colspan="3">Company Info</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Company Name</td>
                                                            <td>{{ $company->name }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input cinfo" type="radio" name="company_name" id="cname-1" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input cinfo" type="radio" name="company_name" id="cname-2" value="1">
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
                                                            <td>Mobile</td>
                                                            <td>{{ $company->phone }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="mobile" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="mobile">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('mobile')
                                                                     <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Landline</td>
                                                            <td>{{ $company->landline }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="landline" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="landline" value="1">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('landline')
                                                                     <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fax</td>
                                                            <td>{{ $company->fax }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="fax" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="fax" value="1">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('fax')
                                                                     <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Website</td>
                                                            <td>{{ $company->domain }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="domain" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="domain">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('domain')
                                                                     <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>{{ $company->address }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="address" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1"  name="address">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('address')
                                                                     <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Building</td>
                                                            <td>{{ $company->building }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"  name="building" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="building">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('building')
                                                                     <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>PO BOX</td>
                                                            <td>{{ $company->pobox }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="pobox" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="pobox">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('pobox')
                                                                     <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Country</td>
                                                            <td>{{ $company->country->name ?? '' }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="country" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="country">
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
                                                            <td>Street</td>
                                                            <td>{{ $company->street }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="street" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1"  name="street">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('street')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Unit</td>
                                                            <td>{{ $company->unit }}</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="unit" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="unit">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('unit')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center table-primary" colspan="3">Operating Regions</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                @forelse($company->locations as $loc)
                                                                    <span class="badge badge-outline-primary">{{ $loc->region->name }}</span>
                                                                @empty
                                                                    <p>Business regions are not updated!</p>
                                                                @endforelse
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="regions" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="regions">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('regions')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center table-primary" colspan="3">Business Categories</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                @forelse($company->activities as $ca)
                                                                    <span class="badge badge-outline-primary">{{ $ca->service->name ?? '' }}</span>
                                                                @empty
                                                                    <div class="float-center">Business categories not updated!</div>
                                                                @endforelse
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="categories" value="0">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-check me-2 text-success font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" value="1" name="categories">
                                                                    <label class="form-check-label">
                                                                        <i class="ti ti-close me-2 text-danger font-16 align-middle"></i>
                                                                    </label>
                                                                </div>
                                                                @error('categories')
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
@push('scripts')
<script>
$(document).ready(function() {
    $('.cinfo').click(function() {
        var data = [];
        $(".cinfo:checked").each(function(index) {  
            if($( this ).data('value') != null){  
                data.push($( this ).data('value'));
            }
        });
       $('#cinfo-text').val(data.toString());
    });
    $('.docinfo').click(function() {
        var data = [];
        $(".docinfo:checked").each(function(index) {
            if($( this ).data('value') != null){  
               data.push($( this ).data('value'));
            }
        });
        $('#docinfo-text').val(data.toString());
    });
});
</script>
@endpush
@endsection
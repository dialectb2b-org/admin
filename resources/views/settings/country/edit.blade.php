@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Country</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('country.index') }}">Country</a></li>
                        <li class="breadcrumb-item active">Edit Country</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('country.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- Form -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Country</h4>
                        <!-- <p class="text-muted mb-0">Custom stylr example.</p> -->
                    </div><!--end card-header-->
                    <div class="card-body">
                        <form action="{{ route('country.update',$country) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') parsley-error @enderror"
                                               id="name" name="name" value="{{ old('name') ?? $country->name }}" placeholder="Enter name"/>
                                        @error('name')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="iso3">iso3</label>
                                        <input type="text" class="form-control @error('iso3') parsley-error @enderror" 
                                               id="iso3" name="iso3" value="{{ old('iso3') ?? $country->iso3 }}" maxlength="3" placeholder="Enter iso3"/>
                                        @error('iso3')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="numeric_code">Numeric code </label>
                                        <input type="text" class="form-control @error('numeric_code') parsley-error @enderror" placeholder="Enter numeric code"
                                               id="numeric_code" name="numeric_code" value="{{ old('numeric_code') ?? $country->numeric_code }}" maxlength="16" onkeypress="return onlyNumberKey(event)"/>
                                        @error('numeric_code')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="iso2">iso2</label>
                                        <input type="text" class="form-control @error('iso2') parsley-error @enderror"
                                               id="iso2" name="iso2" value="{{ old('iso2') ?? $country->iso2 }}" maxlength="2" placeholder="Enter iso2"/>
                                        @error('iso2')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="phonecode">Phonecode</label>
                                        <input type="text" class="form-control @error('phonecode') parsley-error @enderror" placeholder="Enter phonecode"
                                               id="phonecode" name="phonecode" value="{{ old('phonecode') ?? $country->phonecode }}" maxlength="10" />
                                        @error('phonecode')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="capital">Capital</label>
                                        <input type="text" class="form-control @error('capital') parsley-error @enderror"
                                               id="capital" name="capital" value="{{ old('capital') ?? $country->capital }}" placeholder="Enter capital"/>
                                        @error('capital')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="currency">Currency</label>
                                        <input type="text" class="form-control @error('currency') parsley-error @enderror"
                                               id="currency" name="currency" value="{{ old('currency') ?? $country->currency }}" placeholder="Enter currency"/>
                                        @error('currency')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="currency_name">Currency Name</label>
                                        <input type="text" class="form-control @error('currency_name') parsley-error @enderror"
                                               id="currency_name" name="currency_name" value="{{ old('currency_name') ?? $country->currency_name }}" placeholder="Enter currency name"/>
                                        @error('currency_name')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="currency_symbol">Currency Symbol</label>
                                        <input type="text" class="form-control @error('currency_symbol') parsley-error @enderror"
                                               id="currency_symbol" name="currency_symbol" value="{{ old('currency_symbol') ?? $country->currency_symbol }}" placeholder="Enter currency symbol" />
                                        @error('currency_symbol')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tld">tld</label>
                                        <input type="text" class="form-control @error('tld') parsley-error @enderror"
                                               id="tld" name="tld" value="{{ old('tld') ?? $country->tld }}" placeholder="Enter tld"/>
                                        @error('tld')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="native">Native</label>
                                        <input type="text" class="form-control @error('native') parsley-error @enderror"
                                               id="native" name="native" value="{{ old('native') ?? $country->native }}" placeholder="Enter native"/>
                                        @error('native')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right mt-4">
                                    <button type="submit" class="btn btn-primary px-4">Save</button>
                                </div>
                            </div>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div>
            <!-- end form -->
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->   
    @push('scripts')
        <script>
            function onlyNumberKey(evt) {
                
                // Only ASCII character in that range allowed
                var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                    return false;
                return true;
            }

        </script>
    @endpush 
@endsection
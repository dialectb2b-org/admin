@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Pre-Registration</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pre-registration.index') }}">Pre-Registration</a></li>
                        <li class="breadcrumb-item active">Edit Company</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('pre-registration.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back<i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- Form -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-pencil-alt mr-2"></i>Edit Company</h4>
                        <!-- <p class="text-muted mb-0">Custom stylr example.</p> -->
                    </div><!--end card-header-->
                    <div class="card-body">
                        <form action="{{ route('pre-registration.update',$company) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Company Name</label>
                                        <input type="text" class="form-control @error('name') parsley-error @enderror"
                                               id="name" name="name" value="{{ old('name') ?? $company->name ?? '' }}"  placeholder="Enter company name"/>
                                        @error('name')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country_id">Country</label>
                                        <select class="form-control @error('country_id') parsley-error @enderror" id="country_id" name="country_id">
                                            <option value="">Choose Country</option>
                                            @foreach($countries as $country)
                                            <option {{ old('country_id',$company->country_id) == $country->id ? 'selected' : '' }} 
                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                          </select>
                                        @error('country_id')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="code">Email</label>
                                        <input type="email" class="form-control @error('email') parsley-error @enderror" placeholder="Enter email"
                                               id="email" name="email" value="{{ old('email') ?? $company->email ?? '' }}"/>
                                        @error('email')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="code">Alt Email 1</label>
                                        <input type="email" class="form-control @error('alt_email_1') parsley-error @enderror" placeholder="Enter alt email 1"
                                               id="alt_email_1" name="alt_email_1" value="{{ old('alt_email_1') ?? $company->alt_email_1 ?? '' }}"/>
                                        @error('alt_email_1')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="code">Alt Email 2</label>
                                        <input type="email" class="form-control @error('alt_email_2') parsley-error @enderror" placeholder="Enter alt email 2"
                                               id="alt_email_2" name="alt_email_2" value="{{ old('alt_email_2') ?? $company->alt_email_2 ?? '' }}"/>
                                        @error('alt_email_2')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="temp_categories">Categories</label>
                                        <textarea class="form-control @error('temp_categories') parsley-error @enderror" placeholder="Enter categories"
                                               id="temp_categories" name="temp_categories">{{ old('temp_categories') ?? $company->temp_categories ?? '' }}</textarea>
                                        @error('temp_categories')
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
@endsection
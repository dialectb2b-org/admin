@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Region</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('region.index') }}">Region</a></li>
                        <li class="breadcrumb-item active">Edit Region</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('region.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- Form -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Region</h4>
                        <!-- <p class="text-muted mb-0">Custom stylr example.</p> -->
                    </div><!--end card-header-->
                    <div class="card-body">
                        <form action="{{ route('region.update',$region) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') parsley-error @enderror"
                                               id="name" name="name" value="{{ old('name') ?? $region->name }}" placeholder="Enter name"/>
                                        @error('name')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="numeric_code">Country </label>
                                        <select class="form-control js-example-basic-multiple @error('country_id') parsley-error @enderror" 
                                                id="country_id" name="country_id">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $key => $country)
                                            <option {{ $region->country_id == $country->id ? "selected" : "" }} value="{{ $country->id }}" >
                                                    {{ $country->name }}</option>
                                            @endforeach	

                                        </select>
                                        @error('country_id')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="iso2">iso2</label>
                                        <input type="text" class="form-control @error('iso2') parsley-error @enderror"
                                               id="iso2" name="iso2" value="{{ old('iso2') ?? $region->iso2 }}" maxlength="2" placeholder="Enter iso2"/>
                                        @error('iso2')
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
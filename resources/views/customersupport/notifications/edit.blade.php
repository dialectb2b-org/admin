@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> FAQS</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">FAQS</a></li>
                        <li class="breadcrumb-item active">Query</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('faqs.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back <i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- Form -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Query</h4>
                        <!-- <p class="text-muted mb-0">Custom stylr example.</p> -->
                    </div><!--end card-header-->
                    <div class="card-body">
                        <form action="{{ route('faqs.update',$faq->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Category</label>
                                        <select class="form-control" name="category_id" >
                                            <option value="">Select Category</option>
                                            @foreach($categories as $key => $category)
                                            <option value="{{ $category->id }}" {{ $faq->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Question</label>
                                        <input type="text" class="form-control @error('question') parsley-error @enderror" placeholder="Enter question"
                                               id="question" name="question" value="{{ old('question') ?? $faq->question ?? '' }}" autofocus/>
                                        @error('question')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Answer</label>
                                        <input type="text" class="form-control @error('answer') parsley-error @enderror" placeholder="Enter answer"
                                               id="answer" name="answer" value="{{ old('answer') ?? $faq->answer ?? '' }}" autofocus/>
                                        @error('answer')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Status</label>
                                        <select class="form-control" name="status" >
                                            <option {{ $faq->status == 1 ? 'selected' : '' }} value="1">Publish</option>
                                            <option {{ $faq->status == 0 ? 'selected' : '' }} value="0">Archive</option>
                                        </select>
                                        @error('category_id')
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
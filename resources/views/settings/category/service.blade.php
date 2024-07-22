@extends('layouts.app')
@section('content')
@php use \App\Http\Controllers\Settings\CategoryController; @endphp
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Category</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('category.create') }}" class="btn btn-sm btn-outline-primary" title="Add New Category">
                        <i class="fas fa-plus">Add New Category</i>
                    </a>
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back<i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- table -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter</h4>
                        <form action="{{ route('category.service') }}" method="GET">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search Category By Name" name="keyword">
                                        <button class="btn btn-secondary" type="submit">Go!</button>
                                    </div>
                                </div> 
                            </div> 
                        </form>   
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div id="jstree"> 
                            <ul>
                            @foreach ($categories as $key => $category)
                                <li class="jstree-open"  data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>
                                    <span>
                                        <strong>{{ $category->name}} ({{$category->code}})</strong>
                                    </span>
                                    <ul>
                                        @php $subcategories = CategoryController::subcategories($category->id) @endphp
                                        @foreach ($subcategories as $key => $sub)
                                        <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>
                                        <span>
                                            {{ $sub->name}}({{$sub->code}})
                                        </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <br>
                        {{ $categories->links('layouts.partials.pagination') }} 
                    </div>
                </div><!--end card-->
            </div> <!-- end col -->
            <!-- end table -->
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->   
@endsection
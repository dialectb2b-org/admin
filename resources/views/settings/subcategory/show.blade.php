@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Subcategory</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.subcatlist',$category->id) }}">{{ $category->name }}</a></li>
                        <li class="breadcrumb-item active">{{ $subcategory->name }}</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                   
                    <a href="{{ route('category.subcatlist',$category->id) }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- Form -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">View Subcategory</h4>
                        <!-- <p class="text-muted mb-0">Custom stylr example.</p> -->
                    </div><!--end card-header-->
                    <div class="card-body">
                       <table>
                           <tr>
                                <td>Name</td>
                                <th>: {{ $subcategory->name }}</th>
                            </tr>
                            
                            <tr>
                                <td>Code</td>
                                <th> : {{ $subcategory->code }}</th>
                            </tr>
                           
                            <tr>
                                <td colspan="2">Keywords</td>
                            </tr>
                             <tr>
                                <th  colspan="2"> 
                                    <div class="table-responsive">
                                        @if($subcategory->sub_keywords)
                                            <table class="table table-bordered">
                                                @foreach($subcategory->sub_keywords as $key => $row)
                                                <tr class>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $row->keyword }}</td>
                                                    <td><a href="{{ route('deleteKeyword',$row->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        @endif  
                                    </div>
                                </th>
                            </tr>
                        </table>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div>
            <!-- end form -->
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->   
@endsection
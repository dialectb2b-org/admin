@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Category</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                        <li class="breadcrumb-item active">{{ $category->name }}</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('category.subcatlist',$category->id) }}" class="btn btn-sm btn-outline-primary" title="Refresh">
                       Refresh<i class="ml-2 fas fa-sync"></i>
                    </a>
                    <a href="{{ route('category.addsubcategory',$category->id) }}" class="btn btn-sm btn-outline-primary" title="Add New Category">
                       Add New Sub Category<i class="ml-2 fas fa-plus"></i>
                    </a>
                    <a href="{{ route('category.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back <i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- table -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter</h4>
                        <form action="{{ route('category.subcatlist',$category->id) }}" method="GET">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search Sub Category By Name,Code" name="keyword">
                                        <button class="btn btn-secondary" type="submit">Go!</button>
                                    </div>
                                </div> 
                            </div> 
                        </form>   
                    </div><!--end card-header-->
                    <div class="card-body">

</div>
<div class="card-heading">
  <h4 class="text-center">Sub Categories of <b class="text-danger">{{ $category->name }} ({{ $category->code }})<b></h4>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table mb-0 table-centered">
            <thead>
            <tr>
                <th>Sl.No.</th>
                <th>Name</th>
                <th>Code</th>
                <th>Status</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>
            <tbody>   
            @forelse ($subcategories as $key => $sub)
            <tr>
                <td>{{$key +1 }}</td>
                <td>{{ $sub->name }}</td>
                <td>{{ $sub->code }}</td>
                <td><span class="badge badge-pill badge-{{ ($sub->status == 1) ? 'primary' : 'secondary' }}">
                    {{ ($sub->status == 1) ? 'Active' : 'Disabled' }}
                </span></td>
                <td class="text-right">
                    <div class="dropdown d-inline-block">
                        <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                            <a class="dropdown-item" href="{{ route('subcategory.relatives',[$sub->id,$category->id]) }}">Add Relative Category</a>
                            <a class="dropdown-item" href="{{ url('subcategory/edit/'. $category->id.'/'.$sub->id) }}">Edit</a>
                            <a class="dropdown-item" href="{{ url('subcategory/show/'. $category->id.'/'.$sub->id) }}">Show</a>
                            <a class="dropdown-item" href="{{ route('subcategory.subcatdisable',$sub->id) }}">{{ $sub->status == 1 ? 'Disable' : 'Enable' }}</a>
                            <a class="dropdown-item removeentry" href="#" data-id="{{ $sub->id }}" data-action="{{ route('subcategory.destroy',$sub->id) }}">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No Data Found!  <a href="{{ route('category.create') }}"> <strong> Add New Category</strong> </a></td></tr>
            @endforelse
            <tr><td colspan="7">&nbsp;</td></tr>    
            </tbody>
        </table><!--end /table-->
    </div><!--end /tableresponsive-->
  
</div><!--end card-body-->
</div><!--end card-->
</div> <!-- end col -->
<!-- end table -->
</div>
</div><!--end page-title-box-->
</div><!--end col-->
</div><!--end row-->   
@endsection
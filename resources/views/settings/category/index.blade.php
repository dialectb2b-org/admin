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
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('category.index') }}" class="btn btn-sm btn-outline-primary" title="Refresh">
                        Refresh<i class="ml-2 fas fa-sync"></i>
                    </a>
                    <a href="{{ route('category.create') }}" class="btn btn-sm btn-outline-primary" title="Add New Category">
                        Add New Category<i class="ml-2 fas fa-plus"></i>
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back <i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- table -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-filter mr-2"></i> Filter</h4>
                        <form action="{{ route('category.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search Category By Name, Code" name="keyword">
                                        <button class="btn btn-secondary" type="submit">Go!</button>
                                    </div>
                                </div> 
                            </div> 
                        </form>   
                    </div><!--end card-header-->
                    <div class="card-body">

</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table mb-0 table-centered">
            <thead>
            <tr>
                <th>Sl.No.</th>
                <th> Category Name</th>
                <th> Category Code</th>
                <th>Status</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>
            <tbody>   
            @forelse ($categories as $key => $category)
            <tr>
                <td>{{$key + $categories->firstItem()}}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->code }}</td>
                <td><span class="badge badge-pill badge-{{ ($category->status == 1) ? 'primary' : 'secondary' }}">
                    {{ ($category->status == 1) ? 'Active' : 'Disabled' }}
                </span></td>
                <td class="text-right">
                    <div class="dropdown d-inline-block">
                        <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                            <a class="dropdown-item" href="{{ route('category.subcatlist',$category->id) }}">Sub Categories</a>
                            <a class="dropdown-item" href="{{ route('category.addsubcategory',$category->id) }}">Add New Sub Category</a>
                            <a class="dropdown-item" href="{{ route('category.show',$category->id) }}">Show</a>
                            <a class="dropdown-item" href="{{ route('category.edit',$category->id) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('category.disable',$category->id) }}">{{ $category->status == 1 ? 'Disable' : 'Enable' }}</a>
                            <a class="dropdown-item removeentry" href="#" data-id="{{ $category->id }}" data-action="{{ route('category.destroy',$category->id) }}">Delete</a>
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
    {{ $categories->links('layouts.partials.pagination') }} 
</div><!--end card-body-->
</div><!--end card-->
</div> <!-- end col -->
<!-- end table -->
</div>
</div><!--end page-title-box-->
</div><!--end col-->
</div><!--end row-->   
@endsection
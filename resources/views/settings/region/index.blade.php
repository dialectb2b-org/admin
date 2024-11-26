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
                        <li class="breadcrumb-item active">Region</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('region.create') }}" class="btn btn-sm btn-outline-primary" title="Add New Region">
                        <i class="fas fa-plus"></i> Add New Region
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- table -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter</h4>
                        <form action="{{ route('region.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search Region By Name" name="keyword">
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
                                    <th>Name</th>
                                    <th>iso2</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>   
                                @forelse ($regions as $key => $region)
                                <tr>
                                    <td>{{$key + $regions->firstItem()}}</td>
                                    <td>{{ $region->name }}</td>
                                    <td>{{ $region->iso2 }}</td>
                                    <td>{{ $region->country->name ?? '' }}</td>
                                    <td><span class="badge badge-pill badge-{{ ($region->status == 1) ? 'primary' : 'secondary' }}">
                                        {{ ($region->status == 1) ? 'Active' : 'Disabled' }}
                                    </span></td>
                                    <td class="text-right">
                                        <div class="dropdown d-inline-block">
                                            <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                                <a class="dropdown-item" href="{{ route('region.show',$region->id) }}">Show</a>
                                                <a class="dropdown-item" href="{{ route('region.edit',$region->id) }}">Edit</a>
                                                <a class="dropdown-item removeentry" href="#" data-id="{{ $region->id }}" data-action="{{ route('region.destroy',$region->id) }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center">No Data Found!  <a href="{{ route('region.create') }}"> <strong> Add New Region</strong> </a></td></tr>
                                @endforelse
                                <tr><td colspan="7">&nbsp;</td></tr>    
                                </tbody>
                            </table><!--end /table-->
                        </div><!--end /tableresponsive-->
                        {{ $regions->links('layouts.partials.pagination') }} 
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!-- end col -->
            <!-- end table -->
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->   
@endsection
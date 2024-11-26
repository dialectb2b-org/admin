@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Client</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Clients</li>
                        <li class="breadcrumb-item active">Registered</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- table -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter</h4>
                        <form action="{{ route('clients.registered') }}" method="GET">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search Company By Name" name="keyword">
                                        <button class="btn btn-secondary" type="submit">Go!</button>
                                    </div>
                                </div> 
                            </div> 
                        </form>   
                    </div><!--end card-header-->
                    <div class="card-body">
                        <h4 class="card-title">Registered Clients</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-centered">
                                <thead>
                                <tr>
                                    <th>Sl.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Country</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>   
                                @forelse ($clients as $key => $client)
                                <tr>
                                    <td>{{$key + $clients->firstItem()}}</td>
                                    <td><a href="{{ route('client.show',$client->id) }}">{{ $client->name }}</a></td>
                                    <td>{{ $client->email ?? '' }}</td>
                                    <td>{{ $client->phone  ?? '' }}</td>
                                    <td>{{ $client->country->name ?? '' }}</td>
                                    <td class="text-right">
                                        <div class="dropdown d-inline-block">
                                            <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                                <a class="dropdown-item" href="{{ route('client.show',$client->id) }}">Show</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center">No Data Found!   </a></td></tr>
                                @endforelse
                                <tr><td colspan="7">&nbsp;</td></tr>    
                                </tbody>
                            </table><!--end /table-->
                        </div><!--end /tableresponsive-->
                        {{ $clients->links('layouts.partials.pagination') }} 
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!-- end col -->
            <!-- end table -->
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->   
@endsection
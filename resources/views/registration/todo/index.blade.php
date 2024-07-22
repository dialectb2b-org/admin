@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Registrations & Approvals</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">To Do List</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back<i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <!-- table -->
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-filter mr-2"></i>Filter</h4>
                            <form action="{{ route('registration.todo') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search By Name"
                                                name="keyword">
                                            <button class="btn btn-secondary" type="submit">Go!</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 table-centered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($registrations as $key => $r)
                                        <tr>
                                            <td>{{$key + $registrations->firstItem()}}</td>
                                            <td><a href="{{ route('registration.todo.show',$r->id) }}">{{ $r->name }}</a></td>
                                            <td>{{ $r->email }}</td>
                                            <td>{{ $r->phone }}</td>
                                            <td class="text-right">
                                                <div class="dropdown d-inline-block">
                                                    <a class="dropdown-toggle arrow-none" id="dLabel11"
                                                        data-toggle="dropdown" href="#" role="button"
                                                        aria-haspopup="false" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="dLabel11">
                                                        <a class="dropdown-item" href="{{ route('registration.todo.show',$r->id) }}">Show</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No Data Found!</td>
                                        </tr>
                                        @endforelse
                                        <tr>
                                            <td colspan="9">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end /table-->
                            </div>
                            <!--end /tableresponsive-->
                            {{ $registrations->links('layouts.partials.pagination') }}
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div> <!-- end col -->
                <!-- end table -->
            </div>
        </div>
        <!--end page-title-box-->
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
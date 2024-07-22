@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Reported Enquiries</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reported Enquiries</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fas fa-arrow-left"></i>
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
                            <h4 class="card-title">Filter</h4>
                            <form action="{{ route('category.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search By Subject" name="keyword">
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
                                            <th>Enquiry Reference No.</th>
                                            <th>Category</th>
                                            <th>Type</th>
                                            <th>Reported By</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mails as $key => $mail)
                                        <tr>
                                            <td>{{$key + $mails->firstItem()}}</td>
                                            <td>{{ $mail->enquiry->reference_no ?? '' }}</td>
                                            <td>{{ $mail->category }}</td>
                                            <td>{{ $mail->type }}</td>
                                            <td>{{ $mail->reporter->name ?? '' }}</td>
                                            <td class="text-right"><a href="{{ route('reported.show',$mail->id) }}" class="btn btn-info">View Details</a></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Data Found!</td>
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
                            {{ $mails->links('layouts.partials.pagination') }}
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
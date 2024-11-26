@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Sector</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sector.index') }}">Sector</a></li>
                        <li class="breadcrumb-item active">Edit Sector</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('sector.index') }}" class="btn btn-sm btn-outline-primary" title="Help">
                        <i class="fas fa-question"></i>
                    </a>
                    <a href="{{ route('sector.index') }}" class="btn btn-sm btn-outline-primary" title="List Of Sector">
                        <i class="fas fa-list"></i>
                    </a>
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- Form -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">View Sector</h4>
                        <p class="text-muted mb-0">Custom stylr example.</p>
                    </div><!--end card-header-->
                    <div class="card-body">
                       <table>
                           <tr>
                                <td>Name</td>
                                <th>: {{ $sector->name }}</th>
                            </tr>
                            
                            <tr>
                                <td>Code</td>
                                <th> : {{ $sector->code }}</th>
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
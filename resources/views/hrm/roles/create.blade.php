@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Roles</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Add New Role</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('role.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back<i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <!-- Form -->
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add New Role</h4>
                            <!-- <p class="text-muted mb-0">Custom stylr example.</p> -->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') parsley-error @enderror" id="name" autofocus
                                                name="name" value="{{ old('name') }}" placeholder="Enter Name" />
                                            @error('name')
                                            <small class="text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mt-4">
                                            <button type="submit" class="btn btn-primary px-4 float-right">Save</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!-- end form -->
            </div>
        </div>
        <!--end page-title-box-->
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('[name="all_permission"]').on('click', function() {

        if ($(this).is(':checked')) {
            $.each($('.permission'), function() {
                $(this).prop('checked', true);
            });
        } else {
            $.each($('.permission'), function() {
                $(this).prop('checked', false);
            });
        }

    });
});
</script>
@endpush
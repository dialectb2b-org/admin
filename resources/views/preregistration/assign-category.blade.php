@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Pre-Registration</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pre-registration.index') }}">Pre-Registration</a></li>
                        <li class="breadcrumb-item active"> Assign Business Category</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('pre-registration.show',$company->id) }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back <i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end page-title-box-->
    </div>
    <!--end col-->
</div>
<!--end row-->
            
<div class="row">
                <!-- Form -->
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fas fa-plus"></i> Assign Business Category</h4>
                            <!-- <p class="text-muted mb-0">Custom stylr example.</p> -->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <h4>{{ $company->name }}</h4>
                                        <input id="company_id" type="hidden" value="{{ $company->id }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="code">Email</label>
                                        <h4>{{ $company->email }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="code">Country</label>
                                        <h4>{{ $company->country->name ?? '' }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="code">Categories</label>
                                        <h4>{{ $company->temp_categories ?? '' }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="code">Search Business Category</label>
                                        <input type="keyword"
                                            class="form-control @error('keyword') parsley-error @enderror"
                                            id="search-category" name="keyword" value=""
                                            placeholder="Search Business Category..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="list-group list-group-horizontal-md">
                                    <span class="btn btn-outline-secondary btn-sm m-1" onClick="window.location.reload();">All</span>
                                        @foreach(range('A', 'Z') as $char)
                                        <span class="btn btn-outline-secondary btn-sm alpha-category m-1" data-alpha="{{ $char }}">
                                            {{ $char }}</span>
                                        @endforeach
                                    </ul>
                                    <!--end list-group-->
                                </div>
                                <div class="col-md-8 mt-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 id="" class="card-title">Category</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div id="cat-list">
                                                    @foreach($categories as $key => $cat)
                                                    <span class="badge rounded-pill badge-outline-primary category m-1" data-id="{{ $cat->id }}"
                                                        data-name="{{ $cat->name }}">
                                                        {{ $cat->name ?? '' }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 id="cat-selected" class="card-title">Sub Category</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <ul class="list-group list-group-flush" id="subcat-list">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 id="cat-selected" class="card-title">Selected Categories</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <ul class="list-group list-group-flush" id="selected-list">
                                                    @foreach($company->activities as $act)
                                                    <li class="list-group-item">{{ $act->service->name ?? '' }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!-- end form -->
            
        
    
    <input id="token" type="hidden" value="{{ csrf_token() }}" />
</div>

<!--end row-->
@push('scripts')

<script>
$(document).ready(function() {
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    var token = $('#token').val();
    $("#search-category").keyup(function() {
        var keyword = $(this).val();
        if (keyword) {
            $.ajax({
                type: "POST",
                url: "{{ route('search-category') }}",
                data: {
                    '_token': token,
                    'keyword': keyword
                },
                beforeSend: function() {
                    $("#subcat-list").empty();
                    $('#cat-selected').text('Sub Category');
                    $("#subcat-list").html('<div class="d-flex justify-content-center"><div class="spinner-grow text-primary" role="status"> <span class="sr-only">Loading...</span></div></div>');
                },
                success: function(res) {
                    if (res) {
                        $('#subcat-list').empty();
                        $.each(res, function(key, value) {
                            $("#subcat-list").append('<li class="list-group-item subcategory" data-id="' + res[key].id + '" data-name="' + res[key].name + '">' + res[key].name + '</li>');
                        });
                    }
                }
            });
        }
    });

    $(".alpha-category").click(function() {
        var keyword = $(this).data('alpha');
        $(".alpha-category").removeClass('active');
        $(this).addClass('active');
        if (keyword) {
            $.ajax({
                type: "POST",
                url: "{{ route('search-alpha-category') }}",
                data: {
                    '_token': token,
                    'keyword': keyword
                },
                beforeSend: function() {
                    $("#cat-list").empty();
                    $("#subcat-list").empty();
                    $('#cat-selected').text('Sub Category');
                    $("#cat-list").html('<div class="d-flex justify-content-center"><div class="spinner-grow text-primary" role="status"> <span class="sr-only">Loading...</span></div></div>'
                    );
                },
                success: function(res) {
                    if (res) {
                        $("#cat-list").empty();
                        $('#subcat-list').empty();
                        $.each(res, function(key, value) {
                            $("#cat-list").append('<span class="badge rounded-pill badge-outline-primary category m-1" category" data-id="' + res[key].id + '" data-name="' + res[key].name +'">' + res[key].name + '</span>');
                        });
                    }
                }
            });
        }
    });
    $(document.body).on('click', '.category', function() {
        var cat_id = $(this).data('id');
        var cat_name = $(this).data('name');
        if (cat_id) {
            $.ajax({
                type: "POST",
                url: "{{ route('search-sub-category') }}",
                data: {
                    '_token': token,
                    'cat_id': cat_id
                },
                beforeSend: function() {
                    $("#subcat-list").empty();
                    $('#cat-selected').text('');
                    $("#subcat-list").html( '<div class="d-flex justify-content-center"><div class="spinner-grow text-primary" role="status"> <span class="sr-only">Loading...</span></div></div>');
                },
                success: function(res) {
                    $('#cat-selected').text(cat_name);
                    $('#subcat-list').empty();
                    if (res) {
                        $.each(res, function(key, value) {
                            var name = res[key].name.charAt(0);
                            let letter = name.toUpperCase();
                            $("#subcat-list").append('<li class="list-group-item subcategory" data-id="' +res[key].id + '" data-name="' + res[key].name +'">' + res[key].name + '</li>');
                        });
                    } else {
                        $('#subcat-list').append('<li class="list-group-item">No Data Found!</li>');
                    }
                }
            });
        }
    });

    $(document.body).on('click', '.subcategory', function() {
        var subcat_id = $(this).data('id');
        var company_id = $('#company_id').val();
        if (subcat_id && company_id) {
            $.ajax({
                type: "POST",
                url: "{{ route('save-category') }}",
                data: {
                    '_token': token,
                    'subcategory_id': subcat_id,
                    'company_id': company_id
                },
                beforeSend: function() {

                },
                success: function(res) {
                    if (res == 1) {
                        Swal.mixin({
                            toast: !0,
                            position: "top-end",
                            showConfirmButton: !1,
                            timer: 3e3,
                            timerProgressBar: !0,
                        }).fire({
                            icon: "warning",
                            title: "Business category already exists"
                        });
                    } else {
                        Swal.mixin({
                            toast: !0,
                            position: "top-end",
                            showConfirmButton: !1,
                            timer: 3e3,
                            timerProgressBar: !0,
                        }).fire({
                            icon: "success",
                            title: "Business category assigned!"
                        });
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('get-categories') }}",
                        data: {
                            '_token': token,
                            'company_id': company_id
                        },
                        beforeSend: function() {
                            $("#selected-list").empty();
                            $("#selected-list").html( '<div class="d-flex justify-content-center"><div class="spinner-grow text-primary" role="status"> <span class="sr-only">Loading...</span></div></div>');
                        },
                        success: function(res) {
                        console.log(res);
                            $("#selected-list").empty();
                            $.each(res, function(key, value) {
                                $("#selected-list").append('<li class="list-group-item" data-id="' + res[key].service.id + '" data-name="' + res[key].service.name +'">' + res[key].service.name + '</li>');
                            });
                        }
                    });
                }
            });
        }

    });
});
</script>
@endpush
@endsection
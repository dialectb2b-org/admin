@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Relative Sub Category</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.subcatlist',$category->id) }}">{{ $category->name }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.subcatlist',$category->id) }}">{{ $subcategory->name }}</a></li>
                        <li class="breadcrumb-item active">Relative Sub Category</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('category.subcatlist',$category->id) }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <!-- Form -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add New Relative Subcategory</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('relative.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Select Sub Category</label>
                                        <input type="text" value="{{ $subcategory->name ?? '' }}" class="form-control @error('parent') parsley-error @enderror" readonly/>
                                        <input type="hidden" name="parent" value="{{ $subcategory->id ?? '' }}"/>
                                        @error('parent')
                                        <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0 table-centered">
                                        <thead>
                                            <tr>
                                                <th>-</th>
                                                <th>Sub Category</th>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <input type="text"
                                                        class="form-control @error('keyword') parsley-error @enderror"
                                                        id="search-subcategory" name="search"
                                                        placeholder=" Search Subcategory By Name / Code ..." />
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody id="content-placeholder">

                                        </tbody>
                                    </table>
                                    <!--end /table-->
                                </div>
                                <!--end /tableresponsive-->
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary px-4">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ $subcategory->name ?? '' }} -
                                {{ $subcategory->code ?? '' }}</h4>
                            <!-- <p class="text-muted mb-0">Custom stylr example.</p> -->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <table class="table mb-0 table-centered">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Sub Category Name</th>
                                        <th>Sub Category Code</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subcategories as $key => $subcategory)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $subcategory->relative->name ?? '' }}</td>
                                        <td>{{ $subcategory->relative->code ?? '' }}</td>
                                        <td class="text-right">
                                            <div class="dropdown d-inline-block">
                                                <a class="dropdown-toggle arrow-none" id="dLabel11"
                                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dLabel11">
                                                    <a class="dropdown-item"
                                                        href="{{ route('relative.unlink',$subcategory->id) }}">Unlink</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end /table-->
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
<input type="hidden" id="fetch-subcategory-url" value="{{ route('relative.fetchSubCategories') }}"/>
<!--end row-->
@push('scripts')
<script>
    $(function() {
        // Search Sub Category
        var fetchSubCategoryUrl = $('#fetch-subcategory-url').val();
        var token = $('meta[name="csrf-token"]').attr('content');
        $("#search-subcategory").autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url:fetchSubCategoryUrl,
                    type: 'post',
                    dataType: "json",
                    data:{
                        _token: token, 
                        search:request.term
                    },
                    beforeSend: function() {
                        $('#search-indicator').html('<div><span class="spinner-border spinner-border-custom-4 text-primary" role="status"></span><span class="ml-4">Please wait! Searching...</span></div>');
                    },
                    success: function( data ) {
                        if(data.length > 0){
                            response( data );
                        }
                        else{
                            $('#search-subcategory').val('');
                            $('#search-indicator').html('<div class="text-danger">No Data Found!</div>');
                            return false;
                        }
                    }
                });
            },
            select: function (event, ui) {
                setContent(ui.item);
                $('#search-indicator').html('');
                return false;
            }
        });

        function setContent(data){
            var rowindex;
            if(data){
                var flag = 1;
                $(".subcategory_id").each(function(i) {
                    if ($(this).val() == data.id) {
                        rowindex = i;
                        Swal.mixin({
                            toast: !0,
                            position: "top-end",
                            showConfirmButton: !1,
                            timer: 3e3,
                            timerProgressBar: !0,
                            }).fire({ icon: "warning", title: "Sub Category already exists in the list" });
                            $('#search-subcategory').val('');   
                        flag = 0;
                    }
                });
                if(flag){
                    var newRow = $("<tr>");
                    var cols = '';
                    cols += '<td><button class="btn btn-sm btn-danger remove" type="button">-</button></td>';
                    cols += '<td><input class="subcategory_id" name="subcategory_id[]" type="hidden"  value="'+data.id+'" required/>'+data.value+'</td>';
                    newRow.append(cols);
                    $("#content-placeholder").append(newRow);
                    $('#search-subcategory').val('');
                    rowindex = newRow.index(); 
                }
            }
            else{
                $('#search-indicator').html('<div class="text-danger">Something went wrong! Try again</div>');
            }
        }
    });
    
</script>
@endpush
@endsection
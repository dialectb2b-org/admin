@extends('layouts.app')
@section('content')
<style>
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #ffffff;
            background: #2196f3;
            padding: 3px 7px;
            border-radius: 3px;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }

	.ui-autocomplete {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    display: none;
    min-width: 160px;   
    padding: 4px 0;
    margin: 0 0 10px 25px;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
}

.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}

.ui-state-hover, .ui-state-active {
    color: #ffffff;
    text-decoration: none;
    background-color: #0088cc;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    background-image: none;
}
  

</style>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Subcategory</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.subcatlist',$category->id) }}">{{ $category->name }}</a></li>
                        <li class="breadcrumb-item active">Add New Subcategory</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('category.subcatlist',$category->id) }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back <i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- Form -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Subcategory</h4>
                        <!-- <p class="text-muted mb-0">Custom stylr example.</p> -->
                    </div><!--end card-header-->
                    <div class="card-body">
                        <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <input type="text" class="form-control @error('category_id') parsley-error @enderror"
                                               id="category_name_id" name="category_name" value="{{ $category->name }}" readonly />
                                        <input id="category_id" type="hidden" name="category_id" value="{{ $category->id }}" /> 
                                        @error('category_id')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') parsley-error @enderror"
                                               id="name" name="name" value="{{ old('name') }}" placeholder="Enter name" />
                                        <input id="cat_id" type="hidden" name="cat_id" value=""/>       
                                        @error('name')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" class="form-control @error('code') parsley-error @enderror" 
                                               id="codefield" name="code" value="{{ $category->id }}.{{$sub+1}}" placeholder="Enter code"/>
                                        @error('code')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                        <p id="code-text"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tags">Keywords [ Seperate keywords with semicolon(;) ]</label>
                                        <textarea type="text" class="form-control @error('keywords') parsley-error @enderror" 
                                               name="keywords" data-role="tagsinput" placeholder="Enter keywords" id="tags"  ></textarea> 
                                        @error('keywords')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right mt-4">
                                    <button type="submit" class="btn btn-primary px-4">Save</button>
                                </div>
                            </div>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div>
            <!-- end form -->
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->   
@push('scripts')
<script>    
var category_id = $('#category_id').val();
$("#name").autocomplete({
	source: function( request, response ) {
		$.ajax({
			url:"{{ route('fetchSubName') }}",
			type: 'post',
			dataType: "json",
			data:{
				_token: "{{ csrf_token() }}", 
				search:request.term
			},
			success: function( data ) {
				$('#cat_id').val('');
                $('#codefield').val('');
				if(data.length >= 1){
                    response( data );
				}
				else{
					getCode(category_id)
			    }
            }
		});
	},
	select: function (event, ui) {
		$('#name').val(ui.item.label);
		$('#cat_id').val(ui.item.id);
		$('#codefield').val(ui.item.code);
        $('#code-text').text('');
		return false;
	}
});

function getCode(category_id){
    $('#code-text').text('Generating code. please wait...');
        $.ajax({
            url:"{{ route('getLatestCode') }}",
            type: 'post',
            data:{
                _token: "{{ csrf_token() }}", 
                category_id:category_id,
            },
            success: function(res) {
                $('#code-text').text('');
                $('#codefield').val(res);
            }
        });	
}
</script>
@endpush
@endsection
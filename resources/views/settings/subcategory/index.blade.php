@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Subcategory</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Subcategory</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- table -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Select Category</h4>
                        <form id="category-search" action="{{ route('subcategory.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search Subcategory By Name, Code" id="keyword" name="keyword">
                                    </div>
                                    <input type="hidden" id="category_id" name="category_id"/>
                                </div> 
                            </div> 
                        </form>   
                    </div><!--end card-header-->
                    <div class="card-body">
                        <p>Sub Categories of <strong class="text-danger">{{ $category->name ?? '' }} --- {{ $category->code ?? '' }}  </strong></p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-centered">
                                <thead>
                                <tr>
                                    <th>Sl.No.</th>
                                    <th>Sub Category Name</th>
                                    <th>Sub Category Code</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>   
                                @forelse ($subcategories as $key => $subcategory)
                                <tr>
                                    <td>{{$key + $subcategories->firstItem()}}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ $subcategory->code }}</td>
                                    <td><span class="badge badge-pill badge-{{ ($subcategory->status == 1) ? 'primary' : 'secondary' }}">
                                        {{ ($subcategory->status == 1) ? 'Active' : 'Disabled' }}
                                    </span></td>
                                    <td class="text-right">
                                        <div class="dropdown d-inline-block">
                                            <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">
                                                <a class="dropdown-item" href="{{ route('subcategory.relatives',[$subcategory->id,$category->id]) }}">Add Relative Category</a>
                                                <a class="dropdown-item" href="{{ url('subcategory/edit/'. $category->id.'/'.$subcategory->id) }}">Edit</a>
                                                <a class="dropdown-item" href="{{ url('subcategory/show/'. $category->id.'/'.$subcategory->id) }}">Show</a>
                                                <a class="dropdown-item" href="{{ route('subcategory.subcatdisable',$subcategory->id) }}">{{ $subcategory->status == 1 ? 'Disable' : 'Enable' }}</a>
                                                <a class="dropdown-item removeentry" href="#" data-id="{{ $subcategory->id }}" data-action="{{ route('subcategory.destroy',$subcategory->id) }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center">No Data Found!</td></tr>
                                @endforelse
                                <tr><td colspan="7">&nbsp;</td></tr>    
                                </tbody>
                            </table><!--end /table-->
                        </div><!--end /tableresponsive-->
                        {{ $subcategories->links('layouts.partials.pagination') }} 
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!-- end col -->
            <!-- end table -->
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script>
$("#keyword").autocomplete({
	source: function( request, response ) {
		$.ajax({
			url:"{{ route('fetchCatNames') }}",
			type: 'post',
			dataType: "json",
			data:{
				_token: "{{ csrf_token() }}", 
				search:request.term
			},
            beforeSend: function() {
                $('#search-text').text('Loading Categories. please wait...');
            },
			success: function( data ) {
				if(data.length > 0){
                    response( data );
				}
				else{
					
			    }
            }
		});
	},
	select: function (event, ui) {
		$('#keyword').val(ui.item.label);
		$('#category_id').val(ui.item.id);
        $('#category-search')[0].submit();
		return false;
	}
});
</script>  
@endsection
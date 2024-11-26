@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Notification</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Notification</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-outline-primary" title="Refresh">
                        Refresh<i class="ml-2 fas fa-sync"></i>
                    </a>
                    <a href="{{ route('notifications.create') }}" class="btn btn-sm btn-outline-primary" title="Add New Notification">
                        Add New Notification<i class="ml-2 fas fa-plus"></i>
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back <i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- table -->
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-centered">
                                <tbody>   
                                @forelse ($notifications as $key => $notification)
                                <tr>
                                    <td>
                                        <p>{{ $notification->title ?? '' }}</p>
                                        <p>{{ $notification->message }}</p>
                                    </td>
                                    <!--<td class="text-right">-->
                                    <!--    <div class="dropdown d-inline-block">-->
                                    <!--        <a class="dropdown-toggle arrow-none" id="dLabel11" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">-->
                                    <!--            <i class="fas fa-ellipsis-v font-20 text-muted"></i>-->
                                    <!--        </a>-->
                                    <!--        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel11">-->
                                    <!--            <a class="dropdown-item" href="{{ route('notifications.show',$notification->id) }}">Show</a>-->
                                    <!--            <a class="dropdown-item" href="{{ route('notifications.edit',$notification->id) }}">Edit</a>-->
                                    <!--            <a class="dropdown-item removeentry" href="#" data-id="{{ $notification->id }}" data-action="{{ route('notifications.destroy',$notification->id) }}">Delete</a>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</td>-->
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center">No Data Found!  <a href="{{ route('notifications.create') }}"> <strong> Add New Notification</strong> </a></td></tr>
                                @endforelse
                                <tr><td colspan="7">&nbsp;</td></tr>    
                            </tbody>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                    {{ $notifications->links('layouts.partials.pagination') }} 
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
        <!-- end table -->
    </div>
</div><!--end page-title-box-->
</div><!--end col-->
</div><!--end row-->   
@endsection
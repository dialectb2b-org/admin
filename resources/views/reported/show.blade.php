@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i>Reported Enquiries</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reported.index') }}">Reported Enquiries</a></li>
                        <li class="breadcrumb-item active">View Spam/Junk</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('reported.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back<i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dastone-profile">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Left sidebar -->
                                        <div class="email-leftbar">
                                            <div class="card mt-3">
                                                <div class="card-body">
                                                    <div class="mail-list">
                                                        <a href="#"><b>Category</b><br> {{ $mail->category }}</a>
                                                        <a href="#"><b>Type : </b><br> {{ $mail->type }}</a>
                                                        <a href="#"><b>Reported On : </b><br> {{ $mail->created_at }}</a>
                                                        <a href="#"><b>Reported By </b><br> {{ $mail->reporter->name ?? '' }}<br>{{ $mail->reporter->company->name ?? '' }}<br> {{ $mail->reporter->email ?? '' }}</a>
                                                    </div>   
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div>
                                        <!-- End Left sidebar -->


                                        <!-- Right Sidebar -->
                                        <div class="email-rightbar">
                                            <div class="card mt-3">
                                                <div class="card-body">
                                                    <div class="media mb-4">
                                                        <div class="media-body align-self-center">
                                                            <h5 class="font-14 m-0">{{ $mail->enquiry->sender->name ?? '' }}</h5>
                                                            <h5 class="font-14 m-0">{{ $mail->enquiry->sender->company->name  ?? '' }}</h5>
                                                            <small class="text-muted">{{ $mail->enquiry->sender->email ?? '' }}</small>
                                                            
                                                        </div>
                                                    </div>
                                                    <h4 class="mt-0 font-15">{{ $mail->enquiry->subject ?? '' }}</h4>
                                                    <p><b>Reference No : {{ $mail->enquiry->reference_no ?? '' }}</p>
                                                    <p>{!! $mail->enquiry->body ?? ''  !!}</p>
                                                    <hr class="hr-dashed">
                                                   

                                                </div>
                                                <div class="card-body">
                                                    @if($mail->category == 'question')
                                                    <h5 class="font-14 m-0"></h5>
                                                    <h4 class="mt-0 font-15">{{ $mail->question->question ?? '' }}</h4>
                                                    <p>{{ $mail->question->answer ?? '' }}</p>
                                                    @endif

                                                </div>
                                            </div>  
                                        </div> <!-- end email-rightbar -->
                                    </div><!-- end Col -->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end f_profile-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
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
@endsection
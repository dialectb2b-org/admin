@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Packages</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('packages.index') }}">Package Manager</a></li>
                        <li class="breadcrumb-item active">Show Package</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('packages.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        Go Back <i class="ml-2 fas fa-arrow-left"></i>
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- Form -->
            <div class="col">
                <div class="card">
                  
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') parsley-error @enderror"
                                               id="name" name="name" value="{{ $package->name ?? '' }}" readonly />
                                        @error('name')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rate">Rate</label>
                                        <input type="text" class="form-control @error('rate') parsley-error @enderror" 
                                               id="rate" name="rate" value="{{ $package->rate ?? '' }}" readonly />
                                        @error('rate')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="duration">Duration In Months</label>
                                        <input type="number" class="form-control @error('duration') parsley-error @enderror" 
                                               id="duration" name="duration" value="{{ $package->duration ?? '' }}" readonly />
                                        @error('duration')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                     <h3>Procurement User Account</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="procurement_enquiry_receive_limit">No. of send items per month ?</label>
                                        <input type="procurement_enquiry_receive_limit" class="form-control @error('procurement_enquiry_receive_limit') parsley-error @enderror" 
                                                id="procurement_enquiry_receive_limit" name="procurement_enquiry_receive_limit" value="{{ $package->procurement_enquiry_receive_limit ?? '' }}" readonly/>
                                        @error('procurement_enquiry_receive_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="procurement_proposal_receiving_limit">No. of proposal received per month ?</label>
                                        <input type="number" class="form-control @error('procurement_proposal_receiving_limit') parsley-error @enderror" 
                                                id="procurement_proposal_receiving_limit" name="procurement_proposal_receiving_limit" value="{{ $package->procurement_proposal_receiving_limit ?? '' }}" readonly/>
                                        @error('procurement_proposal_receiving_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="procurement_member_apprroval_limit">No. of member enquiry approvals per month ?</label>
                                        <input type="number" class="form-control @error('procurement_member_apprroval_limit') parsley-error @enderror" 
                                                id="procurement_member_apprroval_limit" name="procurement_member_apprroval_limit" value="{{ $package->procurement_member_apprroval_limit ?? '' }}" readonly/>
                                        @error('procurement_member_apprroval_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="procurement_limited_enquiry_limit">No. of limited enquiries per month ?</label>
                                        <input type="number" class="form-control @error('procurement_limited_enquiry_limit') parsley-error @enderror" 
                                                id="procurement_limited_enquiry_limit" name="procurement_limited_enquiry_limit" value="{{ $package->procurement_limited_enquiry_limit ?? '' }}" readonly />
                                        @error('procurement_limited_enquiry_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="procurement_review_quote_limit">No. of quotations reviews per month ?</label>
                                        <input type="number" class="form-control @error('procurement_review_quote_limit') parsley-error @enderror" 
                                                id="procurement_review_quote_limit" name="procurement_review_quote_limit" value="{{ $package->procurement_review_quote_limit ?? '' }}" readonly/>
                                        @error('procurement_review_quote_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="procurement_inbox_validity">Inbox validity in months ?</label>
                                        <input type="number" class="form-control @error('procurement_inbox_validity') parsley-error @enderror" 
                                                id="procurement_inbox_validity" name="procurement_inbox_validity" value="{{ $package->procurement_inbox_validity ?? '' }}" readonly/>
                                        @error('procurement_inbox_validity')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                     <h3>Sales User Account</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sales_enquiry_receive_limit">No. of send items per month ?</label>
                                        <input type="number" class="form-control @error('sales_enquiry_receive_limit') parsley-error @enderror" 
                                                id="sales_enquiry_receive_limit" name="sales_enquiry_receive_limit" value="{{ $package->sales_enquiry_receive_limit ?? '' }}" readonly />
                                        @error('sales_enquiry_receive_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sales_respond_enquiry_limit">No. of enquiry received per month ?</label>
                                        <input type="number" class="form-control @error('sales_respond_enquiry_limit') parsley-error @enderror" 
                                                id="sales_respond_enquiry_limit" name="sales_respond_enquiry_limit" value="{{ $package->sales_respond_enquiry_limit ?? '' }}" readonly />
                                        @error('sales_respond_enquiry_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="sales_limited_enquiry_participation_limit">No. of limited enquiry participation per month ?</label>
                                        <input type="number" class="form-control @error('sales_limited_enquiry_participation_limit') parsley-error @enderror" 
                                                id="sales_limited_enquiry_participation_limit" name="sales_limited_enquiry_participation_limit" value="{{ $package->sales_limited_enquiry_participation_limit ?? '' }}" readonly />
                                        @error('sales_limited_enquiry_participation_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sales_faq_option">Sales FAQ Option ?</label>
                                        <input type="number" class="form-control @error('sales_faq_option') parsley-error @enderror" 
                                                id="sales_faq_option" name="sales_faq_option" value="{{ $package->sales_faq_option ?? '' }}" readonly/>
                                        @error('sales_faq_option')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="sales_inbox_validity">Sales Inbox Validity In Months?</label>
                                        <input type="number" class="form-control @error('sales_inbox_validity') parsley-error @enderror" 
                                                id="sales_inbox_validity" name="sales_inbox_validity" value="{{ $package->sales_inbox_validity ?? '' }}" readonly/>
                                        @error('sales_inbox_validity')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                     <h3>Member User Account</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="member_enquiry_limit">No. of send items per month ?</label>
                                        <input type="number" class="form-control @error('member_enquiry_limit') parsley-error @enderror" 
                                                id="member_enquiry_limit" name="member_enquiry_limit" value="{{ $package->member_enquiry_limit ?? '' }}" readonly/>
                                        @error('member_enquiry_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="member_proposal_receive_limit">No. of proposal received per month ?</label>
                                        <input type="number" class="form-control @error('member_proposal_receive_limit') parsley-error @enderror" 
                                                id="member_proposal_receive_limit" name="member_proposal_receive_limit" value="{{ $package->member_proposal_receive_limit ?? '' }}" readonly/>
                                        @error('member_proposal_receive_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="member_limited_enquiry_limit">No. of limited enquiries per month ?</label>
                                        <input type="number" class="form-control @error('member_limited_enquiry_limit') parsley-error @enderror" 
                                                id="member_limited_enquiry_limit" name="member_limited_enquiry_limit" value="{{ $package->member_limited_enquiry_limit ?? '' }}" readonly/>
                                        @error('member_limited_enquiry_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="member_review_quote_limit">No. of quotations reviews per month ?</label>
                                        <input type="number" class="form-control @error('member_review_quote_limit') parsley-error @enderror" 
                                                id="member_review_quote_limit" name="member_review_quote_limit" value="{{ $package->member_review_quote_limit ?? '' }}" readonly/>
                                        @error('member_review_quote_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="member_inbox_validity">Inbox validity in months ?</label>
                                        <input type="number" class="form-control @error('member_inbox_validity') parsley-error @enderror" 
                                                id="member_inbox_validity" name="member_inbox_validity" value="{{ $package->member_inbox_validity ?? '' }}" readonly/>
                                        @error('member_inbox_validity')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
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
@endsection
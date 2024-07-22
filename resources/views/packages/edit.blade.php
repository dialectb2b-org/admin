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
                        <li class="breadcrumb-item active">Edit Package</li>
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
                  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <div class="card-body">
                        <form action="{{ route('packages.update',$package->id) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') parsley-error @enderror"
                                               id="name" name="name" value="{{ $package->name ?? '' }}" />
                                        @error('name')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rate">Rate Per Month</label>
                                        <input type="text" class="form-control @error('rate') parsley-error @enderror" onkeypress="return isNumberKey(event)"
                                               id="rate" name="rate" value="{{ $package->rate ?? '' }}"/>
                                        @error('rate')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <!--<div class="col-md-3">-->
                                <!--    <div class="form-group">-->
                                <!--        <label for="duration">Duration In Months</label>-->
                                <!--        <input type="number" class="form-control @error('duration') parsley-error @enderror" -->
                                <!--               id="duration" name="duration" value="{{ $package->duration ?? '' }}" min="0"/>-->
                                <!--        @error('duration')-->
                                <!--            <small class="text text-danger">{{ $message }}</small>-->
                                <!--        @enderror-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                     <h3>Procurement User Account</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="procurement_generate_rfq_limit">Generate RFQ</label>
                                        <select id="procurement_generate_rfq_limit"  name="procurement_generate_rfq_limit" class="form-control @error('procurement_generate_rfq_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->procurement_generate_rfq_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->procurement_generate_rfq_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('procurement_generate_rfq_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="procurement_proposal_receiving_limit">Proposal Reception</label>
                                        <select id="procurement_proposal_receiving_limit"  name="procurement_proposal_receiving_limit" class="form-control @error('procurement_proposal_receiving_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->procurement_proposal_receiving_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->procurement_proposal_receiving_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('procurement_proposal_receiving_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="procurement_limited_enquiry_limit">Generate Limited Vendor RFQ</label>
                                        <select id="procurement_limited_enquiry_limit"  name="procurement_limited_enquiry_limit" class="form-control @error('procurement_limited_enquiry_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->procurement_limited_enquiry_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->procurement_limited_enquiry_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('procurement_limited_enquiry_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="procurement_review_quote_limit">Bid Review</label>
                                        <select id="procurement_review_quote_limit"  name="procurement_review_quote_limit" class="form-control @error('procurement_review_quote_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->procurement_review_quote_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->procurement_review_quote_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('procurement_review_quote_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="procurement_inbox_validity">Transaction History</label>
                                        <select id="procurement_inbox_validity"  name="procurement_inbox_validity" class="form-control @error('procurement_inbox_validity') parsley-error @enderror">
                                            <option value="-" {{ $package->procurement_inbox_validity == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->procurement_inbox_validity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
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
                                        <label for="sales_enquiry_receive_limit">Enquiry Reception</label>
                                        <select id="sales_enquiry_receive_limit"  name="sales_enquiry_receive_limit" class="form-control @error('sales_enquiry_receive_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->sales_enquiry_receive_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->sales_enquiry_receive_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('sales_enquiry_receive_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sales_respond_enquiry_limit">Responding to Enquiry</label>
                                        <select id="sales_respond_enquiry_limit"  name="sales_respond_enquiry_limit" class="form-control @error('sales_respond_enquiry_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->sales_respond_enquiry_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->sales_respond_enquiry_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('sales_respond_enquiry_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="sales_limited_enquiry_participation_limit">Limited Vendor Enquiry Participation</label>
                                        <select id="sales_limited_enquiry_participation_limit"  name="sales_limited_enquiry_participation_limit" class="form-control @error('sales_limited_enquiry_participation_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->sales_limited_enquiry_participation_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->sales_limited_enquiry_participation_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('sales_limited_enquiry_participation_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sales_faq_option">FAQ Access for Enquiry</label>
                                        <select id="sales_faq_option"  name="sales_faq_option" class="form-control @error('sales_faq_option') parsley-error @enderror">
                                            <option value="-" {{ $package->sales_faq_option == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="-" {{ $package->sales_faq_option == 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                        @error('sales_faq_option')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="sales_inbox_validity">Transaction History</label>
                                        <select id="sales_inbox_validity"  name="sales_inbox_validity" class="form-control @error('sales_inbox_validity') parsley-error @enderror">
                                            <option value="-" {{ $package->sales_inbox_validity == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->sales_inbox_validity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
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
                                        <label for="member_enquiry_limit">Generate RFQ</label>
                                        <select id="member_enquiry_limit"  name="member_enquiry_limit" class="form-control @error('member_enquiry_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->member_enquiry_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->member_enquiry_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('member_enquiry_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="member_proposal_receive_limit">Proposal Reception</label>
                                        <select id="member_proposal_receive_limit"  name="member_proposal_receive_limit" class="form-control @error('member_proposal_receive_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->member_proposal_receive_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->member_proposal_receive_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('member_proposal_receive_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="member_limited_enquiry_limit">Generate limited vendor RFQ</label>
                                        <select id="member_limited_enquiry_limit"  name="member_limited_enquiry_limit" class="form-control @error('member_limited_enquiry_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->member_limited_enquiry_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->member_limited_enquiry_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('member_limited_enquiry_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">    
                                    <div class="form-group">
                                        <label for="member_review_quote_limit">Bid Review</label>
                                        <select id="member_review_quote_limit"  name="member_review_quote_limit" class="form-control @error('member_review_quote_limit') parsley-error @enderror">
                                            <option value="-" {{ $package->member_review_quote_limit == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->member_review_quote_limit == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('member_review_quote_limit')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="member_inbox_validity">Transaction History</label>
                                        <select id="member_inbox_validity"  name="member_inbox_validity" class="form-control @error('member_inbox_validity') parsley-error @enderror">
                                            <option value="-" {{ $package->member_inbox_validity == '-' ? 'selected' : '' }}>No Limitation</option>
                                            @for ($i = 0; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $package->member_inbox_validity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('member_inbox_validity')
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

            function isNumberKey(evt)
            {
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode != 46 && charCode > 31 
                    && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }

        </script>
    @endpush
@endsection
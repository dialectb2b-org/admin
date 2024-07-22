@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title"><i class="fas fa-home mr-1"></i> Country</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('country.index') }}">Country</a></li>
                        <li class="breadcrumb-item active">View Country</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    <a href="{{ route('country.index') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                </div><!--end col-->  
            </div><!--end row-->  
            <div class="row">
            <!-- Form -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">View Country</h4>
                        <!-- <p class="text-muted mb-0">Custom stylr example.</p> -->
                    </div><!--end card-header-->
                    <div class="card-body">
                       <table>
                           <tr>
                                <td>Name</td>
                                <th>&nbsp;: {{ $country->name }}</th>
                            </tr>
                            <tr>
                                <td>iso3</td>
                                <th>&nbsp;: {{ $country->iso3 }}</th>
                            </tr>
                            <tr>
                                <td>iso2</td>
                                <th>&nbsp;: {{ $country->iso2 }}</th>
                            </tr>
                            <tr>
                                <td>Numeric code</td>
                                <th>&nbsp;: {{ $country->numeric_code }}</th>
                            </tr>
                            <tr>
                                <td>Phonecode</td>
                                <th>&nbsp;: {{ $country->phonecode }}</th>
                            </tr>
                            <tr>
                                <td>Capital</td>
                                <th>&nbsp;: {{ $country->capital }}</th>
                            </tr>
                            <tr>
                                <td>Currency</td>
                                <th>&nbsp;: {{ $country->currency }}</th>
                            </tr>
                            <tr>
                                <td>Currency Name</td>
                                <th>&nbsp;: {{ $country->currency_name }}</th>
                            </tr>
                            <tr>
                                <td>Currency Symbol</td>
                                <th>&nbsp;: {{ $country->currency_symbol }}</th>
                            </tr>
                            <tr>
                                <td>tld</td>
                                <th>&nbsp;: {{ $country->tld }}</th>
                            </tr>
                            <tr>
                                <td>Native</td>
                                <th>&nbsp;: {{ $country->native }}</th>
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
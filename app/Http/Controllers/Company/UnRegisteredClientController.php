<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyActivity;
use App\Models\CompanyLocation;
use App\Models\CompanyDocument;
use App\Models\Region;
use App\Models\CompanyUser;
use App\Models\SubCategory;
use App\Models\Payment;

class UnRegisteredClientController extends Controller
{

    public function index(Request $request){
        $query = Company::with('country','checklist','document');
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $clients = $query->where('is_approved',0)
                         ->where('status',0)
                         ->where('is_superseded',0)
                         ->paginate(10);
        return view('client.unregistered.index',compact('clients'));
    }

    public function show($id)
    {   
        $company = Company::with('country','activities','locations','document')->findOrFail($id);
        return view('client.unregistered.show',compact('company'));
    }

}

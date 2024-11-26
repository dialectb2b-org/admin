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

class ClientController extends Controller
{

    public function unRegistered(Request $request){
        $query = Company::query();
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $clients = $query->where('status',0)->where('is_superseded','!=',1)
                         ->paginate(10);
        return view('client.unregistered',compact('clients'));
    }

    public function registered(Request $request){
        $query = Company::query();
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $clients = $query->where('is_doc_verified','1')
                         ->where('status',1)->where('is_superseded','!=',1)
                         ->paginate(10);
        return view('client.registered',compact('clients'));
    }

    public function verified(Request $request){
        $query = Company::query();
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $clients = $query->where('is_account_verified','1')
                         ->where('is_doc_verified','1')
                         ->where('status',2)
                         ->paginate(10);
        return view('client.verified',compact('clients'));
    }

    public function superseded(Request $request){
        $query = Company::query();
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $clients = $query->where('is_superseded','1')
                         ->paginate(10);
        return view('client.superseded',compact('clients'));
    }

    public function show($id)
    {   
        $company = Company::findOrFail($id);
        $selectedCompanyActivites = CompanyActivity::where('company_id',$company->id)->pluck('service_id')->toArray();
        $companyActivities = SubCategory::whereIn('id',$selectedCompanyActivites)->get();
        $companyDocuments = CompanyDocument::with('document')->where('company_id',$company->id)->first();
        $selectedCompanyLocations = CompanyLocation::where('company_id',$company->id)->pluck('region_id')->toArray();
        $companyLocations = Region::whereIn('id',$selectedCompanyLocations)->get();
        $payment = Payment::where('company_id',$company->id)->first();
        $users = CompanyUser::where('company_id',$company->id)->get();
        return view('client.show',compact('company','companyActivities','companyLocations','companyDocuments','payment','users'));
    }

    public function verifyDocument($id){
        $company = Company::findOrFail($id);
        $companyDocuments = CompanyDocument::with('document')->where('company_id',$company->id)->first();
        return view('client.verify-document',compact('company','companyDocuments'));
    }

    public function verifyDocumentSave(Request $request){
        $company_id = $request->company_id;
        $companyDocuments = CompanyDocument::with('document')->where('company_id',$company_id)->first();
        $companyDocuments->status = $request->action == 'approve' ? 1 : 0;
        $companyDocuments->save();

        $company = Company::find($company_id);
        $company->is_doc_verified = $request->action == 'approve' ? 1 : 0;
        $company->save();

        return redirect()->route('client.show',$request->company_id);
    }

    public function verifyAccount($id){
        $company = Company::findOrFail($id);
        $payment = Payment::where('company_id',$company->id)->first();
        return view('client.verify-account',compact('company','payment'));
    }

    public function verifyAccountSave(Request $request){
        $company_id = $request->company_id;
        $payment = Payment::where('company_id',$company_id)->first();
        $payment->status = $request->action == 'approve' ? 1 : 0;
        $payment->remark = $request->remarks;
        $payment->save();

        $company = Company::find($company_id);
        $company->is_account_verified = $request->action == 'approve' ? 1 : 0;
        $company_users = CompanyUser::where('company_id',$company_id)->whereNotNull('password')->where('status',1)->get();
        if($company_users->count('id') == 3){
            $company->status = ($request->action == 'approve') ? 2 : 1;
        }
        $company->save();

        return redirect()->route('client.show',$request->company_id);
    }

}

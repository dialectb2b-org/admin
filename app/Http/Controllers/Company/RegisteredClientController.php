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
use App\Models\Notification;

class RegisteredClientController extends Controller
{

    public function index(Request $request){
        $query = Company::with('country');
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $clients = $query->where('status',1)
                         ->where('is_approved',1)
                         ->where('is_superseded',0)
                         ->orderBy('updated_at','asc')
                         ->paginate(10);
        return view('client.registered.index',compact('clients'));
    }

    public function show($id)
    {   
        $company = Company::with('country','activities','locations','document','users')->findOrFail($id);
        return view('client.registered.show',compact('company'));
    }

    public function checklist($id)
    {   
        $company = Company::with('country','activities','locations','document','users')->findOrFail($id);
        return view('client.registered.checklist',compact('company'));
    }
    
    public function nonMandatoryChecklist($id)
    {   
        $company = Company::with('country','activities','locations','document','users')->findOrFail($id);
        $admin = CompanyUser::where(['company_id' => $company->id, 'role' => 1])->first();
        $procurement = CompanyUser::where(['company_id' => $company->id, 'role' => 2])->first();
        $sales = CompanyUser::where(['company_id' => $company->id, 'role' => 3])->first();
        return view('client.registered.non_mandatory_checklist',compact('company','admin','procurement','sales'));
    }
    
    public function nonMandatoryDataRequest(Request $request){
        $admin = CompanyUser::where(['company_id' => $request->company_id, 'role' => 1])->first();
        $procurement = CompanyUser::where(['company_id' => $request->company_id, 'role' => 2])->first();
        $sales = CompanyUser::where(['company_id' => $request->company_id, 'role' => 3])->first();
        if($request->missing_data !== null){
            $data = implode(',', $request->missing_data);
            Notification::create([
                        'company_id' => $request->company_id,
                        'user_id' => $admin->id,
                        'type' => 1,
                        'role' => 1,
                        'title' => 'Profile Updation Request',
                        'message' => 'Please Upldate the following fields - '.$data,
                        'action' => '', 
                        'action_url' => '' 
                    ]);
        }
        
        if($request->procurement_missing_data !== null){
            $procurement_data = implode(',', $request->procurement_missing_data);
            Notification::create([
                        'company_id' => $request->company_id,
                        'user_id' => $procurement->id,
                        'type' => 1,
                        'role' => 2,
                        'title' => 'Profile Updation Request',
                        'message' => 'Please Upldate the following fields - '.$procurement_data,
                        'action' => '', 
                        'action_url' => '' 
                    ]);
        }
        
        if($request->sales_missing_data !== null){
            $sales_data = implode(',', $request->sales_missing_data);
            Notification::create([
                        'company_id' => $request->company_id,
                        'user_id' => $sales->id,
                        'type' => 1,
                        'role' => 3,
                        'title' => 'Profile Updation Request',
                        'message' => 'Please Upldate the following fields - '.$sales_data,
                        'action' => '', 
                        'action_url' => '' 
                    ]);
        }
        
                    
        return redirect()->route('clients.registered.index')->with('success','Request has been send');            
    }

}

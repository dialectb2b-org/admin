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
use App\Models\RegistrationToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;

class ApprovedClientController extends Controller
{

    public function index(Request $request){
        $query = Company::with('country');
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $clients = $query->where('is_approved',1)
                         ->where('status',0)
                         ->where('is_superseded',0)
                         ->paginate(10);
        return view('client.approved.index',compact('clients'));
    }

    public function show($id)
    {   
        $company = Company::with('country','activities','locations','document')->findOrFail($id);
        return view('client.approved.show',compact('company'));
    }

    public function checklist($id){
        $company = Company::with('country','activities','locations','document')->findOrFail($id);
        return view('client.approved.checklist',compact('company'));
    }

    public function revert(Request $request){
        
        $request->validate([
            'company_name' => 'required',
            'country' => 'required',
            'document_type' => 'required',
            'document_no' => 'required',
            'exp_date' => 'required',
            'document' => 'required',
            'declaration' => 'required',
            'declaration_signature' => 'required',
            'declaration_seal' => 'required',
        ]);
        
        $reasons = [];
        $company = Company::with('checklist')->findOrFail($request->company_id);

        // Checklist Looks Good

        if($request->company_name == 1
            && $request->country == 1  
            && $request->declaration == 1  
            && $request->declaration_signature == 1  
            && $request->declaration_seal == 1 
            && $request->document_no == 1  
            && $request->exp_date == 1  
            && $request->document_type == 1
            && $request->document == 1){
            return back()->with('success','No issues found in checklist!');
        }

        // Checklist is problamatic
        
        if($request->company_name == 1){
            $company_name = 1; 
        }
        else{
            $company_name = 0;
            array_push($reasons,'Company name is not matching with company document.');
        }
            
        if($request->country == 1){
            $country = 1; 
        }
        else{
            $country = 0;
            array_push($reasons,'Country of operation is not matching with company document.');
        }

        if($request->declaration == 1){
            $declaration = 1; 
        }
        else{
            $declaration = 0;
            array_push($reasons,'Declaration file uploaded is invalid.');
        }
    
        if($request->declaration_signature == 1){
                $declaration_signature = 1;
        }
        else{
            $declaration_signature = 0;
            array_push($reasons,'Signature is missing or not found in declaration.');
        }
    
        if($request->declaration_seal == 1){
                $declaration_seal = 1;
        }
        else{
                $declaration_seal = 0;
            array_push($reasons,'Company Seal is missing or not clear in declaration.');
        }
    
        if($request->document_no == 1){
                $document_no = 1;
        }
        else{
                $document_no = 0;
            array_push($reasons,'Document Number is not matching with company documents.');
        }
    
        if($request->document_type == 1){
                $document_type = 1;
        }
        else{
            $document_type = 0;
            array_push($reasons,'Invalid Document.');
        }

        if($request->exp_date == 1){
            $expiry_date = 1;
        }
        else{
            $expiry_date = 0;
            array_push($reasons,'Expiry date is not matching with company documents.');
        }
    
        if($request->document == 1){
            $document = 1;
        }
        else{
            $document = 0;
            array_push($reasons,'Document file uploaded is invalid.');
        }

        $company->checklist->update([
            'company_name' => $company_name,
            'country' => $country,
            'declaration' => $declaration,
            'declaration_signature' => $declaration_signature,
            'declaration_seal' => $declaration_seal,
            'declaration_updated_at' => now(),
            'document_no' => $document_no,
            'document_type' => $document_type,
            'document' => $document,
            'document_updated_at' => now(),
        ]);
                

        if($company_name == 0
            || $country == 0
            || $declaration == 0 
            || $declaration_seal == 0
            || $declaration_signature == 0
            || $document == 0
            || $document_type == 0
            || $document_no == 0){

                $remarks = '';
                if($reasons){
                    $remarks = implode(',',$reasons);
                }

                $admin = CompanyUser::where(['company_id' => $company->id, 'role' => 1])->whereNotNull('password')->first();
                if($admin){
                    DB::beginTransaction();
                    try {
                        $company->update(['is_approved' => 2]);
                        $company->checklist->update(['remarks' => $remarks]);
                        $remark = 'Verification declined </br> Reason : '.$remarks.'</br> Make neccesary changes and update from your profile';
                        //$this->setNotification($company,$remark);
                        DB::commit();
                        return redirect()->route('clients.disabled.index');
                    }catch (\Exception $e) {
                        DB::rollback();
                        return back()->with('warning','Something went wrong. Try again!');
                    }
                }

                DB::beginTransaction();

                try {
                    
                    $company->update(['is_approved' => 0]);
                    $company->checklist->update(['remarks' => $remarks]);
                    $plaintext = Str::random(32);
                    $token = RegistrationToken::create([
                            'company_id' => $company->id,
                            'token' => hash('sha256', $plaintext),
                            'expire_at' => now()->addDays(7),
                    ]);
                        
                    $data = array(
                        'company' => $company->name,
                        'remarks' =>  $reasons,
                        'token' => $token->token,
                    );   
                    
                    \Mail::to($company->email)->send(new \App\Mail\RejectionMail($data));

                    DB::commit();
                    return redirect()->route('clients.unregistered.index');
                }catch (\Exception $e) {
                    DB::rollback();
                    return back()->with('warning','Something went wrong. Try again!');
                }
            }
            return redirect()->route('home');
    }

    // public function setNotification($company,$remark){
    //     Notification::create([
    //          'company_id' => $company->id,
    //          'message' => $remark,
    //          'type' => 1,   // warning
    //     ]);

    //     return true;
    // }

}

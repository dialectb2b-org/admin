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
use DB;

class DisabledClientController extends Controller
{

    public function index(Request $request){
        $query = Company::with('country');
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $clients = $query->where('is_approved',2)
                         ->paginate(10);
        return view('client.disabled.index',compact('clients'));
    }

    public function show($id)
    {   
        $company = Company::with('country','activities','locations','document','users','payment')->findOrFail($id);
        return view('client.disabled.show',compact('company'));
    }

    public function checklist($id)
    {   
        $company = Company::with('country','activities','locations','document','users','payment')->findOrFail($id);
        return view('client.disabled.checklist',compact('company'));
    }

    public function disable(Request $request)
    {

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
        if($request->company_name == 1
            && $request->country == 1
            && $request->declaration == 1
            && $request->declaration_signature == 1  
            && $request->declaration_seal == 1 
            && $request->document_no == 1
            && $request->exp_date == 1  
            && $request->document_type == 1
            && $request->document == 1){
              //  && $request->document == 1
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

        // if($request->account == 1){
        //     $account = 1;
        // }
        // else{
        //     $account = 0;
        //     array_push($reasons,'Transaction details are invalid.');
        // }

        DB::beginTransaction();
        try {

            $company->checklist->update([
                'company_name' => $company_name,
                'country' => $country,
                'declaration' => $declaration,
                'declaration_signature' => $declaration_signature,
                'declaration_seal' => $declaration_seal,
                'declaration_updated_at' => now(),
                'document_no' => $document_no,
                'expiry_date' => $expiry_date,
                'document_type' => $document_type,
                'document' => $document,
                'document_updated_at' => now(),
                //'account_verification' => $account,
            ]);

            if($company_name == 0
                || $country == 0
                || $declaration == 0 
                || $declaration_seal == 0
                || $declaration_signature == 0
                || $document == 0
                || $expiry_date == 0
                || $document_type == 0
                || $document_no == 0
                ){
                   // || $account == 0

                    $remarks = '';
                    if($reasons){
                        $remarks = implode(',',$reasons);
                    }

                    $company->update(['is_approved' => 2]);
                    $company->checklist->update(['remarks' => $remarks]);
                    $remark = 'Verification declined </br> Reason : '.$remarks.'</br> Make neccesary changes and update from your profile';
                    //$this->setNotification($company,$remark);
                }  
                DB::commit();
                return redirect()->route('clients.disabled.index');
                
            }catch (\Exception $e) {
                DB::rollback();
                return back()->with('warning','Something went wrong. Try again!');
            }
    
        return redirect()->route('home');
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
        if($request->company_name == 1
            && $request->country == 1
            && $request->declaration == 1
            && $request->declaration_signature == 1  
            && $request->declaration_seal == 1 
            && $request->document_no == 1  
            && $request->exp_date == 1  
            && $request->document_type == 1
            && $request->document == 1
            ){
                DB::beginTransaction();

                try {

                    $company->update(['is_approved' => 1]);
                    $company->checklist->update([
                        'company_name' => $request->company_name,
                        'country' => $request->country,
                        'declaration' => $request->declaration,
                        'declaration_signature' => $request->declaration_signature,
                        'declaration_seal' => $request->declaration_seal,
                        'declaration_updated_at' => now(),
                        'document_no' => $request->document_no,
                        'document_type' => $request->document_type,
                        'document' => $request->document,
                        'expiry_date' => $request->exp_date,
                        'document_updated_at' => now(),
                        'remarks' => '',
                    ]);

                    if($request->account == 1){
                        $company->checklist->update([
                        'account_verification' => $request->account, 
                        ]);
                    }
                    DB::commit();
                    return redirect()->route('clients.disabled.index'); 
                }catch (\Exception $e) {
                    DB::rollback();
                    return back()->with('warning','Something went wrong. Try again!');
                }        
        }
        else{
            return back();
        }
    }

    // public function setNotification($company,$remark){
    //     Notification::create([
    //          'company_id' => $company->id,
    //          'message' => $remark,
    //          'type' => 1,   /* 1 => warning || 2 =>  */
    //     ]);

    //     return true;
    // }

}

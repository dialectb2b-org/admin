<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\CategoryRequest;
use App\Models\Company;
use App\Models\CompanyActivity;
use App\Models\CompanyDocument; 
use App\Models\CompanyLocation;
use App\Models\CompanyUser;
use App\Models\Checklist;
use App\Models\SubCategory;
use App\Models\Region;
use App\Models\Notification;
use App\Models\RegistrationToken;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveMail;
use DB;
use App\Services\SendGridEmailService;

class TodoController extends Controller
{

    protected $sendGridEmailService;

    public function __construct(SendGridEmailService $sendGridEmailService)
    {
        $this->sendGridEmailService = $sendGridEmailService;
    }
    
    public function index(Request $request)
    {
        \DB::enableQueryLog();
        $query = Company::with('document');
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
    

        $registrations = $query->where(function($query){
                           $query->where('is_superseded',0)
                                      ->where('is_approved',1)
                                      ->whereHas('payment')
                                      ->whereHas('checklist', function ($query){
                                            $query->where('account_verification', 0);
                                      });
                           })
                           ->orWhere(function($query){
                                $query->where('is_superseded',0)
                                    ->where('is_approved',1)
                                    ->whereNotNull('decleration')
                                    ->whereHas('checklist', function ($query){
                                        $query->whereRaw('companies.declaration_updated_at > checklists.declaration_updated_at')
                                            ->where(function($query){ 
                                                $query->where('checklists.declaration', 0)
                                                    ->orWhere('checklists.declaration_signature',0)
                                                    ->orWhere('checklists.declaration_seal',0);
                                        });   
                                    });
                           })
                           ->orWhere(function($query){
                                $query->where('is_superseded',0)
                                    ->where('is_approved',1)
                                    ->whereHas('checklist', function ($query){
                                        $query->whereHas('document',function ($query){
                                            $query->whereRaw('company_documents.updated_at > checklists.document_updated_at')
                                                ->where(function($query){ 
                                                    $query->where('checklists.document',0)
                                                        ->orWhere('checklists.document_no',0)
                                                        ->orWhere('checklists.expiry_date',0)
                                                        ->orWhere('checklists.document_type',0);
                                                });
                                        });
                                    });
                           })
                           ->orWhere(function($query){
                            $query->where('is_superseded',0)
                                ->where('is_approved',2)
                                ->whereHas('checklist', function ($query){
                                    $query->whereHas('document',function ($query){
                                        $query->whereRaw('company_documents.updated_at > checklists.document_updated_at')
                                            ->where(function($query){ 
                                                $query->where('checklists.document',0)
                                                      ->orWhere('checklists.document_no',0)
                                                      ->orWhere('checklists.expiry_date',0)
                                                      ->orWhere('checklists.document_type',0);
                                            });
                                    });
                                });
                            })
                            ->orWhere(function($query){
                                $query->where('is_superseded',0)
                                    ->where('is_approved',2)
                                    ->whereNotNull('decleration')
                                    ->whereHas('checklist', function ($query){
                                        $query->whereRaw('companies.declaration_updated_at > checklists.declaration_updated_at')
                                              ->where(function($query){ 
                                                   $query->where('checklists.declaration', 0)
                                                         ->orWhere('checklists.declaration_signature',0)
                                                         ->orWhere('checklists.declaration_seal',0);
                                              });            
                                    });
                                })
                           ->orWhere(function($query){
                                $query->where('is_superseded',0)
                                    ->where('is_approved',0)
                                    ->whereNotNull('decleration')
                                    ->whereHas('checklist', function ($query){
                                        $query->whereRaw('companies.declaration_updated_at > checklists.declaration_updated_at')
                                              ->where(function($query){ 
                                                   $query->where('checklists.declaration', 0)
                                                         ->orWhere('checklists.declaration_signature',0)
                                                         ->orWhere('checklists.declaration_seal',0)
                                                         
                                                         ->where('checklists.document',0)
                                                         ->orWhere('checklists.document_no',0)
                                                         ->orWhere('checklists.expiry_date',0)
                                                         ->orWhere('checklists.document_type',0);
                                              });            
                                    });
                            })
                            ->orWhere(function($query){
                                $query->where('is_superseded',0)
                                    ->where('is_approved',0)
                                    ->whereHas('checklist', function ($query){
                                        $query->whereHas('document',function ($query){
                                            $query->whereRaw('company_documents.updated_at > checklists.document_updated_at')
                                                    ->where(function($query){ 
                                                        $query->where('checklists.document',0)
                                                            ->orWhere('checklists.document_no',0)
                                                            ->orWhere('checklists.expiry_date',0)
                                                            ->orWhere('checklists.document_type',0)
                                                            
                                                            ->where('checklists.declaration', 0)
                                                            ->orWhere('checklists.declaration_signature',0)
                                                            ->orWhere('checklists.declaration_seal',0);
                                                    });
                                            });
                                    });
                            })
                            ->orWhere(function($query){
                                $query->where('is_superseded',0)
                                    ->where('is_approved',0)
                                    ->whereHas('checklist', function ($query){
                                        $query->whereRaw('companies.updated_at > checklists.updated_at')
                                                ->where(function($query){ 
                                                    $query->where('checklists.company_name',0)
                                                        ->orWhere('checklists.country',0);
                                                });
                                           
                                    });
                            })
                            ->paginate(10);   
       
                           //dd(\DB::getQueryLog());              
        return view('registration.todo.index',compact('registrations'));
    }

    public function show($id)
    {
        $company = Company::with('country','activities','locations','document','users','payment')->findOrFail($id);
        return view('registration.todo.show',compact('company'));
    }

    public function checklist($id){
        $company = Company::with('country','activities','locations','document','users','payment')->findOrFail($id);
        return view('registration.todo.checklist',compact('company'));
    } 

    public function verifyChecklist(Request $request){
        DB::beginTransaction();
        
        try {
            if($request->filled('account')){ 
                $this->verifyAccount($request);
            }
            if($request->filled('company_name')
                || $request->filled('country')
                || $request->filled('declaration') 
                || $request->filled('declaration_signature') 
                || $request->filled('declaration_seal')
                || $request->filled('document_no')
                || $request->filled('exp_date')
                || $request->filled('document_type')
                || $request->filled('document')){
                    $this->verifyDocumentDeclaration($request);
            }
            DB::commit();
            return redirect()->route('registration.todo');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('warning','Something went wrong. Try again!');
        }
    }
    
   

    public function verifyDocumentDeclaration($data){
        
        $reasons = [];
        $company = Company::with('checklist')->find($data->company_id);
        
        if($data->company_name && $data->company_name == 1){
            $company_name = 1; 
        }
        else{
            $company_name = $company->checklist->company_name;
        }
        
        if($data->country && $data->country == 1){
            $country = 1; 
        }
        else{
            $country = $company->checklist->country;
        }
        
        if($data->declaration && $data->declaration == 1){
            $declaration = 1; 
        }
        else{
            $declaration = $company->checklist->declaration;
        }

        if($data->declaration_signature && $data->declaration_signature == 1){
             $declaration_signature = 1;
        }
        else{
            $declaration_signature = $company->checklist->declaration_signature;
        }

        if($data->declaration_seal && $data->declaration_seal == 1){
             $declaration_seal = 1;
        }
        else{
             $declaration_seal = $company->checklist->declaration_seal;
        }

        if($data->document_no && $data->document_no == 1){
             $document_no = 1;
        }
        else{
             $document_no = $company->checklist->document_no;
        }
        
        if($data->exp_date && $data->exp_date == 1){
             $expiry_date = 1;
        }
        else{
             $expiry_date = $company->checklist->expiry_date;
        }

        if($data->document_type && $data->document_type == 1){
             $document_type = 1;
        }
        else{
            $document_type = $company->checklist->document_type;
        }

        if($data->document && $data->document == 1){
            $document = 1;
        }
        else{
            $document = $company->checklist->document;
        }
        
        // Message Block
        if($company_name == 0){
            array_push($reasons,'The company name provided does not match with the Commercial Registration (CR) record.');
        }
        if($country == 0){
            array_push($reasons,'Inaccurate registration country information was provided.');
        }
        if($declaration == 0){
            array_push($reasons,'The uploaded declaration document is not valid.');
        }
        if($declaration_seal == 0){
            array_push($reasons,'Please ensure a clear signature is affixed on the declaration document.');
        }
        if($declaration_signature == 0){
            array_push($reasons,'Verify the company seal on the declaration document.');
        }
        if($document == 0){
            array_push($reasons,'The uploaded Commercial Registration (CR) document is not valid or has expired.');
        }
        if($document_no == 0){
            array_push($reasons,'The document number provided does not match with the Commercial Registration (CR) record.');
        }
        if($document_type == 0){
            array_push($reasons,'The submitted document has not been confirmed as a valid Commercial Registration.');
        }
        if($expiry_date == 0){
            array_push($reasons,'The document expiry date does not match with  the Commercial Registration (CR) record.');
        }
        
        $remarks = '';
        if($reasons){
            $remarks = implode(',',$reasons);
            Checklist::where('company_id',$company->id)
                   ->update(['remarks' => $remarks]);
        }

        if($data->filled('document') && $data->filled('document_no') && $data->filled('document_type') && $data->filled('expiry_date')){
            $document_updated_at = now();
        }
        else{
            $document_updated_at =  $company->checklist->document_updated_at;
        }

        if($data->filled('declaration') && $data->filled('declaration_signature') && $data->filled('declaration_seal')){
            $declaration_updated_at = now();
        }
        else{
            $declaration_updated_at =  $company->checklist->declaration_updated_at;
        }
        
        if($data->filled('company_name') && $data->filled('country')){
            $updated_at = now();
        }
        else{
            $updated_at =  $company->checklist->updated_at;
        }

        $company->checklist->update([
            'company_name' => $company_name,
            'country' => $country,
            'declaration' => $declaration,
            'declaration_signature' => $declaration_signature,
            'declaration_seal' => $declaration_seal,
            'declaration_updated_at' => $declaration_updated_at,
            'document_no' => $document_no,
            'expiry_date' => $expiry_date,
            'document_type' => $document_type,
            'document' => $document,
            'document_updated_at' => $document_updated_at,
            'remarks' => $remarks,
            'updated_at' => $updated_at,
        ]);
        
       

        if($company_name == 0 
            || $country == 0
            || $declaration == 0 
            || $declaration_seal == 0
            || $declaration_signature == 0
            || $document == 0
            || $expiry_date == 0
            || $document_type == 0
            || $document_no == 0){
      
                $this->rejectCompany($company,$reasons);
                
        }
        else{
            $this->approveCompany($company->id);
            return true;
        }
    }

    public function approveCompany($company_id){
        $company = Company::findOrFail($company_id);
        
        if($company->is_approved == 2){
            $company->is_approved = 1; /* 1 => approved */
            $company->save();
            return 1;
        }
        else{
            $company->is_approved = 1; /* 1 => approved */
            $company->save();

            $plaintext = Str::random(32);
            
            $companyuser = CompanyUser::updateOrCreate([
                'company_id'   => $company->id,
                'role' => 1
            ],[
                'name' => '',
                'mobile' => $company->phone,
                'designation' => "Admin",
                'email' => $company->email,
                'status' => 0,
                'token' => hash('sha256', $plaintext),
            ]);
        
            $details = [
                'subject'	=>'Account Activation Required - Action Needed',
                'salutation' => '<p style="text-align: left;font-weight: bold;">Hello '.$company->name ?? 'User,</p>',
                'introduction' => "<p>We are delighted to inform you that your organization has successfully created an account with us at Dialectb2b.com.</p>",
                'body' => "<p>To activate your user account and start using our services, please submit the required user profile information by clicking the link below:</p>",
                'closing' => "<p>Your prompt action in submitting the necessary details is appreciated. If you have any questions or need assistance during the activation process,<br>
                please feel free to contact our customer care team via the chat box.<br><br>
                Thank you for choosing Dialectb2b.com. We look forward to serving you.</p>",
                'otp' => null,
                'link' => config('setup.application_url').'onboarding/'.$companyuser->token,
                'link_text' => 'Activate Account',
                "closing_salutation" => "<p style='font-weight: bold;'>Best Regards,<br>Team Dialectb2b.com</p>"
            ];
            
            $subject	= 'Account Activation Required - Action Needed';
            $htmlBody = view('emails.common',compact('details'))->render();
            
            //$result = $this->sendGridEmailService->send($companyuser->email, $subject, $htmlBody, true);
        
            \Mail::to($companyuser->email)->send(new \App\Mail\CommonMail($details));
            return 1;
        }
    }

    public function rejectCompany($company,$reasons){ 
        
        if($company->is_approved == 1 || $company->is_approved == 2){
            $remark = 'Verification declined </br> Reason : '.$remarks.'</br> Make neccesary changes and update from your profile';
            //$this->setNotification($company,$remark);
            return true;
        }
        else{
            $plaintext = Str::random(32);
            $token = RegistrationToken::create([
                    'company_id' => $company->id,
                    'token' => hash('sha256', $plaintext),
                    'expire_at' => now()->addDays(7),
            ]);

            $company->update(['decleration' => null, 'declaration_updated_at' => null]);

            $html = '';
            foreach($reasons as $key => $reason){
                $html.='<li>'.$reason ?? ''.'</li>';
            }

            $details = [
                'subject'	=>'Registration Declined - Action Required',
                'salutation' => '<p style="text-align: left;font-weight: bold;">Hello '.$company->name ?? 'User,</p>',
                'introduction' => "<p>We regret to inform you that your registration has been declined for the following reasons:</p>",
                'body' => "<p><ul>".$html."</ul><br>To continue with the registration process, please resubmit your application by clicking the link below:</p>",
                'closing' => "<p>We appreciate your time and attention to this matter. Should you have any questions or require further assistance,<br> please don't hesitate to contact our customer care team via the chat box.</p>",
                'otp' => null,
                'link' => config('setup.application_url').'registration/'.$token->token,
                'link_text' => 'Resubmit Application',
                "closing_salutation" => "<p style='font-weight: bold;'>Best Regards,<br>Team Dialectb2b.com</p>"
            ];
            
            $subject	= 'Registration Declined - Action Required';
            $htmlBody = view('emails.common',compact('details'))->render();
            
            //$result = $this->sendGridEmailService->send($company->email, $subject, $htmlBody, true);
            
            \Mail::to($company->email)->send(new \App\Mail\CommonMail($details));
                

            return true;
        }
    
    }
    
    public function verifyAccount($data){
        $company = Company::with('checklist')->find($data->company_id);
        if($data->account == 1){
            $company->update([
                'is_verified' => 1,
            ]);
            $company->checklist->update([
                'account_verification' => 1,
            ]);

            if($company->is_overlap == 1){
                    // $companyDocNo = CompanyDocument::where('company_id',$company->id)->value('doc_number');
                    // $siblingCompanyId = CompanyDocument::where('doc_number',$companyDocNo)->where('company_id','!=',$company->id)->get('id')->toArray();
                    // Company::whereIn('id',$siblingCompanyId)->update(['is_superseded'=>1]);
                    
                    $companyDocNo = CompanyDocument::where('company_id', $company->id)->value('doc_number');
                    $siblingCompanyIds = CompanyDocument::where('doc_number', $companyDocNo)
                                     ->where('company_id', '!=', $company->id)
                                     ->pluck('company_id')
                                     ->toArray();
                    Company::whereIn('id', $siblingCompanyIds)->update(['is_superseded' => 1]);
                    
                    $details = [
                        'subject'	=>'Approval of Superseding Request',
                        'salutation' => '<p style="text-align: left;font-weight: bold;">Hello '.$company->name ?? 'User,</p>',
                        'introduction' => "<p>We're pleased to inform you that your organization's superseding request has been<br>
                                                successfully verified and approved. You can now update your user profile information after logging into your account.</p>",
                        'body' => "<p>If you have any questions or need assistance, please don't hesitate to reach out to our customer care team via the chat box.</p>",
                        'closing' => "<p>Thank you for choosing Dialectb2b.com. We're here to assist you.</p>",
                        'otp' => null,
                        'link' => null,
                        'link_text' => null,
                        "closing_salutation" => "<p style='font-weight: bold;'>Best Regards,<br>Team Dialectb2b.com</p>"
                    ];
                    
                    $subject	= 'Verification Confirmation - '.$company->name;
                    $htmlBody = view('emails.common',compact('details'))->render();
                    
                    //$result = $this->sendGridEmailService->send($company->email, $subject, $htmlBody, true);
                    \Mail::to($company->email)->send(new \App\Mail\CommonMail($details));
            }
            
            $details = [
                'subject'	=>'Verification Confirmation - '.$company->name,
                'salutation' => '<p style="text-align: left;font-weight: bold;">Hello '.$company->name ?? 'User,</p>',
                'introduction' => "<p>We are pleased to inform you that your recent verification request has been successfully processed and confirmed. <br>
                Your company account on Dialectb2b.com has now been verified.</p>",
                'body' => "<p>The verified badge on Dialectb2b.com enhances credibility and trust, fostering stronger connections and boosting industry reputation. <br>
                You can now enjoy the benefits of having a verified badge, including increased trust and visibility.</p>",
                'closing' => "<p>If you have any questions or need further assistance, please don't hesitate to contact our customer support team through chat assistance.<br>
                Thank you for choosing Dialectb2b.com.</p>",
                'otp' => null,
                'link' => null,
                'link_text' => null,
                "closing_salutation" => "<p style='font-weight: bold;'>Best Regards,<br>Team Dialectb2b.com</p>"
            ];
            
            $subject	= 'Verification Confirmation - '.$company->name;
            $htmlBody = view('emails.common',compact('details'))->render();
            
            //$result = $this->sendGridEmailService->send($company->email, $subject, $htmlBody, true);
            \Mail::to($company->email)->send(new \App\Mail\CommonMail($details));
        }
        else{
            $remark = 'Account verification declined </br> Reason : Transaction Details submitted against account verification is invalid!</br> Make neccesary changes and update from your profile';
            //$this->setNotification($company,$remark);
        }
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

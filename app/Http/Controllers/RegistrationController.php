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
use App\Models\RegistrationToken;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveMail;
use DB;
use App\Services\SendGridEmailService;


class RegistrationController extends Controller
{
    
    protected $sendGridEmailService;

    public function __construct(SendGridEmailService $sendGridEmailService)
    {
        $this->sendGridEmailService = $sendGridEmailService;
    }
    
    public function index(Request $request)
    {
        $query = Company::with('country','checklist','payment','document');
        if(!is_null($request->keyword))
        {
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $registrations = $query->whereHas('document')
                               ->whereDoesntHave('checklist')
                               ->where('is_approved',0)
                               ->whereNotNull('decleration')
                               ->paginate(10);
        return view('registration.approvals.index',compact('registrations'));
    }

    public function show($id)
    {
        $company = Company::with('country','activities','locations','document','users','payment')->findOrFail($id);
        return view('registration.approvals.show',compact('company'));    
    }

    public function checklist($id)
    {
        $company = Company::with('country','activities','locations','document','users','payment')->findOrFail($id);
        return view('registration.approvals.checklist',compact('company'));
    } 

    public function verifyChecklist(Request $request)
    {

        $request->validate([
            'company_name' => 'required',
            'country' => 'required',
            'doc_name' => 'required',
            'doc_num' => 'required',
            'exp_date' => 'required',
            'document' => 'required',
            'declaration' => 'required',
            'declaration_signature' => 'required',
            'declaration_seal' => 'required',
        ]);

        DB::beginTransaction();
        
        try {

            $checklist = checklist::create([
                'company_id' => $request->company_id,
                'company_name' => $request->company_name,
                'country' => $request->country,
                'document_type' => $request->doc_name,
                'document_no' => $request->doc_num,
                'expiry_date' => $request->exp_date,
                'document' => $request->document,
                'document_updated_at' => now(),
                'declaration' => $request->declaration,
                'declaration_signature' => $request->declaration_signature,
                'declaration_seal' => $request->declaration_seal,
                'declaration_updated_at' => now(),
                'created_by' => auth()->user()->id,
            ]);
        
            $this->checkApprovalEligibility($checklist);
            DB::commit();

            return redirect()->route('registration.index')->with('success','Updated!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('warning','Something went wrong. Try again!');
        }
    } 

    public function checkApprovalEligibility($checklist){
        if($checklist->company_name == 1
            &&$checklist->country == 1
            &&$checklist->declaration == 1
            && $checklist->declaration_signature == 1  
            && $checklist->declaration_seal == 1 
            && $checklist->document_no == 1  
            && $checklist->expiry_date == 1  
            && $checklist->document_type == 1
            && $checklist->document == 1){
                $this->approveCompany($checklist->company_id);
        }
        else{
            $this->rejectCompany($checklist);
        }
    }

    public function approveCompany($company_id){
        $company = Company::findOrFail($company_id);
        $company->is_approved = 1; /* 1 => approved, 2 => rejected */
        $company->status = 0;
        $company->is_superseded = 0;
        $company->save();

        $plaintext = Str::random(32);
        $companyuser =  CompanyUser::create([
            'company_id' => $company->id,
            'name' => '',
            'mobile' => $company->phone,
            'designation' => "Admin",
            'role' => 1,
            'email' => $company->email,
            'status' => 0,
            'token' => hash('sha256', $plaintext),
        ]);

        
        
        $details = [
            'subject'	=>'Account Activation Required - Action Needed',
            'salutation' => '<p style="text-align: left;font-weight: bold;">Hello '.$company->name ?? 'User,</p>',
            'introduction' => "<p>We are delighted to inform you that your organization has successfully created an account with us at Dialectb2b.com.</p>",
            'body' => "<p>To activate your user account and start using our services, please submit the required user profile information by clicking the link below:</p>",
            'closing' => "<p>Your prompt action in submitting the necessary details is appreciated. If you have any questions or need assistance during the activation process,
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
    } 

    public function rejectCompany($checklist){ 
        $reasons = [];
        if($checklist->company_name == 0){
            array_push($reasons,' The company name provided does not match with the Commercial Registration (CR) record.');
        }
        if($checklist->country == 0){
            array_push($reasons,'Inaccurate registration country information was provided..');
        }
        if($checklist->declaration == 0){
              array_push($reasons,'The uploaded declaration document is not valid.');
        }
        if($checklist->declaration_signature == 0){
              array_push($reasons,'Please ensure a clear signature is affixed on the declaration document.');
        }  
        if($checklist->declaration_seal == 0){
            array_push($reasons,'Verify the company seal on the declaration document.');
        }
        if($checklist->document_no == 0){
            array_push($reasons,' The document number provided does not match with the Commercial Registration (CR) record.');
        } 
        if($checklist->document_type == 0){
            array_push($reasons,'The submitted document has not been confirmed as a valid Commercial Registration.');
        }
        if($checklist->expiry_date == 0){
            array_push($reasons,'The document expiry date does not match with  the Commercial Registration (CR) record.');
        }
        if($checklist->document == 0){
            array_push($reasons,'The uploaded Commercial Registration (CR) document is not valid or has expired.');
        }

        $remarks = implode(',',$reasons);
        checklist::where('company_id',$checklist->company_id)
                   ->update(['remarks' => $remarks]);

        $plaintext = Str::random(32);
        $company = Company::findOrFail($checklist->company_id);
        $company->update(['decleration' => null, 'declaration_updated_at' => null]);
        $token = RegistrationToken::create([
                'company_id' => $company->id,
                'token' => hash('sha256', $plaintext),
                'expire_at' => now()->addDays(7),
        ]);
  
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

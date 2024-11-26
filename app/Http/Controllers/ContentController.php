<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Content;
use Carbon\Carbon;

class ContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        
    }

    public function communityGuidelines(){
        $content = Content::first();
        return view('content.community-guidelines',compact('content'));
    }
    
    public function saveCommunityGuidelines(Request $request){
        $content = Content::first();
        $content->community_guidelines = $request->content;
        $content->save();
        return back();
    }
    
    public function privacyPolicy(){
        $content = Content::first();
        return view('content.privacy-policy',compact('content'));
    }
    
    public function savePrivacyPolicy(Request $request){
        $content = Content::first();
        $content->privacy_policy = $request->content;
        $content->save();
        return back();
    }
    
    public function userAgreement(){
        $content = Content::first();
        return view('content.user-agreements',compact('content'));
    }
    
     public function saveUserAgreement(Request $request){
        $content = Content::first();
        $content->user_agreement = $request->content;
        $content->save();
        return back();
    }
}

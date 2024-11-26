<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Carbon\Carbon;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {             

        // Registration Approvals & To Do List
        $forapproval = Company::whereHas('document')->whereDoesntHave('checklist')->where('is_approved',0)->whereNotNull('decleration')->count();
        $todo = $this->getToDoCount();
        $unregistered = Company::where('is_approved',0)->where('status',0)->where('is_superseded',0)->count();
        $approved = Company::where('is_approved',1)->where('status',0)->where('is_superseded',0)->count();
        $registered = Company::where('is_approved',1)->where('status',1)->where('is_superseded',0)->count();
        $verified = Company::where('is_approved',1)->where('status',2)->where('is_superseded',0)->count();
        $subscribed = 0;
        $superseded = Company::where('is_superseded',1)->count();
        $disabled = Company::where('is_approved',2)->count();   
        return view('home',compact('forapproval','todo','unregistered','approved','registered','verified','subscribed','superseded','disabled'));
    }

    public function getToDoCount(){
        $query = Company::whereHas('document');
        $query->where(function($query){
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
            ->get();
            return $query->count();
        
    }
}

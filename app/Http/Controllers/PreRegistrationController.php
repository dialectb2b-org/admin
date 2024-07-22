<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreRegistrationRequest;
use App\Http\Requests\PreRegistrationExcelRequest;
use App\Imports\CompanyImport;
use App\Models\Category;
use App\Models\CategorySubCategory;
use App\Models\Country;
use App\Models\PreRegisteredCompany;
use App\Models\PreRegisteredCompanyActivity;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use MeiliSearch\Client;
use MeiliSearch\Endpoints\Indexes;
use Illuminate\Database\Eloquent\Builder;
use MeiliSearch\Exceptions\ApiException;
use DB;


class PreRegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $query = PreRegisteredCompany::with('country');
        if(!is_null($request->keyword)){
            $query->where('name','like',$request->keyword.'%');
        }
        $registrations = $query->paginate(10);
        return view('preregistration.index',compact('registrations'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('preregistration.create',compact('countries'));
    }

    public function store(PreRegistrationRequest $request, PreRegisteredCompany $company)
    {
        DB::beginTransaction();
        try{
            $input = $request->validated();
            $company->create($input);   
            DB::commit();
            return redirect()->route('pre-registration.index')->with('success','Company has been Created!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
        
    }

    public function import(PreRegistrationExcelRequest $request)
    {
        try {
            Excel::import(new CompanyImport, $request->file('file')->store('temp'));
        }
        catch (\Maatwebsite\Excel\Validators\ValidationException $e) {    
            $failures = $e->failures();
            return redirect()->route('pre-registration.create')->with('error',$failures);
        } catch (\Exception $e) {
            return redirect()->route('pre-registration.create')->with('error', 'There was an error with the uploaded file.');
        }
        return redirect()->route('pre-registration.index')->with('success','Excel uploaded!');
    }

    public function show($id)
    {
        $company = PreRegisteredCompany::with('country','activities.service')->find($id);
        return view('preregistration.show',compact('company'));
    }

    public function assignCategory($id)
    {
        $categories   = Category::all();
        $company = PreRegisteredCompany::with('country','activities.service')->find($id);
        return view('preregistration.assign-category',compact('company','categories'));
    }

    public function serachCategory(Request $request)
    {
        
        $sub_categories = SubCategory::search($request->get('keyword') ?? '', function ($meilisearch, string $query, array $options) use ($request) {
            $result = $meilisearch->search($query, $options);

            return $result;
        })->get()->map(function($query) {
            return [
                'name'=> $query->name,
                'code'=> $query->code
            ];
        });

        
        return response()->json($sub_categories);
       
       
    }
    

    public function serachAlphaCategory(Request $request)
    {
        if($request->keyword != ''){
        $cat = Category::where("name",'like',$request->keyword.'%')->orderBy('name','asc')->get();
        
        }
        else{
            $cat = Category::all();
        }
        return $cat->toArray();
    } 

    public function getSubCategory(Request $request)
    {
        $services = SubCategory::whereIn('id', function($query) use ($request){
            $query->select('sub_category_id')
            ->from('category_sub_categories')
            ->where('category_id', $request->cat_id);
        })->orderBy('name','asc')->get();
        return response()->json($services);
    }

    public function saveCategory(Request $request)
    {
        try {
            $company_id = $request->company_id;
            $subcategory_id = $request->subcategory_id;
            $companyServicesExist = PreRegisteredCompanyActivity::where('activity_id',$subcategory_id)->where('company_id',$company_id)->exists();
            if($companyServicesExist == false){
                $service = PreRegisteredCompanyActivity::create([
                      'activity_id' => $subcategory_id,
                      'company_id' => $company_id,
                ]);
                return response()->json($service);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getCategories(Request $request)
    {
        $id = $request->company_id;
        $company = PreRegisteredCompany::with('activities.service')->find($id);
        return $company->activities;
    } 
    
    public function edit($id)
    {
        $countries = Country::all();
        $company = PreRegisteredCompany::find($id);
        return view('preregistration.edit',compact('countries','company'));
    }

    public function update(PreRegistrationRequest $request,$id)
    {
        DB::beginTransaction();
        try{
            $input = $request->validated();
            $company = PreRegisteredCompany::find($id);
            $company->update($input);
            DB::commit();
            return redirect()->route('pre-registration.index')->with('success','Company has been Updated!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }   
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $company = PreRegisteredCompany::find($id);
            PreRegisteredCompanyActivity::where('company_id',$company->id)->delete();
            $company->delete();
            DB::commit();
            return redirect()->route('pre-registration.index')->with('success','Company has been Deleted!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }   
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try{
            $company = PreRegisteredCompanyActivity::find($id);
            $company_id = $company->company_id;
            $company->delete();
            DB::commit();
            return redirect()->route('pre-registration.show',$company_id)->with('success',' Business Category Deleted!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }    
    }
}

<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\CountryRequest;
use App\Models\Country;
use App\Models\PreRegisteredCompany;
use App\Models\Company;
use App\Models\Region;
use DB;

class CountryController extends Controller
{
   
  
    public function index(Request $request)
    {
        $query = Country::query();
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $countries = $query->paginate(10);
        return view('settings.country.index',compact('countries'));
    }

    public function create()
    {
        return view('settings.country.create');
    }

    public function store(CountryRequest $request)
    {
        DB::beginTransaction();
        try{
            $country = Country::create($request->validated());
            DB::commit();
            return redirect()->route('country.index')->with('success','Country has been created!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function show(Country $country)
    {
        return view('settings.country.show',compact('country'));
    }

    public function edit(Country $country)
    {
        return view('settings.country.edit',compact('country'));
    }

    public function update(CountryRequest $request, Country $country)
    {
        DB::beginTransaction();
        try{
            $country->update($request->validated());
            DB::commit();
            return redirect()->route('country.index')->with('success','Country has been updated!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function destroy($id)
    {
        $pre = PreRegisteredCompany::where('country_id', $id)->count();
        if($pre > 0){
            return redirect()->back()->with('warning','Country has pre registered companies.Delete that first to delete country!');
        }
        
        $company = Company::where('country_id', $id)->count();
        if($company > 0){
            return redirect()->back()->with('warning','Country has clients. Delete that first to delete country!');
        }

        $region = Region::where('country_id', $id)->count();
        if($region > 0){
            return redirect()->back()->with('warning','Country has regions. Delete that first to delete country!');
        }
        
        

        DB::beginTransaction();
        try{
            $country = Country::findOrFail($id);
            $country->delete();
            DB::commit();
            return redirect()->route('country.index')->with('success','Country has been deleted!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }
}

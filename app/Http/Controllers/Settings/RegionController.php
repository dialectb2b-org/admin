<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\RegionRequest;
use App\Models\Region;
use App\Models\Country;
use App\Models\CompanyLocation;
use DB;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        $query = Region::query();
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $regions = $query->paginate(10);
        return view('settings.region.index',compact('regions'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('settings.region.create',compact('countries'));
    }

    public function store(RegionRequest $request)
    {
        DB::beginTransaction();
        try{
            $region = Region::create($request->validated());
            DB::commit();
            return redirect()->route('region.index')->with('success','Region has been created!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function show(Region $region)
    {
        return view('settings.region.show',compact('region'));
    }

    public function edit(Region $region)
    {
        $countries = Country::all();
        return view('settings.region.edit',compact('region','countries'));
    }

    public function update(RegionRequest $request, Region $region)
    {
        DB::beginTransaction();
        try{
            $region->update($request->validated());
            DB::commit();
            return redirect()->route('region.index')->with('success','Region has been updated!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function destroy($id)
    {

        $company = CompanyLocation::where('region_id', $id)->count();
        if($company > 0){
            return redirect()->back()->with('warning','Region has clients. Delete that first to delete region!');
        }

        DB::beginTransaction();
        try{
            $region = Region::findOrFail($id);
            $region->delete();
            DB::commit();
            return redirect()->route('region.index')->with('success','Region has been deleted!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }
}

<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\SectorRequest;
use App\Models\Sector;

class SectorController extends Controller
{
    public function index(Request $request)
    {
        $query = Sector::query();
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $sectors = $query->paginate(10);
        return view('settings.sector.index',compact('sectors'));
    }

    public function create()
    {
        return view('settings.sector.create');
    }

    public function store(SectorRequest $request)
    {
        $sector = Sector::create($request->validated());
        return redirect()->route('sector.index')->with('success','Sector has been created!');
    }

    public function show(Sector $sector)
    {
        return view('settings.sector.show',compact('sector'));
    }

    public function edit(Sector $sector)
    {
        return view('settings.sector.edit',compact('sector'));
    }

    public function update(SectorRequest $request, Sector $sector)
    {
        $sector->update($request->validated());
        return redirect()->route('sector.index')->with('success','Sector has been updated!');
    }

    public function destroy($id)
    {
        $sector = Sector::findOrFail($id);
        $sector->delete();
        return redirect()->route('sector.index')->with('success','Sector has been deleted!');
    }
}

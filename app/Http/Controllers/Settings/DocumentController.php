<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\DocumentRequest;
use App\Models\Document;
use App\Models\Country;
use DB;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::query();
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $documents = $query->paginate(10);
        return view('settings.document.index',compact('documents'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('settings.document.create',compact('countries'));
    }

    public function store(DocumentRequest $request)
    {
        DB::beginTransaction();
        try{
            $input = $request->validated();
            $input['status'] = 1;
            $document = Document::create($input);
            DB::commit();
            return redirect()->route('document.index')->with('success','Document has been created!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function show(Document $document)
    {
        return view('settings.document.show',compact('document'));
    }

    public function edit(Document $document)
    {
        $countries = Country::all();
        return view('settings.document.edit',compact('document','countries'));
    }

    public function update(DocumentRequest $request, Document $document)
    {
        DB::beginTransaction();
        try{
            $document->update($request->validated());
            DB::commit();
            return redirect()->route('document.index')->with('success','Document has been updated!');
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
            $document = Document::findOrFail($id);
            $document->delete();
            DB::commit();
            return redirect()->route('document.index')->with('success','Document has been deleted!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

}

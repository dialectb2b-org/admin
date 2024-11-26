<?php

namespace App\Http\Controllers\CustomerSupport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AppFaqRequest;
use App\Models\AppFaq;
use App\Models\AppFaqCategory;
use DB;

class AppFaqController extends Controller
{

    public function index(Request $request)
    {
        $query = AppFaq::query();
        if(!is_null($request->keyword)){
            $query->where('question','like','%'.$request->keyword.'%');
        }
        $faqs = $query->orderBy('name','asc')->paginate(10);
        return view('customersupport.faqs.index',compact('faqs')); 
    }

    public function create()
    {
        $categories = AppFaqCategory::all();
        return view('customersupport.faqs.create',compact('categories'));
    }

    public function store(AppFaqRequest $request)
    {
        DB::beginTransaction();
        try{
            $category = AppFaq::create($request->validated());
            DB::commit();
            return redirect()->route('faqs.index')->with('success','FAQ has been created!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function show(AppFaq $faq)
    {
        return view('customersupport.faqs.show',compact('faq'));
    }

    public function edit(AppFaq $faq)
    {
        $categories = AppFaqCategory::all();
        return view('customersupport.faqs.edit',compact('faq','categories'));
    }

    public function update(AppFaqRequest $request, AppFaq $faq)
    {
        DB::beginTransaction();
        try{
            $faq->update($request->validated());
            DB::commit();
            return redirect()->route('faqs.index')->with('success','FAQ has been updated!');
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
            $faq = AppFaq::find($id);
            $faq->delete();
            DB::commit();
            return redirect()->route('faqs.index')->with('success','FAQ has been deleted!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
       
    }

}

<?php

namespace App\Http\Controllers\CustomerSupport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AppFaqCategoryRequest;
use App\Models\AppFaq;
use App\Models\AppFaqCategory;
use DB;

class AppFaqCategoriesController extends Controller
{

    public function index(Request $request)
    {
        $query = AppFaqCategory::query();
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $categories = $query->orderBy('name','asc')->paginate(10);
        return view('customersupport.faqcategory.index',compact('categories')); 
    }

    public function create()
    {
        return view('customersupport.faqcategory.create');
    }

    public function store(AppFaqCategoryRequest $request)
    {
        DB::beginTransaction();
        try{
            $category = AppFaqCategory::create($request->validated());
            DB::commit();
            return redirect()->route('faq-categories.index')->with('success','Category has been created!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    

    public function edit(AppFaqCategory $faq_category)
    {
        return view('customersupport.faqcategory.edit',compact('faq_category'));
    }

    public function update(AppFaqCategoryRequest $request, AppFaqCategory $faq_category)
    {
        DB::beginTransaction();
        try{
            $faq_category->update($request->validated());
            DB::commit();
            return redirect()->route('faq-categories.index')->with('success','Category has been updated!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function destroy($id)
    {

        $catsub = AppFaq::where('category_id',$id)->count();
        if($catsub > 0){
            return redirect()->back()->with('warning','Category has queris. Unlink them first to delete category!');
        }

        DB::beginTransaction();
        try{
            $category = AppFaqCategory::findOrFail($id);
            $category->delete();
            DB::commit();
            return redirect()->route('faq-categories.index')->with('success','Category has been deleted!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function disable($id)
    {
        DB::beginTransaction();
        try{
            $category = Category::findOrFail($id);
            $category->status= $category->status == 1 ? 0: 1;
            $category->save();
            DB::commit();
            return redirect()->route('category.index')->with('success','Category has been disabled!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public  function subcatList(Request $request, $id) {
        $category = Category::find($id);
        $subcategories = SubCategory::whereIn('id', function ($query) use ($id) {
            $query->select('sub_category_id')
                ->from('category_sub_categories')
                ->where('category_id', $id);
        })
        ->where(function ($query) use ($request) {
            if(!is_null($request->keyword)){
                $query->where('name', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('code', 'LIKE', '%' . $request->keyword . '%');
            }
        })
        ->get();
        return view('settings.category.subcatlist',compact('subcategories','category'));
    }

    public function service(Request $request)
    {
        $query = Category::query();
        if(!is_null($request->keyword)){
            $query->where('name','like','%'.$request->keyword.'%');
        }
        $categories = $query->paginate(10);
        return view('settings.category.service',compact('categories'));
    }

    public static function subcategories($id) {
        $sql = "SELECT * FROM `sub_categories` WHERE id IN (SELECT sub_category_id FROM category_sub_categories WHERE category_id = $id) ORDER BY sub_categories.name asc";
       return $services = \DB::select($sql);
    }

    

    public function fetchName(Request $request){
        $search = $request->search;
        if($search == ''){
            $services = Category::orderby('name','asc')->select('id','name','code')->limit(5)->get();
        } else {
            $services = Category::orderby('name','asc')->select('id','name','code')->where('name', 'like', '%' .$search . '%')->orWhere('code', 'like', '%' .$search . '%')->limit(10)->get();
        }
        $response = array();
        foreach($services as $service){
            $response[] = array("id"=> $service->id, "value"=>$service->name,"label"=>$service->name.'---'.$service->code, 'code' => $service->code);
        }
        return response()->json($response);
    }

}

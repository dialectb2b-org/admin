<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\RelativeSubCategory;
use DB;


class RelativeSubCategoryController extends Controller
{

    public function show($id,$cat_id){
        $category = Category::find($cat_id);
        $subcategory = SubCategory::find($id);
        $subcategories =  RelativeSubCategory::with('subcategory','relative')->where('sub_category_id',$id)->get();
        return view('settings.relative.show',compact('subcategories','subcategory','category'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'parent' => 'required',
        ]);
        DB::beginTransaction();
        try{

            if(!$request->subcategory_id){
                return redirect()->back()->with('warning','Select atleast 1 category');
            }
            
            $parent = $request->parent;
           
            foreach($request->subcategory_id as $key => $value){
                $isExists =  RelativeSubCategory::where('sub_category_id',$parent)->where('relative_id',$value)->exists();
                if($isExists == false){
                    RelativeSubCategory::create([
                        'sub_category_id' => $parent,
                        'relative_id' => $value
                    ]);
                }
            }
            DB::commit();
            return redirect()->back();
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function fetchSubCategories(Request $request){
        $query = SubCategory::where('name','like','%'.$request->search.'%')
                ->orWhere('code','like','%'.$request->search.'%');
        $subcategories = $query->get();
        $response = [];
        foreach($subcategories as $subcategory){
            $response[] = array("value"    => $subcategory->name.' - '.$subcategory->code,
                        "label"    => $subcategory->name.' - '.$subcategory->code,
                        "id"       => $subcategory->id,
                        "name"     => $subcategory->name,
                        "code"     => $subcategory->code,
                    );
        }
        return response()->json($response);
    }

    public function unlink($id){
        DB::beginTransaction();
        try{
            $relative =  RelativeSubCategory::find($id);
            $relative->delete();
            DB::commit();
            return back();
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }   
    
    

   /* public function store(Request $request){
        $validated = $request->validate([
            'parent' => 'required',
        ]);
        $parent = $request->parent;
        foreach($request->subcategory_id as $key => $value){
            if($request->mode[$key] == 2){
                $isExists1 =  RelativeSubCategory::where('sub_cat_id',$parent)->where('relative_id',$value)->exists();
                if($isExists1 == false){
                    $relative = new RelativeSubCategory();
                    $relative->sub_cat_id = $parent;
                    $relative->relative_id = $value;
                    $relative->save();
                }
                $isExists2 =  RelativeSubCategory::where('sub_cat_id',$value)->where('relative_id',$parent)->exists();
                if($isExists2 == false){
                    $relative = new RelativeSubCategory();
                    $relative->sub_cat_id = $value;
                    $relative->relative_id = $parent;
                    $relative->save();
                }
            }
            else{
                $isExists =  RelativeSubCategory::where('sub_cat_id',$parent)->where('relative_id',$value)->exists();
                if($isExists == false){
                    $relative = new RelativeSubCategory();
                    $relative->sub_cat_id = $parent;
                    $relative->relative_id = $value;
                    $relative->save();
                }
            }
        }
        return redirect()->route('relative.show',$parent);
    }

    */

    

    
}

<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\SubCategoryRequest;
use App\Models\SubCategory;
use App\Models\SubcategoryKeyword;
use App\Models\Category;
use App\Models\CategorySubCategory;
use DB;
use GuzzleHttp\Client;

class SubCategoryController extends Controller
{

    public function addSubcategory($id)
    {
        $sub = CategorySubCategory::where('category_id',$id)->count('id');
        $category = Category::find($id);
        return view('settings.subcategory.create',compact('category','sub'));
    }

    public function index(Request $request)
    { 
        $query = SubCategory::with('category');
        if(!is_null($request->category_id)){
            $query->join('category_sub_categories','category_sub_categories.sub_category_id','sub_categories.id')
                    ->where('category_sub_categories.category_id',$request->category_id)->get();
           $subcategories = $query->orderBy('sub_categories.name')->paginate(100);
        } 
        else{
            $subcategories = $query->where('id',0.1)->paginate(10);
        }
        $category = Category::find($request->category_id);
        return view('settings.subcategory.index',compact('subcategories','category'));
    }

    public function getLatestCode(Request $request)
    {
        $id = $request->category_id;
        $sub = CategorySubCategory::where('category_id',$id)->count('id');
        $category = Category::find($id);
        $s1 = $category->code;
        $s2 = $sub + 1;
        return $s1.'.'.$s2;
    }

    public function store(SubCategoryRequest $request)
    {
        DB::beginTransaction();
        try{
            if(!$request->cat_id){
                $services               = new SubCategory();
                $services->name         = $request->name;
                $services->code         = $request->code;
                $services->status       =1;
                $services->save();
            
                if($request->keywords){
                    foreach(explode(';',$request->keywords) as $row){
                        SubcategoryKeyword::create([
                            'sub_category_id' => $services->id,
                            'keyword' => $row
                        ]);
                    }
                }

                CategorySubCategory::create([
                    'category_id' => $request->category_id,
                    'sub_category_id' => $services->id
                ]);
            }
            else{
                CategorySubCategory::create([
                        'category_id' => $request->category_id,
                        'sub_category_id' => $request->cat_id
                ]);
            }
            
             // Construct the data payload for MeiliSearch
            $subcategory = SubCategory::find($services->id); 
            $data = [
                "id" => $subcategory->id,
                "name" => $subcategory->name,
                "code" => $subcategory->code,
                "status" => 1,
                "keywords" => $subcategory->id,
                "price" => $subcategory->price,
                "created_at" => $subcategory->created_at->toIso8601String(), // Convert to ISO 8601 string
                "updated_at" => $subcategory->updated_at->toIso8601String(), // Convert to ISO 8601 string
                "sub_keywords" => $subcategory->sub_keywords->pluck('keyword')->toArray()
            ];
    
            $client = new Client();
    
            // Send the request to MeiliSearch
            $response = $client->request('PUT', 'https://search.dialectb2b.com/indexes/sub_categories/documents', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer b658c039e6136a82cd7a61e9fa3e0fc384129c8d4321b72529a0af01bd178b2b',
                ],
                'json' => [$data] // Pass an array containing the data
            ]);
            DB::commit();
            return redirect()->route('category.subcatlist',$request->category_id)->with('success','SubCategory has been created!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }

        
    }

    public function editSubcategory ($category_id,$subcategory_id)
    {
        $category = Category::find($category_id);
        $subcategory = SubCategory::find($subcategory_id);
        return view('settings.subcategory.edit',compact('subcategory','category'));
    }

public function update(SubCategoryRequest $request, $id)
{
    DB::beginTransaction();
    try {
        $subcategory = SubCategory::find($id);
        $subcategory->update($request->validated());

        if ($request->keywords) {
            SubcategoryKeyword::where('sub_category_id', $id)->delete();
            foreach (explode(';', $request->keywords) as $row) {
                SubcategoryKeyword::create([
                    'sub_category_id' => $subcategory->id,
                    'keyword' => $row
                ]);
            }
        }

        // Construct the data payload for MeiliSearch
        $data = [
            "id" => $subcategory->id,
            "name" => $subcategory->name,
            "code" => $subcategory->code,
            "status" => 1,
            "keywords" => $subcategory->id,
            "price" => $subcategory->price,
            "created_at" => $subcategory->created_at->toIso8601String(), // Convert to ISO 8601 string
            "updated_at" => $subcategory->updated_at->toIso8601String(), // Convert to ISO 8601 string
            "sub_keywords" => $subcategory->sub_keywords->pluck('keyword')->toArray()
        ];

        $client = new Client();

        // Send the request to MeiliSearch
        $response = $client->request('PUT', 'https://search.dialectb2b.com/indexes/sub_categories/documents', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer b658c039e6136a82cd7a61e9fa3e0fc384129c8d4321b72529a0af01bd178b2b',
            ],
            'json' => [$data] // Pass an array containing the data
        ]);

        DB::commit();
        return redirect()->route('category.subcatlist', $request->category_id)->with('success', 'Subcategory has been updated!');
    } catch (Throwable $e) {
        DB::rollback();
        return redirect()->back()->with('warning', 'Something went wrong! Please try again.');
    }
}

    public function show(SubCategory $subcategory)
    {
        return view('settings.subcategory.show',compact('subcategory'));
    }

    public function viewSubcategory ($category_id,$subcategory_id){
        $category = Category::find($category_id);
        $subcategory = SubCategory::with('sub_keywords')->find($subcategory_id);
        return view('settings.subcategory.show',compact('subcategory','category'));
    }

    public function fetchName(Request $request){
        $search = $request->search;
        if($search == ''){
            $services = SubCategory::orderby('name','asc')->select('id','name','code')->limit(5)->get();
        } else {
            $services = SubCategory::orderby('name','asc')->select('id','name','code')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }
        $response = array();
        foreach($services as $service){
            $response[] = array("id"=> $service->id, "value"=>$service->name,"label"=>$service->name, 'code' => $service->code);
        }
        return response()->json($response);
    }

    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        
       $catsub = DB::select(DB::raw('
            SELECT * 
            FROM category_sub_categories 
            WHERE category_id != ? 
            AND sub_category_id = ?
        '), [$subcategory->category_id, $id]);
     
        if(count($catsub) > 0){
            return redirect()->back()->with('warning','Subcategory is assigned to category. Delete that first to delete subcategory!');
        }
        DB::beginTransaction();
        try{
            $subcategory = SubCategory::findOrFail($id);
           
            $subcategory->delete();
            
            
            DB::commit();
            return redirect()->back()->with('success','Subcategory has been deleted!');
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
            $subcategory = SubCategory::findOrFail($id);
            $subcategory->status= $subcategory->status ==1 ? 0: 1;
            $subcategory->save();
            DB::commit();
            return redirect()->back()->with('success','Subcategory status has been updated!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function deleteKeyword($id){
        DB::beginTransaction();
        try{
            $keyword = SubcategoryKeyword::find($id);
            $keyword->delete();
            DB::commit();
            return redirect()->back()->with('success','Keyword has been deleted!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    } 
    

}

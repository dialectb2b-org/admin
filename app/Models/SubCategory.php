<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\PerformedBy;
use App\Models\Category;
use Laravel\Scout\Searchable;

class SubCategory extends Model
{
    use HasFactory,Searchable;
    
    protected $guarded = [''];
    
    protected $with = [
        'sub_keywords'
    ];
    
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    
    public function sub_keywords(){
        return $this->hasMany(SubcategoryKeyword::class,'sub_category_id','id');
    }
    
    public function sub_keywords_keyword()
    {
        return $this->hasMany(SubcategoryKeyword::class, 'sub_category_id', 'id')->select(['keyword']);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_sub_categories', 'sub_category_id', 'category_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_activities', 'activity_id', 'company_id');
    }
    
    public function searchable(): bool
    {
        foreach ($this->sub_keywords as $sub_keyword) {
            if ($sub_keyword->searchable) {
                return true;
            }
        }
    
        return false;
    }

    // public function searchable(): bool
    // {
    //     return  $this->sub_keywords->searchable; //$this->published ||
    // }
    

    public function toSearchableArray(): array
    {
        $array = $this->toArray();
        
        // Include the sub_keyword names in the searchable array
        $array['name'] = $this->name;
        $array['sub_keywords'] = $this->sub_keywords;
        
        return $array;
    }

    public static function getSearchFilterAttributes(): array
    {
        return [ 'sub_keywords' ];
    }

    
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelativeSubCategory extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_cat_id','id');
    }

    public function relative(){
        return $this->belongsTo(SubCategory::class,'relative_id','id');
    }
}

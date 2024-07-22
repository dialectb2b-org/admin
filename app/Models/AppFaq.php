<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppFaq extends Model
{
    use HasFactory;

    protected $guarded = [''];
    
    public function category(){
        return $this->belongsTo(AppFaqCategory::class,'category_id','id');
    }
}

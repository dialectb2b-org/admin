<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreRegisteredCompanyActivity extends Model
{
    
    protected $guarded = [''];

    public function service()
    {
        return $this->belongsTo(SubCategory::class,'activity_id','id');
    }
    
}

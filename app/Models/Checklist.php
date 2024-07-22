<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function document(){
        return $this->hasOne(CompanyDocument::class,'company_id','id');
    }
}

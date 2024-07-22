<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreRegisteredCompany extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function activities(){
        return $this->hasMany(PreRegisteredCompanyActivity::class,'company_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Region extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_locations', 'region_id', 'company_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CompanyUser extends Authenticatable
{
    protected $guarded = [''];

    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
}

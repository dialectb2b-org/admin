<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CompanyDocument extends Model
{
        
    public function document()
    {
        return $this->belongsTo(Document::class,'doc_type','id');
    }
}

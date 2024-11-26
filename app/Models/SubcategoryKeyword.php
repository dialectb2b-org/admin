<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\PerformedBy;

class SubcategoryKeyword extends Model
{
    use HasFactory;

    protected $guarded = [''];
    
    protected $table = 'sub_category_keywords';
}

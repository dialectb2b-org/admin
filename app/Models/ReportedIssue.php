<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportedIssue extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function enquiry(){
        return $this->belongsTo(Enquiry::class,'enquiry_id','id');
    }

    public function reporter(){
        return $this->belongsTo(CompanyUser::class,'reported_by','id');
    }

    public function question(){
        return $this->belongsTo(EnquiryFaq::class,'question_id','id');
    }
}

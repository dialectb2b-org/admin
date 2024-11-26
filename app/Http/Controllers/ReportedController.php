<?php

namespace App\Http\Controllers;

use App\Models\ReportedIssue;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class ReportedController extends Controller
{
    public function index(Request $request)
    {
        $mails = ReportedIssue::with('enquiry','reporter')->paginate(10);
        return view('reported.index', compact('mails'));
    }


    public function show($id)
    {
        $mail = ReportedIssue::with('enquiry','reporter')->find($id);
        return view('reported.show',compact('mail'));
    }
}
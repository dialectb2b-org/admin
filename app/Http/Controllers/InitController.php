<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class InitController extends Controller
{
    public function index(){
        $user = User::all();
        return view('welcome',compact('user'));
    }
}

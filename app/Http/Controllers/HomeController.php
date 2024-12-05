<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UserType;

class HomeController extends Controller
{
    public function index(){
        if(Auth::id()){
            $usertype=Auth()->user()->role;

            if($usertype=='parent'){
                return view('parents');
            }
            elseif($usertype=='admin'){
                return view('admin');
            }
            elseif($usertype=='teacher'){
                return view('teacher');
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrincipalController extends Controller
{
    function __construct (){

        $this->middleware('auth');
    }
    
    function index(){

        $user = Auth::user();

        return view('auth.principal');
    }
}

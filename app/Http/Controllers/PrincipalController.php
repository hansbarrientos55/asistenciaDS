<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    function __construct (){

        $this->middleware('auth');
    }
    
    function index(){

        return view('auth.principal');
    }
}

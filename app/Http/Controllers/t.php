<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class t extends Controller
{
    public function index (Request $request) {
     
        $t = $request-> file('t');
        dd($t); 
    }
}

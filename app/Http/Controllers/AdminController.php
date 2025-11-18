<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        dump(123);
        return view('admin.dasboard');

    }
}

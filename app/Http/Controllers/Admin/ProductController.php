<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
   public function index()
    {
        return view('layouts.admin.products.index');
    }

    public function create(){
        return view('layouts.admin.products.create');
    }
    public function edit(Product $product){

        return view('layouts.admin.products.edit', compact('product'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage(){
        if (auth()->check()) {
            return redirect()->route('products.index');
        }
        else {
            $products = Product::all();
            return view('home', compact('products'));
        }
    }
}

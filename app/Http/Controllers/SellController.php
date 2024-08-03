<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SellController extends Controller
{

    public function create()
    {
        $products = Product::all();

        return view('sells.create', ['products' => $products]);
    }
}

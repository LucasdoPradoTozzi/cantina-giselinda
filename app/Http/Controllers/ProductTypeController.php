<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{

    public function index()
    {
        $productTypes = ProductType::latest()->paginate(10);
        return view('productTypes.index', ['productTypes' => $productTypes]);
    }

    public function create()
    {
        return view('productTypes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        ProductType::create([
            'name'            => $request->input('name')
        ]);

        return redirect()->route('productTypes.index');
    }

    public function show($id)
    {
        $productType = ProductType::where('id', $id)->firstOrFail();
        return view('productTypes.show', [
            'productType' => $productType
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'            => 'required'
        ]);

        $product = ProductType::where('id', $id)->firstOrFail();

        $product->update([
            'name'            => $request->input('name')
        ]);

        return redirect()->route('productTypes.index');
    }
}

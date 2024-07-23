<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->with('productType')->paginate(10);
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        $productTypes = ProductType::latest()->get();
        return view('products.create', ['productTypes' => $productTypes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required',
            'value'           => 'required|numeric',
            'product_type_id' => 'required|exists:product_types,id',
            'minimum_amount'  => 'required|integer',
            'maximum_amount'  => 'required|integer'
        ]);

        Product::create([
            'name'            => $request->input('name'),
            'value'           => $request->input('value'),
            'product_type_id' => $request->input('product_type_id'),
            'minimum_amount'  => $request->input('minimum_amount'),
            'maximum_amount'  => $request->input('maximum_amount'),
        ]);

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::with('productType')->where('id', $id)->firstOrFail();
        $productTypes = ProductType::latest()->get();
        return view('products.show', [
            'product' => $product,
            'productTypes' => $productTypes
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'            => 'required',
            'value'           => 'required|numeric',
            'product_type_id' => 'required|exists:product_types,id',
            'minimum_amount'  => 'required|integer',
            'maximum_amount'  => 'required|integer'
        ]);

        $product = Product::with('productType')->where('id', $id)->firstOrFail();

        $product->update([
            'name'            => $request->input('name'),
            'value'           => $request->input('value'),
            'product_type_id' => $request->input('product_type_id'),
            'minimum_amount'  => $request->input('minimum_amount'),
            'maximum_amount'  => $request->input('maximum_amount'),
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();

        return redirect('/products');
    }
}

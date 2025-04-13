<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Stock;
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
            'description'     => 'required',
            'value'           => 'required|numeric',
            'buy_value'       => 'required|numeric',
            'product_type_id' => 'required|exists:product_types,id',
            'minimum_amount'  => 'required|integer',
            'maximum_amount'  => 'required|integer',
        ]);

        $photoPath = "noPhoto.jpg";

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            $photoPath = PhotoController::store($photo);
        }

        $product = Product::create([
            'name'            => $request->input('name'),
            'description'     => $request->input('description'),
            'buy_value'       => $request->input('buy_value'),
            'value'           => $request->input('value'),
            'product_type_id' => $request->input('product_type_id'),
            'minimum_amount'  => $request->input('minimum_amount'),
            'maximum_amount'  => $request->input('maximum_amount'),
            'photo_path'      => $photoPath
        ]);

        Stock::create(
                    ['product_id' => $product->id,
                        'quantity' => 0
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
            'description'     => 'required',
            'buy_value'       => 'required|numeric',
            'value'           => 'required|numeric',
            'product_type_id' => 'required|exists:product_types,id',
            'minimum_amount'  => 'required|integer',
            'maximum_amount'  => 'required|integer'
        ]);

        $product = Product::with('productType')->where('id', $id)->firstOrFail();

        $photoPath = $product->photo_path;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            $photoPath = PhotoController::store($photo);
        }

        $product->update([
            'name'            => $request->input('name'),
            'description'     => $request->input('description'),
            'buy_value'       => $request->input('buy_value'),
            'value'           => $request->input('value'),
            'product_type_id' => $request->input('product_type_id'),
            'minimum_amount'  => $request->input('minimum_amount'),
            'maximum_amount'  => $request->input('maximum_amount'),
            'photo_path'      => $photoPath
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();

        return redirect('/products');
    }
}

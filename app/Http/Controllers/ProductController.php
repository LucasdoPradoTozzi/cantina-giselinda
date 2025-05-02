<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Stock;
use Illuminate\Http\Request;

use App\Services\MoneyService;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()
            ->with('productType')
            ->paginate(10);

        $moneyService = new MoneyService();

        $products->getCollection()->transform(function ($product) use ($moneyService) {
            $product->value = $moneyService->convertIntegerToString($product->value);
            return $product;
        });

        return view('products.index', ['products' => $products]);
    }
    public function create()
    {
        $productTypes = ProductType::latest()->get();
        return view('products.create', ['productTypes' => $productTypes]);
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            $request->validate([
                'name'            => 'required',
                'description'     => 'required',
                'value'           => 'required|string',
                'buy_value'       => 'required|string',
                'product_type_id' => 'required|exists:product_types,id',
                'minimum_amount' => 'required|integer|min:1',
                'maximum_amount' => 'required|integer|gt:minimum_amount',
            ]);

            $moneyService = new MoneyService();

            $buyValue = $moneyService->convertStringToInteger($request->input('buy_value'));
            $value = $moneyService->convertStringToInteger($request->input('value'));
            $photo = ($request->hasFile('photo')) ? $request->file('photo') : null;

            $photoPath =  !empty($photo) ? PhotoController::store($photo) : null;

            $product = Product::create([
                'name'            => $request->input('name'),
                'description'     => $request->input('description'),
                'buy_value'       => $buyValue,
                'value'           => $value,
                'product_type_id' => $request->input('product_type_id'),
                'minimum_amount'  => $request->input('minimum_amount'),
                'maximum_amount'  => $request->input('maximum_amount'),
                'photo_path'      => $photoPath
            ]);

            Stock::create(
                [
                    'product_id' => $product->id,
                    'quantity' => 0
                ]
            );

            DB::commit();
            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Erro ao salvar o produto. Tente novamente.'
            ], 400);
        }
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

        try {
            DB::beginTransaction();

            $request->validate([
                'name'            => 'required',
                'description'     => 'required',
                'value'           => 'required|string',
                'buy_value'       => 'required|string',
                'product_type_id' => 'required|exists:product_types,id',
                'minimum_amount' => 'required|integer|min:1',
                'maximum_amount' => 'required|integer|gt:minimum_amount',
            ]);

            $product = Product::with('productType')->where('id', $id)->firstOrFail();

            $photoPath = $product->photo_path;

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');

                $photoPath = PhotoController::store($photo);
            }

            $moneyService = new MoneyService();

            $buyValue = $moneyService->convertStringToInteger($request->input('buy_value'));
            $value = $moneyService->convertStringToInteger($request->input('value'));


            $product->update([
                'name'            => $request->input('name'),
                'description'     => $request->input('description'),
                'buy_value'       => $buyValue,
                'value'           => $value,
                'product_type_id' => $request->input('product_type_id'),
                'minimum_amount'  => $request->input('minimum_amount'),
                'maximum_amount'  => $request->input('maximum_amount'),
                'photo_path'      => $photoPath
            ]);



            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Erro ao salvar o produto. Tente novamente.'
            ], 400);
        }
    }


    public function delete($id)
    {
        Product::findOrFail($id)->delete();

        return redirect('/products');
    }
}

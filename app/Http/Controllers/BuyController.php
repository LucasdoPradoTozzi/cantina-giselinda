<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Product;
use App\Models\PurchaseItem;
use App\Models\Stock;
use Dotenv\Validator;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buys = Buy::with('purchaseItem')
            ->withSum('purchaseItem', 'total_price')
            ->paginate(10);


        return view('buys.index', ['buys' => $buys]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('buys.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $buy = Buy::create(
            [
                'title' => $request->title
            ]
        );

        $idBuy = $buy->id;

        foreach ($request->products as $product) {
            PurchaseItem::create([
                'product_id' => $product['product_id'],
                'buy_id' => $idBuy,
                'amount' => $product['amount'],
                'price_by_item' => $product['price_by_item'],
                'total_price' => $product['amount'] * $product['price_by_item']
            ]);

            $stock = Stock::where('product_id', $product['product_id'])->firstOrFail();
            $stock->quantity += $product['amount'];
            $stock->save();
        }
        return redirect('/buys');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $buy = Buy::with('purchaseItem.product')
            ->withSum('purchaseItem', 'total_price')
            ->where('id', $id)
            ->firstOrFail();


        return view('buys.show', [
            'buy' => $buy
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

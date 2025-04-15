<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Product;
use App\Models\PurchaseItem;
use App\Models\Stock;
use Dotenv\Validator;
use Exception;
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

        $buys->getCollection()->transform(function ($buy) {

            $buy->purchase_item_sum_total_price = bcdiv(
                (string) $buy->purchase_item_sum_total_price,
                '100',
                2
            );
            return $buy;
        });

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



        foreach ($request->products as $purchasedProduct) {

            $product = Product::where('id', $purchasedProduct['product_id'])->first();
            if (!$product) throw new Exception('Produto inexistente.');

            $priceByItem = (!empty($purchasedProduct['price_by_item'])) ? $purchasedProduct['price_by_item']
                : bcdiv((string) $product->buy_value, '100', 2);

            $totalPrice = bcmul($priceByItem, (string) $purchasedProduct['amount'], 2);

            $priceByItem = (int) bcmul($priceByItem, '100', 2);
            $totalPrice = (int) bcmul($totalPrice, '100', 2);

            PurchaseItem::create([
                'product_id' => $product->id,
                'buy_id' => $idBuy,
                'amount' => $purchasedProduct['amount'],
                'price_by_item' => $priceByItem,
                'total_price' => $totalPrice
            ]);

            $stock = Stock::where('product_id', $product->id)->firstOrFail();
            $stock->quantity += $purchasedProduct['amount'];
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

        $buy->purchase_item_sum_total_price = bcdiv((string) $buy->purchase_item_sum_total_price, '100', 2);

        $buy->purchaseItem = $buy->purchaseItem->map(function ($item) {
            $item->total_price = bcdiv((string) $item->total_price, '100', 2);
            $item->price_by_item = bcdiv((string) $item->price_by_item, '100', 2);
            return $item;
        });

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

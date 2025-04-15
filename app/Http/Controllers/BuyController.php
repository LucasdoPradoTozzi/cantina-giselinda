<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Product;
use App\Models\PurchaseItem;
use App\Models\Stock;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;

use App\Services\MoneyService;

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

        $moneyService = new MoneyService();

        $buys->getCollection()->transform(function ($buy) use ($moneyService) {
            if (isset($buy->purchase_item_sum_total_price)) {
                $buy->purchase_item_sum_total_price = $moneyService->convertIntegerToString($buy->purchase_item_sum_total_price);
            }
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


        $moneyService = new MoneyService();

        foreach ($request->products as $purchasedProduct) {

            $product = Product::where('id', $purchasedProduct['product_id'])->first();
            if (!$product) throw new Exception('Produto inexistente.');

            $priceByItem = (!empty($purchasedProduct['price_by_item']))
                ? $moneyService->convertStringToInteger($purchasedProduct['price_by_item'])
                : $product->buy_value;

            $totalPrice = $moneyService->getMultiplicationIntegerValue($priceByItem, $purchasedProduct['amount']);

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

        $moneyService = new MoneyService();

        $buy->purchase_item_sum_total_price = $moneyService->convertIntegerToString($buy->purchase_item_sum_total_price);

        $buy->purchaseItem = $buy->purchaseItem->map(function ($item) use ($moneyService) {
            $item->total_price = $moneyService->convertIntegerToString($item->total_price);
            $item->price_by_item = $moneyService->convertIntegerToString($item->price_by_item);
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

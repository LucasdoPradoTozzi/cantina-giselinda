<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sell;
use App\Models\SoldItem;
use App\Models\Stock;
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Services\MoneyService;

class SellController extends Controller
{
    public function index()
    {
        $sells = Sell::with('soldItem')
            ->withSum('soldItem', 'sold_price')
            ->paginate(10);

        $moneyService = new MoneyService();

        $sells->getCollection()->transform(function ($sell) use ($moneyService) {
            $sell->sold_item_sum_sold_price = $moneyService->convertIntegerToString($sell->sold_item_sum_sold_price);
            return $sell;
        });

        return view('sells.index', ['sells' => $sells]);
    }

    public function create()
    {
        $products = Product::all();

        $customers = Customer::all();

        return view('sells.create', ['products' => $products, 'customers' => $customers]);
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $sell = Sell::create([
                'title' => $request->title
            ]);

            $idSell = $sell->id;

            $moneyService = new MoneyService();

            foreach ($request->products as $product) {
                $productById = Product::where('id', $product['product_id'])->firstOrFail();
                $wasAOffer = 0;

                $soldPrice = $moneyService->getMultiplicationIntegerValue($productById->value, $product['amount']);

                SoldItem::create([
                    'product_id' => $product['product_id'],
                    'sell_id' => $idSell,
                    'amount' => $product['amount'],
                    'price_by_item' => $productById->value,
                    'sold_price' => $soldPrice,
                    'was_a_offer' => $wasAOffer
                ]);

                $stock = Stock::where('product_id', $productById->id)->firstOrFail();
                $stock->quantity -= $product['amount'];
                $stock->save();
            }

            DB::commit();
            return redirect('/sells');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function show(String $id)
    {
        $sell = Sell::with('soldItem.product')
            ->withSum('soldItem', 'sold_price')
            ->where('id', $id)
            ->firstOrFail();

        $moneyService = new MoneyService();

        $sell->sold_item_sum_sold_price = $moneyService->convertIntegerToString($sell->sold_item_sum_sold_price);

        $sell->soldItem = $sell->soldItem->map(function ($item) use ($moneyService) {
            $item->sold_price = $moneyService->convertIntegerToString($item->sold_price);
            $item->price_by_item = $moneyService->convertIntegerToString($item->price_by_item);
            return $item;
        });

        return view('sells.show', [
            'sell' => $sell
        ]);
    }
}

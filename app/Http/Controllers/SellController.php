<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sell;
use App\Models\SoldItem;
use App\Models\Stock;
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellController extends Controller
{
    public function index()
    {
        $sells = Sell::with('soldItem')
            ->withSum('soldItem', 'sold_price')
            ->paginate(10);

        $sells->getCollection()->transform(function ($sell) {

            $sell->sold_item_sum_sold_price = bcdiv(
                (string) $sell->sold_item_sum_sold_price,
                '100',
                2
            );
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

            foreach ($request->products as $product) {
                $productById = Product::where('id', $product['product_id'])->firstOrFail();
                $wasAOffer = 0;

                $itemPrice = bcdiv((string) $productById->value, '100', 2);
                $soldPrice = bcmul($itemPrice, $product['amount'], 2);
                $soldPrice = (int) bcmul($soldPrice, '100', 2);


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

        $sell->sold_item_sum_sold_price = bcdiv((string) $sell->sold_item_sum_sold_price, '100', 2);

        $sell->soldItem = $sell->soldItem->map(function ($item) {
            $item->sold_price = bcdiv((string) $item->sold_price, '100', 2);
            $item->price_by_item = bcdiv((string) $item->price_by_item, '100', 2);
            return $item;
        });

        return view('sells.show', [
            'sell' => $sell
        ]);
    }
}

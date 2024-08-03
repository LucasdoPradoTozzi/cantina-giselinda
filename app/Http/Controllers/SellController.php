<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sell;
use App\Models\SoldItem;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellController extends Controller
{
    public function index()
    {
        $sells = Sell::with('soldItem')
            ->withSum('soldItem', 'sold_price')
            ->paginate(10);


        return view('sells.index', ['sells' => $sells]);
    }

    public function create()
    {
        $products = Product::all();

        return view('sells.create', ['products' => $products]);
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

                $soldPrice = (!empty($product['sold_price'])) ? $product['sold_price'] : "";
                $wasAOffer = 1;

                if (empty($soldPrice)) {
                    $soldPrice = $product['amount'] * $productById->value;
                    $wasAOffer = 0;
                }

                SoldItem::create([
                    'product_id' => $product['product_id'],
                    'sell_id' => $idSell,
                    'amount' => $product['amount'],
                    'price_by_item' => $productById->value,
                    'sold_price' => $soldPrice,
                    'was_a_offer' => $wasAOffer
                ]);

                $stock = Stock::where('product_id', $product['product_id'])->firstOrFail();
                $stock->quantity -= $product['amount'];
                $stock->save();
            }

            DB::commit();
            return redirect('/sells');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}

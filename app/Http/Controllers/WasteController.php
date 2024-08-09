<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Waste;
use App\Models\WasteItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WasteController extends Controller
{
    public function index()
    {
        $wastes = Waste::with('wasteItem')
            ->withSum('wasteItem', 'total_price')
            ->paginate(10);


        return view('wastes.index', ['wastes' => $wastes]);
    }

    public function create()
    {
        $products = Product::all();

        return view('wastes.create', ['products' => $products]);
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $waste = Waste::create([
                'title' => $request->title
            ]);

            $wasteId = $waste->id;

            foreach ($request->products as $product) {

                $productInfo = Product::where('id', $product['product_id'])->firstOrFail();

                WasteItem::create([
                    'product_id' => $product['product_id'],
                    'waste_id' => $wasteId,
                    'amount' => $product['amount'],
                    'price_by_item' => $productInfo->buy_value,
                    'total_price' => $product['amount'] * $productInfo->buy_value
                ]);

                $stock = Stock::where('product_id', $product['product_id'])->firstOrFail();
                $stock->quantity -= $product['amount'];
                $stock->save();
            }

            DB::commit();
            return redirect('/wastes');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function show(String $id)
    {
        $waste = Waste::with('wasteItem.product')
            ->withSum('wasteItem', 'total_price')
            ->where('id', $id)
            ->firstOrFail();

        return view('wastes.show', [
            'waste' => $waste
        ]);
    }
}

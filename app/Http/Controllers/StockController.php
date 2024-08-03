<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stock = Stock::with('product.productType')->paginate(10);
        return view('stock.index', ['stock' => $stock]);
    }

    public function getStockByProductId($id)
    {
        $stockItem = Stock::where('id', $id)->firstOrFail();

        $quantity = $stockItem->quantity;

        if ($quantity <= 0) return "Sem estoque desse produto";

        return $quantity;
    }
}

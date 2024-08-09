<?php

namespace App\Http\Controllers;

use App\Models\SoldItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getTopFiveBestSellers()
    {

        $sumByProductId = SoldItem::select('product_id', DB::raw('SUM(amount) as total_amount'))
            ->with('product')
            ->groupBy('product_id')
            ->orderBy(DB::raw('total_amount'), 'desc')
            ->limit(5)
            ->get();



        $productNames = [];
        $productAmounts = [];

        if (!empty($sumByProductId)) {


            foreach ($sumByProductId as $productData) {
                $productNames[] = $productData->product->name;
                $productAmounts[] = $productData->total_amount;
            }
        }

        $data = [
            'labels' => $productNames,
            'datasets' => [
                [
                    'label' => 'Top 5 Produtos vendidos',
                    'data' => $productAmounts,
                    'backgroundColor' => ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
                ]
            ]
        ];
        return response()->json($data);
    }
}

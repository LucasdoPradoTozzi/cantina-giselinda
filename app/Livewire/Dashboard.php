<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SoldItem;
use App\Models\WasteItem;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $bestSellers;

    public function mount()
    {
        $this->bestSellers = $this->getTopFiveBestSellers();
    }

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

        foreach ($sumByProductId as $productData) {
            $productNames[] = $productData->product->name;
            $productAmounts[] = $productData->total_amount;
        }

        return [
            'labels' => $productNames,
            'datasets' => [
                [
                    'label' => 'Top 5 Produtos vendidos',
                    'data' => $productAmounts,
                    'backgroundColor' => [
                        '#4F46E5',
                        '#6366F1',
                        '#818CF8',
                        '#A5B4FC',
                        '#C7D2FE'
                    ],
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

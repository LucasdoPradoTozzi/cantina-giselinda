<?php

namespace App\Livewire;

use App\Models\Sell;
use App\Services\MoneyService;
use Livewire\Component;
use Livewire\WithPagination;

class SellIndex extends Component
{

    use WithPagination;

    public function render()
    {

        $sells = Sell::with('soldItem')
            ->withSum('soldItem', 'sold_price')
            ->paginate(10);

        $moneyService = new MoneyService();

        $sells->getCollection()->transform(function ($sell) use ($moneyService) {
            $sell->sold_item_sum_sold_price = $moneyService->convertIntegerToString($sell->sold_item_sum_sold_price);
            return $sell;
        });

        return view('livewire.sell-index', [
            'sells' => $sells,
        ]);
    }
}

<?php

namespace App\Livewire;

use App\Models\Sell;
use App\Services\MoneyService;
use Livewire\Component;

class ShowSell extends Component
{
    public Sell $sell;

    public function mount($id)
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


        $this->sell = $sell;
    }

    public function render()
    {
        return view('livewire.show-sell');
    }
}

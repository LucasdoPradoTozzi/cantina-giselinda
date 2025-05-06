<?php

namespace App\Livewire;

use App\Models\Buy;
use App\Services\MoneyService;
use Livewire\Component;

class BuysShow extends Component
{

    public Buy $buy;

    public function mount($id)
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

        $this->buy = $buy;
    }
    public function render()
    {
        return view('livewire.buys-show', ['buy' => $this->buy]);
    }
}

<?php

namespace App\Livewire;

use App\Models\Buy;
use App\Services\MoneyService;
use Livewire\Component;
use Livewire\WithPagination;

class BuysIndex extends Component
{
    use WithPagination;

    public $search = '';
    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $buys = Buy::with('purchaseItem')
            ->withSum('purchaseItem', 'total_price')
            ->where('title', 'like', '%' . $this->search . '%')
            ->paginate(9);

        $moneyService = new MoneyService();

        $buys->getCollection()->transform(function ($buy) use ($moneyService) {
            if (isset($buy->purchase_item_sum_total_price)) {
                $buy->purchase_item_sum_total_price = $moneyService->convertIntegerToString($buy->purchase_item_sum_total_price);
            }
            return $buy;
        });

        return view('livewire.buys-index', ['buys' => $buys]);
    }
}

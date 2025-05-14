<?php

namespace App\Livewire;

use App\Models\Stock;
use Livewire\Component;
use Livewire\WithPagination;

class StockIndex extends Component
{

    use WithPagination;


    public function render()
    {

        $stock = Stock::with('product.productType')->paginate(5);


        return view('livewire.stock-index', ['stock' => $stock]);
    }
}

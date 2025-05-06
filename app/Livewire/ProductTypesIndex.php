<?php

namespace App\Livewire;

use App\Models\ProductType;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTypesIndex extends Component
{
    use WithPagination;



    public function render()
    {
        $productTypes = ProductType::latest()->paginate(10);
        return view('livewire.product-types-index', ['productTypes' => $productTypes]);
    }
}

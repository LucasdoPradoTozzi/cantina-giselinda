<?php

namespace App\Livewire;

use App\Models\ProductType;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTypesIndex extends Component
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
        $productTypes = ProductType::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);
        return view('livewire.product-types-index', ['productTypes' => $productTypes]);
    }
}

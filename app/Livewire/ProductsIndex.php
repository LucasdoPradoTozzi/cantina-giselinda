<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsIndex extends Component
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
        $products = Product::with('stock', 'productType')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate(12);

        return view('livewire.products-index', [
            'products' => $products,
        ]);
    }
}

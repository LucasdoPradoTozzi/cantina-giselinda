<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerIndex extends Component
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
        $customers = Customer::where('name', 'like', '%' . $this->search . '%')
            ->paginate(12);

        return view('livewire.customer-index', ['customers' => $customers]);
    }
}

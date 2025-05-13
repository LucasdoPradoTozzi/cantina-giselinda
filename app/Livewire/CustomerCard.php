<?php

namespace App\Livewire;

use App\Models\Customer;
use Carbon\Carbon;

use Livewire\Component;

class CustomerCard extends Component
{

    public Customer $customer;
    public $customerBirthday = null;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        if ($this->customer->birthday) {
            $birthday = Carbon::parse($this->customer->birthday);
            $this->customerBirthday = $birthday->format('d/m/Y');
        }
    }

    public function render()
    {
        return view('livewire.customer-card');
    }
}

<?php

namespace App\Livewire;

use Carbon\Carbon;

use Livewire\Component;

class CustomerCard extends Component
{

    public $customer;
    public $customerBirthday = null;

    public function mount($customer)
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

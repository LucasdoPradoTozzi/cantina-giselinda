<?php

namespace App\Livewire;

use App\Models\WasteReason;
use Livewire\Component;

class WasteReasonCard extends Component
{
    public WasteReason $wasteReason;

    public function render()
    {
        return view('livewire.waste-reason-card');
    }
}

<?php

namespace App\Livewire;

use App\Models\WasteReason;
use Livewire\Component;
use Livewire\WithPagination;

class WasteReasonIndex extends Component
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
        $wasteReasons = WasteReason::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.waste-reason-index', ['wasteReasons' => $wasteReasons]);
    }
}

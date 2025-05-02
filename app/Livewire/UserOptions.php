<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserOptions extends Component
{
    public $showOptions = false;

    public function toggleOptions()
    {
        $this->showOptions = !$this->showOptions;
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.user-options');
    }
}

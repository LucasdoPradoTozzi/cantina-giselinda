<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserOptions extends Component
{
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

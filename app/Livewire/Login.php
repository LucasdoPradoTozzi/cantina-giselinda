<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{

    public $email = '';
    public $password = '';
    public $remember = false;


    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $user = Auth::user();

            if (!$user->is_approved) {
                Auth::logout();
                $this->addError('authentication', 'Sua conta ainda não foi aprovada.');
                return;
            }


            session()->regenerate();

            return redirect()->intended('dashboard');
        }

        $this->addError('authentication', 'Credenciais inválidas!');
    }

    public function render()
    {
        return view('livewire.login');
    }
}

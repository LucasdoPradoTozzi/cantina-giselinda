<?php

namespace App\Livewire;

use App\Http\Controllers\PhotoController;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateUser extends Component
{

    use WithFileUploads;

    public $photo;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    // Validação do campo
    protected $rules = [
        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024', // Máximo de 1MB
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];

    protected $messages = [
        'photo.image' => 'A foto deve ser uma imagem válida.',
        'photo.mimes' => 'A imagem deve ser nos formatos: jpeg, png, jpg, gif ou svg.',
        'photo.max' => 'A imagem não pode ter mais de 1MB.',

        'name.required' => 'O nome é obrigatório.',
        'name.string' => 'O nome deve ser uma string válida.',
        'name.max' => 'O nome não pode exceder 255 caracteres.',

        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'O e-mail deve ser válido.',
        'email.unique' => 'Este e-mail já está em uso.',

        'password.required' => 'A senha é obrigatória.',
        'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        'password.confirmed' => 'As senhas não coincidem.',
    ];

    public function create()
    {
        $data = $this->validate();

        $photoPath = (!empty($data['photo'])) ?  PhotoController::store($data['photo']) : null;

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'photo_path' => $photoPath
        ]);

        return redirect()->intended('login');
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}

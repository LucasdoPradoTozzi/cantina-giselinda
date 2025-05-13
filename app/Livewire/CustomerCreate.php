<?php

namespace App\Livewire;

use App\Http\Controllers\PhotoController;
use App\Models\Customer;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CustomerCreate extends Component
{
    use WithFileUploads;

    public $photo;
    public $name;
    public $doc1;
    public $doc2;
    public $email;
    public $phone;
    public $birthday;

    protected $rules = [
        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        'name' => 'required|string|max:255',
        'email' => 'nullable|email',
        'doc1' => 'nullable|string|max:255|unique:customers,doc1',
        'doc2' => 'nullable|string|max:255|unique:customers,doc2',
        'phone' => 'nullable|string|max:255',
        'birthday' => 'nullable|date_format:Y-m-d',
    ];

    protected $messages = [
        'photo.image' => 'A foto deve ser uma imagem válida.',
        'photo.mimes' => 'A imagem deve ser nos formatos: jpeg, png, jpg, gif ou svg.',
        'photo.max' => 'A imagem não pode ter mais de 1MB.',

        'name.required' => 'O nome é obrigatório.',
        'name.string' => 'O nome deve ser uma string válida.',
        'name.max' => 'O nome não pode exceder 255 caracteres.',

        'email.email' => 'O e-mail informado não é válido.',
        'doc1.max' => 'O campo doc1 não pode exceder 255 caracteres.',
        'doc2.max' => 'O campo doc2 não pode exceder 255 caracteres.',
        'doc1.unique' => 'Este documento já está em uso.',
        'doc2.unique' => 'Este documento já está em uso.',
        'phone.max' => 'O telefone não pode exceder 255 caracteres.',

        'birthday.date_format' => 'A data de nascimento deve estar no formato YYYY-MM-DD.',
    ];


    public function create()
    {
        $data = $this->validate();

        $photoPath = (!empty($data['photo'])) ?  PhotoController::store($data['photo']) : null;

        Customer::create([
            'name' => $data['name'],
            'doc1' => $data['doc1'],
            'doc2' => $data['doc2'],
            'birthday' => $data['birthday'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'photo_path' => $photoPath
        ]);

        return redirect()->route('customer.index');;
    }

    public function render()
    {
        return view('livewire.customer-create');
    }
}

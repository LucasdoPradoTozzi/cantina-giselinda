<?php

namespace App\Livewire;

use App\Models\ProductType;
use Livewire\Component;

class CreateProductType extends Component
{
    public $name;

    protected function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    public function store()
    {
        $this->validate();

        ProductType::create([
            'name' => $this->name
        ]);

        session()->flash('message', 'Tipo de produto criado com sucesso!');
        return redirect()->route('productTypes.index');
    }

    public function render()
    {
        return view('livewire.create-product-type');
    }
}

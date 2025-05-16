<?php

namespace App\Livewire;

use App\Models\ProductType;
use Livewire\Component;

class EditProductType extends Component
{
    public ProductType $productType;
    public $name;

    public function mount(ProductType $productType)
    {
        $this->productType = $productType;
        $this->name = $productType->name;
    }

    protected function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    public function update()
    {
        $this->validate();

        $this->productType->update([
            'name' => $this->name
        ]);

        session()->flash('message', 'Tipo de produto atualizado com sucesso!');
        return redirect()->route('productTypes.index');
    }

    public function render()
    {
        return view('livewire.edit-product-type');
    }
}

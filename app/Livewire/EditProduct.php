<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    public Product $product;
    public $name;
    public $description;
    public $value;
    public $buyValue;
    public $productTypeId;
    public $minimumAmount;
    public $maximumAmount;
    public $photo;
    public $productTypes;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->value = $product->value;
        $this->buyValue = $product->buy_value;
        $this->productTypeId = $product->product_type_id;
        $this->minimumAmount = $product->minimum_amount;
        $this->maximumAmount = $product->maximum_amount;
        $this->productTypes = ProductType::all();
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'value' => 'required|numeric',
            'buyValue' => 'required|numeric',
            'productTypeId' => 'required|exists:product_types,id',
            'minimumAmount' => 'nullable|numeric',
            'maximumAmount' => 'nullable|numeric',
            'photo' => 'nullable|image|max:2048', // photo is NOT required
        ];
    }

    public function update()
    {
        $this->validate();
        $this->product->name = $this->name;
        $this->product->description = $this->description;
        $this->product->value = $this->value;
        $this->product->buy_value = $this->buyValue;
        $this->product->product_type_id = $this->productTypeId;
        $this->product->minimum_amount = $this->minimumAmount;
        $this->product->maximum_amount = $this->maximumAmount;
        if ($this->photo) {
            if ($this->product->photo_path) {
                Storage::disk('public')->delete('photos/' . $this->product->photo_path);
            }
            $path = $this->photo->store('photos', 'public');
            $this->product->photo_path = basename($path);
        }
        $this->product->save();
        session()->flash('success', 'Produto atualizado com sucesso!');
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.edit-product');
    }
}

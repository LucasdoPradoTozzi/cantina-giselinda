<?php

namespace App\Livewire;

use App\Http\Controllers\PhotoController;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Stock;
use App\Services\MoneyService;
use Livewire\Component;

use Illuminate\Support\Facades\DB;

use Livewire\WithFileUploads;

class CreateProduct extends Component
{

    use WithFileUploads;

    public $productTypes;

    public $photo;
    public $name;
    public $description;
    public $value;
    public $buyValue;
    public $productTypeId;
    public $minimumAmount = 1;
    public $maximumAmount = 2;

    protected $rules = [
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'value' => 'required|string|min:3',
        'buyValue' => 'required|string|min:3',
        'productTypeId' => 'required|exists:product_types,id',
        'minimumAmount' => 'required|integer|min:1',
        'maximumAmount' => 'required|integer|gt:minimumAmount',
    ];

    protected $messages = [
        'photo.image' => 'A imagem enviada não é válida.',
        'photo.mimes' => 'A imagem deve estar em um dos formatos: jpeg, png, jpg, gif ou svg.',
        'photo.max' => 'A imagem não pode ter mais de 1MB.',

        'name.required' => 'O nome é obrigatório.',
        'name.max' => 'O nome não pode ter mais que 255 caracteres.',

        'description.required' => 'A descrição é obrigatória.',

        'value.required' => 'O valor de venda é obrigatório.',
        'value.min' => 'O valor de venda deve ter no mínimo 3 caracteres, exemplo: 1.00, 0.01.',

        'buyValue.required' => 'O valor de compra é obrigatório.',
        'buyValue.min' => 'O valor de compra deve ter no mínimo 3 caracteres, exemplo: 1.00, 0.01.',

        'productTypeId.required' => 'O tipo de produto é obrigatório.',
        'productTypeId.exists' => 'O tipo de produto selecionado é inválido.',

        'minimumAmount.required' => 'A quantidade mínima é obrigatória.',
        'minimumAmount.min' => 'A quantidade mínima deve ser no mínimo 1.',

        'maximumAmount.required' => 'A quantidade máxima é obrigatória.',
        'maximumAmount.gt' => 'A quantidade máxima deve ser maior que a mínima.',
    ];

    public function mount()
    {

        $productTypesList = ProductType::get();

        $this->productTypes = $productTypesList;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {

        try {
            DB::beginTransaction();
            $data = $this->validate();


            $moneyService = new MoneyService();

            $buyValue = $moneyService->convertStringToInteger($data['buyValue']);
            $value = $moneyService->convertStringToInteger($data['value']);
            $photo = !empty($data['photo']) ? $data['photo'] : null;

            $photoPath =  !empty($photo) ? PhotoController::store($photo) : null;

            $product = Product::create([
                'name'            => $data['name'],
                'description'     => $data['description'],
                'buy_value'       => $buyValue,
                'value'           => $value,
                'product_type_id' => $data['productTypeId'],
                'minimum_amount'  => $data['minimumAmount'],
                'maximum_amount'  => $data['maximumAmount'],
                'photo_path'      => $photoPath
            ]);

            Stock::create(
                [
                    'product_id' => $product->id,
                    'quantity' => 0
                ]
            );

            DB::commit();
            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->addError('form', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.create-product');
    }
}

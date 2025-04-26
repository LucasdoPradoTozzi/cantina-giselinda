<?php

namespace App\Livewire;

use Livewire\Component;

use App\Services\MoneyService;

use App\Models\Product;

class CreateSell extends Component
{

    public $items = [];
    public $products;
    public $total = 0;
    public $totalToShow = '0.00';

    public $selectedProductId = null;
    public $selectedQuantity = 1;


    public function mount()
    {

        $productList = Product::with('stock')->get();

        $this->products = $productList;
    }

    public function increaseQuantity($index)
    {
        $this->items[$index]['amount']++;

        $this->calculateItemSubtotal($index);

        $this->calculateTotal();
    }

    public function decreaseQuantity($index)
    {
        if ($this->items[$index]['amount'] > 1) {
            $this->items[$index]['amount']--;
            $this->calculateItemSubtotal($index);
            $this->calculateTotal();
        } else {
            $this->removeItem($index);
        }
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        $moneyService = new MoneyService();
        foreach ($this->items as $item) {
            $this->total = $moneyService->getAdditionIntegerValue($this->total, $item['total_value']);
        }

        $this->totalToShow = $moneyService->convertIntegerToString($this->total);
    }

    public function calculateItemSubtotal($index): void
    {
        $moneyService = new MoneyService();

        $item = $this->items[$index];
        $product = $this->products->firstWhere('id', $item['product_id']);

        $this->items[$index]['total_value'] = $moneyService->getMultiplicationIntegerValue($product->value, $item['amount']);
        $this->items[$index]['total_value_to_show'] = $moneyService->getMultiplicationStringValue($product->value, $item['amount']);
    }

    public function addItem()
    {
        $productId = $this->selectedProductId;
        $quantity = $this->selectedQuantity;

        if (!$productId || $quantity < 1) {
            return;
        }

        $productBeingAdded = $this->products->firstWhere('id', $productId);
        if (!$productBeingAdded) return;

        $itemisAlreadyOnTheList = false;
        foreach ($this->items as $index => &$item) {
            if ($item['product_id'] == $productId) {
                $item['amount'] += $quantity;

                $itemIndex = $index;
                $itemisAlreadyOnTheList = true;
            }
        }

        if (!$itemisAlreadyOnTheList) {

            $itemData = [
                'product_id' => $productId,
                'amount' => $quantity,
            ];

            $itemIndex = array_push($this->items, $itemData) - 1;
        }

        $this->calculateItemSubtotal($itemIndex);
        $this->calculateTotal();

        $this->selectedProductId = null;
        $this->selectedQuantity = 1;
    }

    public function render()
    {
        logger()->info('Items:', $this->items);
        return view('livewire.create-sell');
    }
}

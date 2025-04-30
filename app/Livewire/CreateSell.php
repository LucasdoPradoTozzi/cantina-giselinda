<?php

namespace App\Livewire;

use Livewire\Component;

use App\Services\MoneyService;

use App\Models\Product;
use App\Models\Sell;
use App\Models\SoldItem;
use App\Models\Stock;
use Exception;
use Illuminate\Support\Facades\DB;

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

    public function submitSell()
    {
        if (empty($this->items)) {
            $this->addError('purchase', 'Seu carrinho está vazio.');
            return;
        }

        $this->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],
            'items.*.amount' => [
                'required',
                'integer',
                'min:1',
            ],
        ], [
            'items.*.product_id.required' => 'Produto inválido no carrinho.',
            'items.*.product_id.exists' => 'Produto selecionado não existe.',
            'items.*.amount.required' => 'Quantidade obrigatória para todos os produtos.',
            'items.*.amount.min' => 'Quantidade deve ser no mínimo 1.',
        ]);


        try {


            DB::beginTransaction();

            $sell = Sell::create([
                'title' => now()->format('d/m/Y H:i')
            ]);

            $SellId = $sell->id;

            $moneyService = new MoneyService();

            foreach ($this->items as $product) {
                $productById = Product::where('id', $product['product_id'])->first();
                if (!$productById) throw new Exception('Produto não encontrado, verifique se o mesmo ainda existe.');

                $wasAOffer = 0;

                $soldPrice = $moneyService->getMultiplicationIntegerValue($productById->value, $product['amount']);

                SoldItem::create([
                    'product_id' => $product['product_id'],
                    'sell_id' => $SellId,
                    'amount' => $product['amount'],
                    'price_by_item' => $productById->value,
                    'sold_price' => $soldPrice,
                    'was_a_offer' => $wasAOffer
                ]);

                $stock = Stock::where('product_id', $productById->id)->first();

                if (!$stock) throw new Exception('Erro ao buscar estoque do produto: ' . $productById->name);

                if (((int) $stock->quantity - (int) $product['amount']) < 0)
                    throw new Exception($productById->name .
                        ' não tem estoque suficiente para essa venda. Quantidade solicitada: ' .
                        $product['amount'] .
                        ' quantidade disponível: ' .
                        $stock->quantity);

                $stock->quantity -= $product['amount'];
                $stock->save();
            }

            DB::commit();
            return redirect('/sells');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('purchase', $e->getMessage());
            return;
        }
    }

    public function render()
    {
        logger()->info('Items:', $this->items);
        return view('livewire.create-sell');
    }
}

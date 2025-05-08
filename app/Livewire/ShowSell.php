<?php

namespace App\Livewire;

use App\Models\SalesPayment;
use App\Models\Sell;
use App\Services\MoneyService;

use Livewire\Component;

class ShowSell extends Component
{
    public Sell $sell;


    public $paymentMethod;
    public $newPaymentValue;

    public function mount($id)
    {

        $sell = Sell::with(['soldItem.product', 'salesPayment', 'customer'])
            ->where('id', $id)
            ->firstOrFail();

        $this->sell = $sell;
    }

    public function addNewPayment()
    {

        if (empty($this->newPaymentValue) || ($this->newPaymentValue <= 0 || strlen($this->newPaymentValue) < 3)) {
            $this->addError('newPaymentValue', 'O valor mínimo é de R$ 0,01. Caso contrário, não preencha nada.');
            return;
        }

        $this->newPaymentValue = preg_replace('/\D/', '', $this->newPaymentValue);

        $payment = SalesPayment::create([
            'sell_id' => $this->sell->id,
            'value' => $this->newPaymentValue,
            'payment_method' => $this->paymentMethod,
        ]);

        $this->sell->paid_value += $this->newPaymentValue;
        $this->sell->save();

        $this->sell = $this->sell->fresh(['salesPayment']);

        $this->newPaymentValue = null;
        $this->paymentMethod = null;
    }

    public function render()
    {
        return view('livewire.show-sell');
    }
}

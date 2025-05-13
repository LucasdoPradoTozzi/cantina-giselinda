<?php

namespace App\Livewire;

use App\Http\Controllers\PhotoController;
use App\Models\Customer;
use App\Models\SoldItem;
use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CustomerShow extends Component
{

    use WithPagination;
    use WithFileUploads;

    public Customer $customer;

    public $photoUpdate;
    public $nameUpdate;
    public $emailUpdate;
    public $doc1Update;
    public $doc2Update;
    public $phoneUpdate;
    public $birthdayUpdate;




    public function mount($id)
    {

        $customer = Customer::findOrFail($id);
        $this->customer = $customer;
        $this->nameUpdate = $this->customer->name;
        $this->emailUpdate = $this->customer->email;
        $this->doc1Update = $this->customer->doc1;
        $this->doc2Update = $this->customer->doc2;
        $this->phoneUpdate = $this->customer->phone;
        $this->birthdayUpdate = $this->customer->birthday;
    }

    public function rules()
    {
        return [
            'photoUpdate' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'nameUpdate' => 'required|string|max:255',
            'emailUpdate' => 'nullable|email',
            'doc1Update' => 'nullable|string|max:255|unique:customers,doc1,' . $this->customer->id,
            'doc2Update' => 'nullable|string|max:255|unique:customers,doc2,' . $this->customer->id,
            'phoneUpdate' => 'nullable|string|max:255',
            'birthdayUpdate' => 'nullable|date_format:Y-m-d',
        ];
    }

    public function update()
    {
        $data = $this->validate();

        $updateData = [
            'name' => $this->nameUpdate,
            'doc1' => $this->doc1Update,
            'doc2' => $this->doc2Update,
            'birthday' => $this->birthdayUpdate,
            'phone' => $this->phoneUpdate,
            'email' => $this->emailUpdate,
        ];

        if (!empty($data['photoUpdate'])) {

            $photoPath = PhotoController::store($data['photoUpdate']);
            $updateData['photo_path'] = $photoPath;
        }

        $this->customer->update($updateData);
    }

    public function render()
    {
        $sells = $this->customer->sell()->paginate(2);

        $customerId = $this->customer->id;
        $favoriteProducts = SoldItem::select('product_id', DB::raw('SUM(amount) as total'))
            ->whereHas('sell', function ($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('livewire.customer-show', [
            'sells' => $sells,
            'favoriteProducts' => $favoriteProducts
        ]);
    }
}

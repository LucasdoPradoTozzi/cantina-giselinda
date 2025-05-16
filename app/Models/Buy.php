<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buy extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function purchaseItem(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function getPurchaseItemSumTotalPriceForShowAttribute(): string
    {
        return isset($this->purchase_item_sum_total_price)
            ? 'R$ ' . app(\App\Services\MoneyService::class)->convertIntegerToString($this->purchase_item_sum_total_price)
            : '';
    }
}

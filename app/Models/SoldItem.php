<?php

namespace App\Models;

use App\Services\MoneyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoldItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sell(): BelongsTo
    {
        return $this->belongsTo(Sell::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getPriceByItemForShowAttribute(): string
    {
        return "R$ " . app(MoneyService::class)->convertIntegerToString($this->price_by_item);
    }

    public function getSoldPriceForShowAttribute(): string
    {
        return "R$ " . app(MoneyService::class)->convertIntegerToString($this->sold_price);
    }
}

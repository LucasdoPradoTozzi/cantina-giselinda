<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Services\MoneyService;


class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function purchaseItem(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function soldItem(): HasMany
    {
        return $this->hasMany(SoldItem::class);
    }

    public function getValueForShowAttribute(): string
    {
        return app(MoneyService::class)->convertIntegerToString($this->value);
    }

    public function getBuyValueForShowAttribute(): string
    {
        return app(MoneyService::class)->convertIntegerToString($this->buy_value);
    }
}

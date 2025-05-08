<?php

namespace App\Models;

use App\Services\MoneyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sell extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'customer_id',
        'sale_value',
        'paid_value'
    ];

    public function soldItem(): HasMany
    {
        return $this->hasMany(SoldItem::class);
    }

    public function salesPayment(): HasMany
    {
        return $this->hasMany(SalesPayment::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getSaleValueForShowAttribute(): string
    {
        return app(MoneyService::class)->convertIntegerToString($this->sale_value);
    }

    public function getPaidValueForShowAttribute(): string
    {
        return app(MoneyService::class)->convertIntegerToString($this->paid_value);
    }

    public function isFullyPaid(): bool
    {
        return $this->paid_value >= $this->sale_value;
    }

    public function getDebtValueAttribute(): string
    {
        $value = $this->sale_value - $this->paid_value;
        if ($value < 0) $value = 0;
        return app(MoneyService::class)->convertIntegerToString($value);
    }
}

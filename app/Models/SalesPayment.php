<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Services\MoneyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SalesPayment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function sell(): BelongsTo
    {
        return $this->belongsTo(Sell::class);
    }


    protected $casts = [
        'payment_method' => PaymentMethod::class,
    ];


    public function getValueForShowAttribute(): string
    {
        return "R$ " . app(MoneyService::class)->convertIntegerToString($this->value);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sell extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function soldItem(): HasMany
    {
        return $this->hasMany(SoldItem::class);
    }

    public function customerPayment(): HasMany
    {
        return $this->hasMany(CustomerPayment::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}

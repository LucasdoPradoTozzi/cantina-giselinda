<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}

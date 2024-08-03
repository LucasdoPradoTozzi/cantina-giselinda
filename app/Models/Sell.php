<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sell extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function soldItem(): HasMany
    {
        return $this->hasMany(soldItem::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Waste extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function wasteItem(): HasMany
    {
        return $this->hasMany(WasteItem::class);
    }
}

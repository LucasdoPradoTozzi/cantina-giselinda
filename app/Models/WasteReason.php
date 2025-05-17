<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteReason extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
}

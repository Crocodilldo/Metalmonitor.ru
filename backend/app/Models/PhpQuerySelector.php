<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhpQuerySelector extends Model
{
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}

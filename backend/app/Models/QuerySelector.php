<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuerySelector extends Model
{
        protected $fillable = [
        'shop_id',
        'product_information',
        'price',
        'url',
        'updated_at'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateLink extends Model
{
    protected $fillable = [
        'shop_id',
        'category_id',
        'url'

    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}

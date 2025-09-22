<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function updateLink()
    {
        return $this->hasMany(UpdateLink::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}

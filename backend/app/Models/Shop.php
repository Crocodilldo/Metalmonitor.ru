<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'logo'

    ];

    public function updateLink()
    {
        return $this->hasMany(UpdateLink::class);
    }

    public function phpQuerySelector()
    {
        return $this->hasMany(PhpQuerySelector::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}

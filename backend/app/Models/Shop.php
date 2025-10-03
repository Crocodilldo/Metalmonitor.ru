<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Actions\CreateSlugAction;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'url'
    ];

    public function updateLink()
    {
        return $this->hasMany(UpdateLink::class);
    }

    public function querySelector()
    {
        return $this->hasMany(QuerySelector::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    protected static function booted()
    {
        static::deleting(function ($shop) {
            $shop->updateLink()->delete();
            $shop->querySelector()->delete();
            $shop->product()->delete();
        });
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        // Генерация slug
        $createSlug = app(CreateSlugAction::class);
        $this->attributes['slug'] = $createSlug->handle($value);
    }
}

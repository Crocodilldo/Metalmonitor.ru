<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'shop_id' => $this->shop_id,
            'shop_name' => $this->shop->name,
            'parameter' => $this->parameter,
            'price' => $this->price,
            'url' => $this->url,
            'updated_at' => $this->updated_at
        ];
    }
}

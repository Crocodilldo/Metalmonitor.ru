<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuerySelectorResource extends JsonResource
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
            'shop_id' => $this->shop_id,
            'shop_name' => $this->shop->name,
            'product_information' => $this->product_information,
            'price' => $this->price,
            'url' => $this->url,
            'updated_at' => $this->updated_at
        ];
    }
}

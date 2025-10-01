<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateLinkResource extends JsonResource
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
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'url' => $this->url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'category_name' => $this->category_name,
            'parent_id' => $this->parent_id,
            // 'isOpen' => false,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            // 'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}

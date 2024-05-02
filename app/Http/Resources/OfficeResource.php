<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
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
            'office_name' => $this->office_name,
            'location' => $this->location,
            'classification' => $this->classification,
            'created_at' => Carbon::parse($this->created_at)->format('F j, Y'),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'property_no' => $this->property_no,
            'category' => [
                'id' => $this->category->id,
                'category_name' => $this->category->category_name,
                'path' => $this->category->getPath()
            ],
            'item_name' => $this->item_name,
            'description' => $this->description,
            'serial_no' => $this->serial_no,
            'measurement_unit' => $this->measurement_unit,
            'unit_value' => $this->unit_value,
            'acquisition' => [
                'id' => $this->acquisition->id,
                'name' => $this->acquisition->name,
            ],
            'received_from' => $this->received_from,
            'received_by' => [
                'id' => $this->receivedBy->id,
                'name' => $this->receivedBy->fname . ' ' . $this->receivedBy->lname,
            ],
            'office' => [
                'id' => $this->office->id,
                'office_name' => $this->office->office_name,
                'location' => $this->office->location,
            ],
            'assigned_to' => [
                'id' => $this->assignedTo->id,
                'name' => $this->assignedTo->fname . ' ' . $this->assignedTo->lname,
            ],
            'date_acquired' => $this->date_acquired,
            'status' => $this->status,
            'photo' => $this->getPhotoUrlAttribute(),
            'document' => $this->document,
        ];
    }
}

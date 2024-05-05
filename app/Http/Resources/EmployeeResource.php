<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'user_id' => $this->user_id,
            'id_no' => $this->id_no,
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'address' => $this->address,
            'emp_type' => $this->emp_type,
            'profile_photo' => $this->profile_photo,
            'profile_photo_url' => $this->profile_photo ? asset('storage/uploads/profile_photos/' . $this->profile_photo) : asset('/images/default-user-icon.jpg'),
            'status' => $this->status,
            'role' => $this->user->roles[0]->name,
        ];
    }
}

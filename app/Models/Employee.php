<?php

namespace App\Models;

use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_no',
        'fname',
        'mname',
        'lname',
        'emp_type',
        'address',
        'status',
        'profile_photo',
    ];

    protected $appends = [ 'profile_photo_url' ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo ? asset('storage/uploads/profile_photos/' . $this->profile_photo) : null;
    }

    public function receivedProperties()
    {
        return $this->hasMany(Property::class, 'received_from');
    }

    public function assignedProperties()
    {
        return $this->hasMany(Property::class, 'assigned_to');
    }
}

<?php

namespace App\Models;

use App\Models\Property;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->orderBy('category_name', 'asc')
            ->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('parent');
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function getPath($path = '')
    {
        $path = $this->category_name . ($path ? ' / ' . $path : '');

        if ($this->parent) {
            return $this->parent->getPath($path);
        }

        return $path;
    }
}

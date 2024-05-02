<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Property;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i < 20; $i++) {
            // pick a random number between 1 to 10 (total number of categories)
            $categoryId = mt_rand(1, 10);

            $category = Category::doesntHave('children')->get()->random();

            Property::create([
                'property_no' => strtoupper(Str::random(3)). '-' . fake()->year(). '-' . fake()->randomNumber(5, true),
                'category_id' => $category->id,
                'item_name' => fake()->word(2, true),
                'description' => fake()->sentence(),
                'serial_no' => fake()->ean8(),
                'measurement_unit' => fake()->randomElement(['kilograms', 'pieces', 'boxes', 'meters']),
                'unit_value' => fake()->numberBetween(500, 1000),
                'acquisition_id' => fake()->randomElement(range(1, 10)),
                'received_from' => fake()->randomElement(range(1, 5)),
                'office_id' => fake()->randomElement(range(1, 30)),
                'assigned_to' => fake()->randomElement(range(1, 5)),
                'date_acquired' => fake()->date(),
                'status' => fake()->randomElement(['Serviceable', 'Unserviceable']),
            ]);
        }
    }
}

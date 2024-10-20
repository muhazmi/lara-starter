<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define product type array
        $categories = [
            __('Sport'), __('Entertainment'), __('Tips & Tricks')
        ];

        foreach ($categories as $category) {
            Category::create([
                'name'              => $category,
                'slug'              => Str::slug($category),
                'category_type_id'  => 3,
            ]);
        }
    }
}

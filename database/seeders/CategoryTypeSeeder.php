<?php

namespace Database\Seeders;

use App\Models\CategoryType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryType::create([
            'name'  => __('Product'),
            'slug'  => Str::slug(__('Product')),
        ]);
        CategoryType::create([
            'name'  => __('Expenditure'),
            'slug'  => Str::slug(__('Expenditure')),
        ]);
        CategoryType::create([
            'name'  => __('Article'),
            'slug'  => Str::slug(__('Article')),
        ]);
    }
}

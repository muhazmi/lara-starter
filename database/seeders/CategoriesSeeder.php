<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // id = 1
        Category::create([
            'name' => 'Programming',
            'slug' => 'programming',
        ]);

        // id = 2
        Category::create([
            'name' => 'UI / UX',
            'slug' => 'ui-ux',
        ]);

        // id = 3
        Category::create([
            'name' => 'DevOps',
            'slug' => 'devops',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => __('Tips & Trick')],
            ['name' => __('Guide')],
            ['name' => __('Review')],
            ['name' => __('News')],
        ];

        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag['name'],
                'slug' => Str::slug($tag['name']),
            ]);
        }
    }
}

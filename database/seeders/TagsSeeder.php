<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'name' => 'PHP',
            'slug' => 'php',
        ]);
        Tag::create([
            'name' => 'Java',
            'slug' => 'java',
        ]);
        Tag::create([
            'name' => 'Python',
            'slug' => 'python',
        ]);
        Tag::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
        ]);
        Tag::create([
            'name' => 'User Interface',
            'slug' => 'user-interface',
        ]);
        Tag::create([
            'name' => 'Docker',
            'slug' => 'docker',
        ]);
        Tag::create([
            'name' => 'Deployment',
            'slug' => 'deployment',
        ]);
    }
}

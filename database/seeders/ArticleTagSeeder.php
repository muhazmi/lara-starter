<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Tag;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = Article::all();
        $tags = Tag::all();

        foreach ($articles as $article) {
            // Ambil sejumlah tag secara acak
            $randomTags = $tags->random(rand(1, 3))->pluck('id');
            
            // Hubungkan tags dengan article
            $article->tags()->attach($randomTags);
        }
    }
}

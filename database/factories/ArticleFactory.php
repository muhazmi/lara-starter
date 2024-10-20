<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Alirezasedghi\LaravelImageFaker\Services\Picsum;
use App\Enums\PublishStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageFaker = new ImageFaker(new Picsum());
        $image      = $imageFaker->image(storage_path('app/assets/images/article'), 750, 750, false);

        $title  = $this->faker->sentence;
        $slug   = Str::slug($title);

        return [
            'title'             => $title,
            'slug'              => $slug,
            'meta_description'  => $this->faker->paragraph(1),
            'description'       => $this->faker->paragraph(rand(25, 100)),
            'photo'             => $image,
            'photo_thumbnail'   => $image,
            'is_published'      => PublishStatus::PUBLISHED,
            'created_by'        => User::all()->random()->id,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }
}

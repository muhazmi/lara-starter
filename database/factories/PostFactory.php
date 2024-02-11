<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Alirezasedghi\LaravelImageFaker\Services\Picsum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageFaker = new ImageFaker(new Picsum());

        $title  = $this->faker->sentence;
        $slug   = Str::slug($title);

        return [
            'title'             => $title,
            'slug'              => $slug,
            'meta_description'  => $this->faker->paragraph(1),
            'description'       => $this->faker->paragraph(rand(25,100)),
            'featured_image'    => $imageFaker->image(public_path('storage/images/posts'), 750, 750, false),
            'is_publish'        => 1,
            'category_id'       => rand(1,3),
            'author_id'         => 2,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }
}

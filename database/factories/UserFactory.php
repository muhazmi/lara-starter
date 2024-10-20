<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'identity_card_number'  => $this->faker->unique()->numerify('############'),
            'name'                  => $this->faker->name,
            'birthplace'            => $this->faker->city,
            'email'                 => $this->faker->unique()->safeEmail,
            'gender'                => $this->faker->randomElement([0, 1]),
            'mobile_phone'          => $this->faker->phoneNumber,
            'address'               => $this->faker->address,
            'photo'                 => $this->faker->imageUrl,
            'is_active'             => $this->faker->boolean,
            'hire_date'             => $this->faker->dateTimeBetween('first day of January', 'now'),
            'password'              => bcrypt('password'),
            'email_verified_at'     => now(),
            'remember_token'        => Str::random(10),
        ];
    }

    public function role($roleName)
    {
        return $this->afterCreating(function (User $user) use ($roleName) {
            $user->assignRole($roleName);
        });
    }
}

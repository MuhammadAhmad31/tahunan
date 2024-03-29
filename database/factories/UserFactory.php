<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => date('YmdHis') . mt_rand(100, 999),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('admin'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'nisn' => fake()->unique()->numerify('##############'),
            'parent_name' => fake()->name(),
            'id_school' => null,
            'date_of_birth' => fake()->date(),
            'profile_photo_path' => null,
            'id_card_parent' => null,
            'id_family_card' => null,
            'kip' => null,
            'is_boarding' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

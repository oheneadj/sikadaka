<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contributor>
 */
class ContributorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'membership_id' => $this->faker->unique()->numberBetween(1000, 9999),
            'phone_number' => $this->faker->unique()->phoneNumber,
            'date_of_birth' => $this->faker->date,
            'gender' => $this->faker->randomElement(['MALE', 'FEMALE']),
            'clan' => $this->faker->randomElement(['OYOKO', 'AGONA', 'BRETUO', 'ASOMAKOMA', 'ASONA', 'ABRADE', 'EKUONA', 'ADUANA']),
            'contact_person_name' => $this->faker->name,
            'contact_person_number' => $this->faker->phoneNumber,
            'hometown' => $this->faker->city,
            'is_member' => $this->faker->boolean,
            'suburb' => $this->faker->citySuffix,
            'denomination' => $this->faker->word,
            'picture_path' => null,
            'user_id' => User::inRandomOrder()->first()->id,
            'outstanding_debt' => $this->faker->randomFloat(2, 0, 1000),
            'created_at' => $this->faker->dateTimeBetween('2022-01-01', '2024-12-31'),
            'updated_at' => now(),
        ];
    }
}

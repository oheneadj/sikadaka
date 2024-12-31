<?php

namespace Database\Factories;

use App\Models\Contributor;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'payment_type' => $this->faker->randomElement(['CONTRIBUTION', 'DONATION', 'DEBT']),
            'purpose' => $this->faker->sentence,
            'month' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'year' => $this->faker->year,
            'contributor_id' => Contributor::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'project_id' => $this->faker->randomElement([1, 2, 3]),
            'created_at' => $this->faker->dateTimeBetween('2022-01-01', '2024-12-31'),
            'updated_at' => null,
        ];
    }
}

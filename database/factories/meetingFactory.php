<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\meeting>
 */
class meetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'guest_name' => fake()->name(),
            'guest_email' => fake()->unique()->safeEmail(),
            'comments' => fake()->sentence(),
            'starts_at' => now(),
            'ends_at' => now()->addHour()
        ];
    }
}

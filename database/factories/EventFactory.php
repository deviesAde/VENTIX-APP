<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'location'    => $this->faker->address,
            'start_time'  => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'end_time'    => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'banner_path' => null, // Kosongkan atau tambahkan path banner
            'status'      => $this->faker->randomElement(['draft', 'published', 'cancelled']),
        ];
    }
}

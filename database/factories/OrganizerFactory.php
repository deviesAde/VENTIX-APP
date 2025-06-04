<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organizer>
 */
class OrganizerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

            return [
                'organization_name' => $this->faker->company,
                'description'       => $this->faker->paragraph,
                'phone'             => $this->faker->phoneNumber,
                'website'           => $this->faker->url,
                'logo_path'         => null, // Kosongkan atau tambahkan path logo
                'status'            => $this->faker->randomElement(['pending', 'approved', 'rejected']),
                'email'             => $this->faker->unique()->safeEmail,
                'user_id'           => null, // Kosongkan untuk status pending
            ];
    
    }
}

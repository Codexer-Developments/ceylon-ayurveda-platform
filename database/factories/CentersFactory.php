<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Centers>
 */
class CentersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'center_name' => $this->faker->name,
            'description' => $this->faker->text,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'status' => $this->faker->boolean,
            'owner_id' => \App\Models\User::factory()->create()->id,
            'slug' => $this->faker->slug,
        ];
    }
}

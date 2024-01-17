<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['individual', 'business']);
        $name = $type == 'individual' ? $this->faker->name() : $this->faker->company();
        return [
            'name' => $name,
            'type' => $type,
            'state' => $this->faker->state(),
            'email' => $this->faker->email(),
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
            'postal_code' => $this->faker->postcode(),

        ];
    }
}

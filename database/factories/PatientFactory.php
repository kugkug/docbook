<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(['Mr.','Ms.','Mrs.']),
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['male', 'female', 'queer','lesbian','gay']),
            'contact_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'street' => $this->faker->streetName(),
            'unit_number' => $this->faker->buildingNumber(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'state_abbr' => $this->faker->stateAbbr(),
            'country' => $this->faker->country(),
            'zip_code' => $this->faker->postcode(), 
            'latitude' => $this->faker->latitude(),  
            'longitude' => $this->faker->longitude(),
        ];
    }
}

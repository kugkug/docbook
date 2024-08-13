<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(['MD','MO']),
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'practice_name' => $this->faker->sentence(),
            'provider_specialty' => $this->faker->sentence(),
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
            'visit_type' => $this->faker->randomElement(['In Person','Online']),
            'insurance_carrier' => $this->faker->creditCardType(),  
            'insurance_plan' => $this->faker->swiftBicNumber(), 
            
        ];
    }
}
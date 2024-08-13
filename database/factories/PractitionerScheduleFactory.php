<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PractitionerSchedule>
 */
class PractitionerScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date("Y-m-d"),
            'day' => $this->faker->dayOfWeek(),
            'start_time' => $this->faker->time("H:i:s"),
            'end_time' => $this->faker->time("H:i:s"),
            'location' => $this->faker->latitude(),
            'creator_id' => $this->faker->randomElement([1,2]),
        ];
    }
}

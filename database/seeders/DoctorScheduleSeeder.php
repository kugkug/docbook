<?php

namespace Database\Seeders;

use App\Models\DoctorSchedule;
use App\Models\PractitionerSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PractitionerSchedule::factory(100)->create();
    }
}

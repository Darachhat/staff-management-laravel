<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkDay;

class WorkDaySeeder extends Seeder
{
    public function run()
    {
        $workDays = [
            ['day_of_week' => 'monday', 'is_working_day' => true, 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'break_start' => '12:00:00', 'break_end' => '13:00:00'],
            ['day_of_week' => 'tuesday', 'is_working_day' => true, 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'break_start' => '12:00:00', 'break_end' => '13:00:00'],
            ['day_of_week' => 'wednesday', 'is_working_day' => true, 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'break_start' => '12:00:00', 'break_end' => '13:00:00'],
            ['day_of_week' => 'thursday', 'is_working_day' => true, 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'break_start' => '12:00:00', 'break_end' => '13:00:00'],
            ['day_of_week' => 'friday', 'is_working_day' => true, 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'break_start' => '12:00:00', 'break_end' => '13:00:00'],
            ['day_of_week' => 'saturday', 'is_working_day' => false, 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'break_start' => null, 'break_end' => null],
            ['day_of_week' => 'sunday', 'is_working_day' => false, 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'break_start' => null, 'break_end' => null],
        ];

        foreach ($workDays as $workDay) {
            WorkDay::create($workDay);
        }
    }
}

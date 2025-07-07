<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkDayTime;

class WorkDayTimeSeeder extends Seeder
{
    public function run()
    {
        $workDayTimes = [
            [
                'name' => 'Standard Business Hours',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'break_start' => '12:00:00',
                'break_end' => '13:00:00',
                'total_hours' => 8,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]), // Monday to Friday
                'is_active' => true
            ],
            [
                'name' => 'Early Shift',
                'start_time' => '07:00:00',
                'end_time' => '15:00:00',
                'break_start' => '11:00:00',
                'break_end' => '12:00:00',
                'total_hours' => 8,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'is_active' => true
            ],
            [
                'name' => 'Late Shift',
                'start_time' => '13:00:00',
                'end_time' => '21:00:00',
                'break_start' => '17:00:00',
                'break_end' => '18:00:00',
                'total_hours' => 8,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'is_active' => true
            ],
            [
                'name' => 'Night Shift',
                'start_time' => '22:00:00',
                'end_time' => '06:00:00',
                'break_start' => '02:00:00',
                'break_end' => '03:00:00',
                'total_hours' => 8,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'is_active' => true
            ],
            [
                'name' => 'Part-Time Morning',
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'break_start' => null,
                'break_end' => null,
                'total_hours' => 4,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'is_active' => true
            ],
            [
                'name' => 'Part-Time Afternoon',
                'start_time' => '14:00:00',
                'end_time' => '18:00:00',
                'break_start' => null,
                'break_end' => null,
                'total_hours' => 4,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'is_active' => true
            ],
            [
                'name' => 'Weekend Shift',
                'start_time' => '10:00:00',
                'end_time' => '18:00:00',
                'break_start' => '14:00:00',
                'break_end' => '15:00:00',
                'total_hours' => 8,
                'days_of_week' => json_encode([6, 7]), // Saturday and Sunday
                'is_active' => true
            ],
            [
                'name' => 'Flexible Hours',
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'break_start' => '12:00:00',
                'break_end' => '13:00:00',
                'total_hours' => 8,
                'days_of_week' => json_encode([1, 2, 3, 4, 5]),
                'is_active' => true
            ],
        ];

        foreach ($workDayTimes as $workDayTime) {
            WorkDayTime::create($workDayTime);
        }
    }
}

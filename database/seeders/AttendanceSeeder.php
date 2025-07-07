<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\AttendanceZone;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::where('status', 'active')->get();
        $zones = AttendanceZone::where('is_active', true)->get();

        // Generate attendance for the last 30 days
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            // Skip weekends for most employees
            if ($date->isWeekend()) {
                continue;
            }

            foreach ($employees as $employee) {
                // 85% chance of attendance on any given day
                if (rand(1, 100) <= 85) {
                    $checkInTime = Carbon::parse($employee->workDayTime->start_time)
                        ->addMinutes(rand(-10, 30)); // Can be 10 min early to 30 min late

                    $checkOutTime = Carbon::parse($employee->workDayTime->end_time)
                        ->addMinutes(rand(-30, 60)); // Can leave 30 min early to 60 min late

                    // Calculate break duration (45-75 minutes)
                    $breakDuration = rand(45, 75);

                    // Calculate total hours
                    $totalMinutes = $checkOutTime->diffInMinutes($checkInTime) - $breakDuration;
                    $totalHours = $totalMinutes / 60;

                    // Calculate overtime
                    $standardHours = $employee->workCondition->working_hours_per_day;
                    $overtimeHours = max(0, $totalHours - $standardHours);

                    // Determine status
                    $status = 'present';
                    $expectedCheckIn = Carbon::parse($employee->workDayTime->start_time);
                    $expectedCheckOut = Carbon::parse($employee->workDayTime->end_time);

                    if ($checkInTime->gt($expectedCheckIn->addMinutes(15))) {
                        $status = 'late';
                    } elseif ($checkOutTime->lt($expectedCheckOut->subMinutes(15))) {
                        $status = 'early_departure';
                    } elseif ($overtimeHours > 0) {
                        $status = 'overtime';
                    }

                    Attendance::create([
                        'employee_id' => $employee->id,
                        'attendance_zone_id' => $zones->random()->id,
                        'date' => $date->format('Y-m-d'),
                        'check_in_time' => $checkInTime->format('H:i:s'),
                        'check_out_time' => $checkOutTime->format('H:i:s'),
                        'expected_check_in' => $employee->workDayTime->start_time,
                        'expected_check_out' => $employee->workDayTime->end_time,
                        'break_duration' => $breakDuration,
                        'total_hours' => round($totalHours, 2),
                        'overtime_hours' => round($overtimeHours, 2),
                        'status' => $status,
                        'notes' => rand(1, 100) <= 10 ? 'Random note for attendance record' : null,
                        'check_in_latitude' => 11.5564 + (rand(-100, 100) / 10000),
                        'check_in_longitude' => 104.9282 + (rand(-100, 100) / 10000),
                        'check_out_latitude' => 11.5564 + (rand(-100, 100) / 10000),
                        'check_out_longitude' => 104.9282 + (rand(-100, 100) / 10000),
                    ]);
                }
            }
        }
    }
}

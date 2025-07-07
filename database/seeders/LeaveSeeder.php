<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\LeaveType;
use Carbon\Carbon;

class LeaveSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::where('status', 'active')->get();
        $leaveTypes = LeaveType::where('is_active', true)->get();

        $leaveStatuses = ['pending', 'approved', 'rejected'];
        $reasons = [
            'Family vacation',
            'Medical appointment',
            'Personal matters',
            'Emergency situation',
            'Wedding ceremony',
            'Religious observance',
            'Conference attendance',
            'Training course',
            'Home renovation',
            'Child school event',
            'Dental checkup',
            'Car maintenance',
            'Moving to new house',
            'Graduation ceremony',
            'Birthday celebration'
        ];

        // Generate leave requests for the current year
        foreach ($employees as $employee) {
            // Each employee has 2-5 leave requests
            $numberOfLeaves = rand(2, 5);

            for ($i = 0; $i < $numberOfLeaves; $i++) {
                $leaveType = $leaveTypes->random();

                // Generate random dates within the current year
                $startDate = Carbon::now()->subDays(rand(1, 365));
                $duration = rand(1, min(7, $leaveType->max_days_per_year)); // Max 7 days per request
                $endDate = $startDate->copy()->addDays($duration - 1);

                // Determine approval status (80% approved, 15% pending, 5% rejected)
                $statusRand = rand(1, 100);
                if ($statusRand <= 80) {
                    $status = 'approved';
                    $approvedBy = $employees->where('id', '!=', $employee->id)->random()->id;
                    $approvedAt = $startDate->copy()->subDays(rand(1, 14));
                    $rejectionReason = null;
                } elseif ($statusRand <= 95) {
                    $status = 'pending';
                    $approvedBy = null;
                    $approvedAt = null;
                    $rejectionReason = null;
                } else {
                    $status = 'rejected';
                    $approvedBy = $employees->where('id', '!=', $employee->id)->random()->id;
                    $approvedAt = null;
                    $rejectionReason = 'Insufficient notice period provided';
                }

                Leave::create([
                    'employee_id' => $employee->id,
                    'leave_type_id' => $leaveType->id,
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                    'total_days' => $duration,
                    'reason' => $reasons[array_rand($reasons)],
                    'status' => $status,
                    'approved_by' => $approvedBy,
                    'approved_at' => $approvedAt,
                    'rejection_reason' => $rejectionReason,
                    'notes' => rand(1, 100) <= 20 ? 'Additional notes for leave request' : null,
                ]);
            }
        }

        // Add some future leave requests
        foreach ($employees->random(5) as $employee) {
            $leaveType = $leaveTypes->random();
            $startDate = Carbon::now()->addDays(rand(7, 60));
            $duration = rand(1, 5);
            $endDate = $startDate->copy()->addDays($duration - 1);

            Leave::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveType->id,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'total_days' => $duration,
                'reason' => $reasons[array_rand($reasons)],
                'status' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'rejection_reason' => null,
                'notes' => 'Future leave request',
            ]);
        }
    }
}

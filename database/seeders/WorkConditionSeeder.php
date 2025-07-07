<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkCondition;

class WorkConditionSeeder extends Seeder
{
    public function run()
    {
        $workConditions = [
            [
                'name' => 'Standard Full-Time',
                'description' => 'Standard 40-hour work week',
                'hourly_rate' => 25.00,
                'monthly_salary' => 4000.00,
                'working_hours_per_day' => 8,
                'working_days_per_week' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Senior Level',
                'description' => 'Senior employee compensation',
                'hourly_rate' => 45.00,
                'monthly_salary' => 7200.00,
                'working_hours_per_day' => 8,
                'working_days_per_week' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Executive Level',
                'description' => 'Executive compensation package',
                'hourly_rate' => 80.00,
                'monthly_salary' => 12800.00,
                'working_hours_per_day' => 8,
                'working_days_per_week' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Part-Time',
                'description' => 'Part-time 20-hour work week',
                'hourly_rate' => 20.00,
                'monthly_salary' => 1600.00,
                'working_hours_per_day' => 4,
                'working_days_per_week' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Contract Hourly',
                'description' => 'Contract work paid hourly',
                'hourly_rate' => 35.00,
                'monthly_salary' => null,
                'working_hours_per_day' => 8,
                'working_days_per_week' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Intern',
                'description' => 'Internship compensation',
                'hourly_rate' => 15.00,
                'monthly_salary' => 1200.00,
                'working_hours_per_day' => 6,
                'working_days_per_week' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Consultant',
                'description' => 'Consultant daily rate',
                'hourly_rate' => 100.00,
                'monthly_salary' => null,
                'working_hours_per_day' => 8,
                'working_days_per_week' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Remote Worker',
                'description' => 'Remote work arrangement',
                'hourly_rate' => 30.00,
                'monthly_salary' => 4800.00,
                'working_hours_per_day' => 8,
                'working_days_per_week' => 5,
                'is_active' => true
            ],
        ];

        foreach ($workConditions as $condition) {
            WorkCondition::create($condition);
        }
    }
}

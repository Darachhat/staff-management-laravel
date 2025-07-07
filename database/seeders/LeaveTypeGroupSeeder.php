<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveTypeGroup;

class LeaveTypeGroupSeeder extends Seeder
{
    public function run()
    {
        $groups = [
            ['name' => 'Annual Leave', 'description' => 'Yearly vacation and personal time off', 'color' => '#10B981', 'is_active' => true],
            ['name' => 'Medical Leave', 'description' => 'Health-related absences and medical appointments', 'color' => '#EF4444', 'is_active' => true],
            ['name' => 'Emergency Leave', 'description' => 'Urgent personal and family emergencies', 'color' => '#F59E0B', 'is_active' => true],
            ['name' => 'Parental Leave', 'description' => 'Maternity, paternity, and family care leave', 'color' => '#8B5CF6', 'is_active' => true],
            ['name' => 'Educational Leave', 'description' => 'Training, conferences, and professional development', 'color' => '#3B82F6', 'is_active' => true],
            ['name' => 'Compensatory Leave', 'description' => 'Time off in lieu of overtime work', 'color' => '#06B6D4', 'is_active' => true],
            ['name' => 'Special Leave', 'description' => 'Religious observances and special occasions', 'color' => '#84CC16', 'is_active' => true],
        ];

        foreach ($groups as $group) {
            LeaveTypeGroup::create($group);
        }
    }
}

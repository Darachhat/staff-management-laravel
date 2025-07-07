<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders in the correct order due to foreign key constraints
        $this->call([
            // Basic configuration data first
            PositionSeeder::class,
            RoleSeeder::class,
            EmployeeCategorySeeder::class,
            WorkConditionSeeder::class,
            SkillSeeder::class,
            ServiceSeeder::class,
            WorkDayTimeSeeder::class,
            AttendanceZoneSeeder::class,

            // Leave related data
            LeaveTypeGroupSeeder::class,
            LeaveTypeSeeder::class,

            // System settings
            SettingSeeder::class,
            HolidaySeeder::class,
            WorkDaySeeder::class,

            // Employee data (depends on above)
            EmployeeSeeder::class,

            // Transactional data (depends on employees)
            AttendanceSeeder::class,
            LeaveSeeder::class,
            CardSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeCategory;

class EmployeeCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Full-Time', 'description' => 'Full-time permanent employees', 'color' => '#10B981', 'is_active' => true],
            ['name' => 'Part-Time', 'description' => 'Part-time employees', 'color' => '#F59E0B', 'is_active' => true],
            ['name' => 'Contract', 'description' => 'Contract-based employees', 'color' => '#3B82F6', 'is_active' => true],
            ['name' => 'Freelancer', 'description' => 'Freelance workers', 'color' => '#8B5CF6', 'is_active' => true],
            ['name' => 'Intern', 'description' => 'Interns and trainees', 'color' => '#06B6D4', 'is_active' => true],
            ['name' => 'Consultant', 'description' => 'External consultants', 'color' => '#84CC16', 'is_active' => true],
            ['name' => 'Temporary', 'description' => 'Temporary staff', 'color' => '#EF4444', 'is_active' => true],
            ['name' => 'Remote', 'description' => 'Remote workers', 'color' => '#6366F1', 'is_active' => true],
            ['name' => 'Hybrid', 'description' => 'Hybrid work arrangement', 'color' => '#EC4899', 'is_active' => true],
            ['name' => 'Executive', 'description' => 'Executive level employees', 'color' => '#14B8A6', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            EmployeeCategory::create($category);
        }
    }
}

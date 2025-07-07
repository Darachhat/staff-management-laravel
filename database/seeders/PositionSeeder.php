<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            ['name' => 'Chief Executive Officer', 'description' => 'Top executive responsible for overall company operations', 'is_active' => true],
            ['name' => 'Chief Technology Officer', 'description' => 'Head of technology and technical strategy', 'is_active' => true],
            ['name' => 'Human Resources Manager', 'description' => 'Manages human resources policies and employee relations', 'is_active' => true],
            ['name' => 'Senior Software Developer', 'description' => 'Experienced developer leading technical projects', 'is_active' => true],
            ['name' => 'Software Developer', 'description' => 'Develops software applications and systems', 'is_active' => true],
            ['name' => 'Junior Software Developer', 'description' => 'Entry-level developer learning and contributing to projects', 'is_active' => true],
            ['name' => 'DevOps Engineer', 'description' => 'Manages deployment, infrastructure, and CI/CD pipelines', 'is_active' => true],
            ['name' => 'QA Engineer', 'description' => 'Ensures software quality through testing and validation', 'is_active' => true],
            ['name' => 'UI/UX Designer', 'description' => 'Designs user interfaces and user experiences', 'is_active' => true],
            ['name' => 'Project Manager', 'description' => 'Manages projects, timelines, and team coordination', 'is_active' => true],
            ['name' => 'Product Manager', 'description' => 'Manages product development and strategy', 'is_active' => true],
            ['name' => 'Marketing Manager', 'description' => 'Develops and implements marketing strategies', 'is_active' => true],
            ['name' => 'Sales Manager', 'description' => 'Manages sales team and strategies', 'is_active' => true],
            ['name' => 'Business Analyst', 'description' => 'Analyzes business processes and requirements', 'is_active' => true],
            ['name' => 'Customer Support Specialist', 'description' => 'Provides customer support and assistance', 'is_active' => true],
            ['name' => 'Finance Manager', 'description' => 'Manages financial operations and reporting', 'is_active' => true],
            ['name' => 'Operations Manager', 'description' => 'Oversees daily operations and processes', 'is_active' => true],
            ['name' => 'Security Specialist', 'description' => 'Manages cybersecurity and data protection', 'is_active' => true],
            ['name' => 'Data Analyst', 'description' => 'Analyzes data to provide business insights', 'is_active' => true],
            ['name' => 'Administrative Assistant', 'description' => 'Provides administrative support to teams', 'is_active' => true],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}

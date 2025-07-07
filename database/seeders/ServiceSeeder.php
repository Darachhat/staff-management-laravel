<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            ['name' => 'Web Development', 'description' => 'Full-stack web development services', 'hourly_rate' => 75.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'Mobile App Development', 'description' => 'iOS and Android app development', 'hourly_rate' => 85.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'UI/UX Design', 'description' => 'User interface and experience design', 'hourly_rate' => 65.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'Database Design', 'description' => 'Database architecture and optimization', 'hourly_rate' => 70.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'DevOps Consulting', 'description' => 'Infrastructure and deployment consulting', 'hourly_rate' => 90.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'Project Management', 'description' => 'Project planning and execution management', 'hourly_rate' => 60.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'Quality Assurance', 'description' => 'Software testing and quality assurance', 'hourly_rate' => 50.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'Technical Writing', 'description' => 'Documentation and technical content creation', 'hourly_rate' => 45.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'System Integration', 'description' => 'Third-party system integration services', 'hourly_rate' => 80.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'Security Audit', 'description' => 'Security assessment and penetration testing', 'hourly_rate' => 100.00, 'fixed_price' => 2500.00, 'is_active' => true],
            ['name' => 'Data Analysis', 'description' => 'Business intelligence and data analysis', 'hourly_rate' => 70.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'Training & Workshops', 'description' => 'Technical training and workshops', 'hourly_rate' => 85.00, 'fixed_price' => 1500.00, 'is_active' => true],
            ['name' => 'Code Review', 'description' => 'Code quality review and optimization', 'hourly_rate' => 75.00, 'fixed_price' => 500.00, 'is_active' => true],
            ['name' => 'Maintenance & Support', 'description' => 'Ongoing maintenance and technical support', 'hourly_rate' => 55.00, 'fixed_price' => null, 'is_active' => true],
            ['name' => 'API Development', 'description' => 'RESTful API design and development', 'hourly_rate' => 80.00, 'fixed_price' => null, 'is_active' => true],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

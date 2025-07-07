<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Role;
use App\Models\EmployeeCategory;
use App\Models\WorkCondition;
use App\Models\WorkDayTime;
use App\Models\Skill;
use App\Models\Service;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        // Clear existing employees first
        Employee::truncate();

        // Get necessary related data
        $positions = Position::all();
        $roles = Role::all();
        $categories = EmployeeCategory::all();
        $workConditions = WorkCondition::all();
        $workDayTimes = WorkDayTime::all();
        $skills = Skill::all();
        $services = Service::all();

        // Check if we have the required data
        if ($positions->isEmpty() || $roles->isEmpty() || $categories->isEmpty() ||
            $workConditions->isEmpty() || $workDayTimes->isEmpty()) {
            $this->command->error('Required reference data is missing. Please run other seeders first.');
            return;
        }

        $employees = [
            [
                'employee_id' => 'EMP0001',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@techsolutions.com',
                'phone' => '+855-12-345-678',
                'date_of_birth' => '1990-05-15',
                'gender' => 'male',
                'address' => '123 Main Street, Phnom Penh, Cambodia',
                'emergency_contact_name' => 'Jane Doe',
                'emergency_contact_phone' => '+855-12-345-679',
                'hire_date' => '2023-01-15',
                'status' => 'active',
            ],
            [
                'employee_id' => 'EMP0002',
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@techsolutions.com',
                'phone' => '+855-12-456-789',
                'date_of_birth' => '1988-08-22',
                'gender' => 'female',
                'address' => '456 Oak Avenue, Phnom Penh, Cambodia',
                'emergency_contact_name' => 'Mike Johnson',
                'emergency_contact_phone' => '+855-12-456-790',
                'hire_date' => '2022-11-01',
                'status' => 'active',
            ],
            [
                'employee_id' => 'EMP0003',
                'first_name' => 'David',
                'last_name' => 'Wilson',
                'email' => 'david.wilson@techsolutions.com',
                'phone' => '+855-12-567-890',
                'date_of_birth' => '1985-12-03',
                'gender' => 'male',
                'address' => '789 Pine Road, Phnom Penh, Cambodia',
                'emergency_contact_name' => 'Lisa Wilson',
                'emergency_contact_phone' => '+855-12-567-891',
                'hire_date' => '2022-06-15',
                'status' => 'active',
            ],
            [
                'employee_id' => 'EMP0004',
                'first_name' => 'Emily',
                'last_name' => 'Brown',
                'email' => 'emily.brown@techsolutions.com',
                'phone' => '+855-12-678-901',
                'date_of_birth' => '1992-03-18',
                'gender' => 'female',
                'address' => '321 Elm Street, Phnom Penh, Cambodia',
                'emergency_contact_name' => 'Tom Brown',
                'emergency_contact_phone' => '+855-12-678-902',
                'hire_date' => '2023-03-10',
                'status' => 'active',
            ],
            [
                'employee_id' => 'EMP0005',
                'first_name' => 'Michael',
                'last_name' => 'Chen',
                'email' => 'michael.chen@techsolutions.com',
                'phone' => '+855-12-789-012',
                'date_of_birth' => '1987-09-25',
                'gender' => 'male',
                'address' => '654 Maple Drive, Phnom Penh, Cambodia',
                'emergency_contact_name' => 'Anna Chen',
                'emergency_contact_phone' => '+855-12-789-013',
                'hire_date' => '2022-09-05',
                'status' => 'active',
            ],
        ];

        foreach ($employees as $employeeData) {
            // Assign random related data
            $employeeData['position_id'] = $positions->random()->id;
            $employeeData['role_id'] = $roles->random()->id;
            $employeeData['employee_category_id'] = $categories->random()->id;
            $employeeData['work_condition_id'] = $workConditions->random()->id;
            $employeeData['work_day_time_id'] = $workDayTimes->random()->id;

            $employee = Employee::create($employeeData);

            // Assign random skills if available
            if ($skills->isNotEmpty()) {
                $randomSkills = $skills->random(min(3, $skills->count()));
                foreach ($randomSkills as $skill) {
                    $employee->skills()->attach($skill->id, [
                        'proficiency_level' => ['beginner', 'intermediate', 'advanced', 'expert'][rand(0, 3)],
                        'acquired_date' => Carbon::now()->subDays(rand(30, 365))->format('Y-m-d'),
                    ]);
                }
            }

            // Assign random services if available
            if ($services->isNotEmpty()) {
                $randomServices = $services->random(min(2, $services->count()));
                foreach ($randomServices as $service) {
                    $employee->services()->attach($service->id, [
                        'custom_rate' => $service->hourly_rate * (rand(80, 120) / 100),
                        'assigned_date' => Carbon::now()->subDays(rand(1, 180))->format('Y-m-d'),
                    ]);
                }
            }
        }
    }
}

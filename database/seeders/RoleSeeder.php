<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'description' => 'Full system access with all permissions',
                'permissions' => json_encode([
                    'employees_manage', 'attendance_manage', 'leaves_manage', 'reports_view',
                    'settings_manage', 'users_manage', 'roles_manage', 'departments_manage'
                ]),
                'is_active' => true
            ],
            [
                'name' => 'HR Manager',
                'description' => 'Human resources management with employee oversight',
                'permissions' => json_encode([
                    'employees_manage', 'attendance_view', 'leaves_manage', 'reports_view',
                    'holidays_manage', 'employee_documents_manage'
                ]),
                'is_active' => true
            ],
            [
                'name' => 'Manager',
                'description' => 'Team management with limited administrative access',
                'permissions' => json_encode([
                    'employees_view', 'attendance_view', 'leaves_approve', 'reports_view',
                    'team_manage'
                ]),
                'is_active' => true
            ],
            [
                'name' => 'Team Lead',
                'description' => 'Team leadership with attendance and leave oversight',
                'permissions' => json_encode([
                    'employees_view', 'attendance_view', 'leaves_view', 'team_reports_view'
                ]),
                'is_active' => true
            ],
            [
                'name' => 'Employee',
                'description' => 'Standard employee access for personal data and attendance',
                'permissions' => json_encode([
                    'profile_manage', 'attendance_self', 'leaves_request', 'documents_self'
                ]),
                'is_active' => true
            ],
            [
                'name' => 'Contractor',
                'description' => 'Limited access for contract workers',
                'permissions' => json_encode([
                    'profile_view', 'attendance_self', 'timesheet_manage'
                ]),
                'is_active' => true
            ],
            [
                'name' => 'Intern',
                'description' => 'Restricted access for interns and trainees',
                'permissions' => json_encode([
                    'profile_view', 'attendance_self', 'learning_resources'
                ]),
                'is_active' => true
            ],
            [
                'name' => 'Finance',
                'description' => 'Financial access with payroll and reporting',
                'permissions' => json_encode([
                    'employees_view', 'payroll_manage', 'financial_reports', 'attendance_reports'
                ]),
                'is_active' => true
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}

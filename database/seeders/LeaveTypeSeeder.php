<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveType;
use App\Models\LeaveTypeGroup;

class LeaveTypeSeeder extends Seeder
{
    public function run()
    {
        $annualGroup = LeaveTypeGroup::where('name', 'Annual Leave')->first();
        $medicalGroup = LeaveTypeGroup::where('name', 'Medical Leave')->first();
        $emergencyGroup = LeaveTypeGroup::where('name', 'Emergency Leave')->first();
        $parentalGroup = LeaveTypeGroup::where('name', 'Parental Leave')->first();
        $educationalGroup = LeaveTypeGroup::where('name', 'Educational Leave')->first();
        $compensatoryGroup = LeaveTypeGroup::where('name', 'Compensatory Leave')->first();
        $specialGroup = LeaveTypeGroup::where('name', 'Special Leave')->first();

        $leaveTypes = [
            // Annual Leave Types
            ['name' => 'Annual Vacation', 'description' => 'Yearly vacation days', 'leave_type_group_id' => $annualGroup->id, 'max_days_per_year' => 25, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 7, 'is_active' => true],
            ['name' => 'Personal Day', 'description' => 'Personal time off', 'leave_type_group_id' => $annualGroup->id, 'max_days_per_year' => 5, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 3, 'is_active' => true],
            ['name' => 'Mental Health Day', 'description' => 'Mental health and wellness day', 'leave_type_group_id' => $annualGroup->id, 'max_days_per_year' => 3, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 1, 'is_active' => true],

            // Medical Leave Types
            ['name' => 'Sick Leave', 'description' => 'Illness and health issues', 'leave_type_group_id' => $medicalGroup->id, 'max_days_per_year' => 15, 'requires_approval' => false, 'is_paid' => true, 'notice_period_days' => 0, 'is_active' => true],
            ['name' => 'Medical Appointment', 'description' => 'Doctor visits and medical procedures', 'leave_type_group_id' => $medicalGroup->id, 'max_days_per_year' => 10, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 1, 'is_active' => true],
            ['name' => 'Surgery Recovery', 'description' => 'Post-surgery recovery period', 'leave_type_group_id' => $medicalGroup->id, 'max_days_per_year' => 30, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 14, 'is_active' => true],

            // Emergency Leave Types
            ['name' => 'Family Emergency', 'description' => 'Immediate family emergencies', 'leave_type_group_id' => $emergencyGroup->id, 'max_days_per_year' => 10, 'requires_approval' => false, 'is_paid' => true, 'notice_period_days' => 0, 'is_active' => true],
            ['name' => 'Bereavement Leave', 'description' => 'Death in family or close friends', 'leave_type_group_id' => $emergencyGroup->id, 'max_days_per_year' => 7, 'requires_approval' => false, 'is_paid' => true, 'notice_period_days' => 0, 'is_active' => true],
            ['name' => 'Natural Disaster', 'description' => 'Natural disaster or emergency situations', 'leave_type_group_id' => $emergencyGroup->id, 'max_days_per_year' => 15, 'requires_approval' => false, 'is_paid' => true, 'notice_period_days' => 0, 'is_active' => true],

            // Parental Leave Types
            ['name' => 'Maternity Leave', 'description' => 'Maternity leave for mothers', 'leave_type_group_id' => $parentalGroup->id, 'max_days_per_year' => 120, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 30, 'is_active' => true],
            ['name' => 'Paternity Leave', 'description' => 'Paternity leave for fathers', 'leave_type_group_id' => $parentalGroup->id, 'max_days_per_year' => 30, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 30, 'is_active' => true],
            ['name' => 'Adoption Leave', 'description' => 'Leave for adoption processes', 'leave_type_group_id' => $parentalGroup->id, 'max_days_per_year' => 60, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 30, 'is_active' => true],

            // Educational Leave Types
            ['name' => 'Training Course', 'description' => 'Professional training and courses', 'leave_type_group_id' => $educationalGroup->id, 'max_days_per_year' => 10, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 14, 'is_active' => true],
            ['name' => 'Conference Attendance', 'description' => 'Industry conferences and seminars', 'leave_type_group_id' => $educationalGroup->id, 'max_days_per_year' => 5, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 21, 'is_active' => true],
            ['name' => 'Certification Exam', 'description' => 'Professional certification examinations', 'leave_type_group_id' => $educationalGroup->id, 'max_days_per_year' => 3, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 7, 'is_active' => true],

            // Compensatory Leave Types
            ['name' => 'Overtime Compensation', 'description' => 'Time off for overtime work', 'leave_type_group_id' => $compensatoryGroup->id, 'max_days_per_year' => 20, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 3, 'is_active' => true],
            ['name' => 'Weekend Work Comp', 'description' => 'Compensation for weekend work', 'leave_type_group_id' => $compensatoryGroup->id, 'max_days_per_year' => 15, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 3, 'is_active' => true],

            // Special Leave Types
            ['name' => 'Religious Observance', 'description' => 'Religious holidays and observances', 'leave_type_group_id' => $specialGroup->id, 'max_days_per_year' => 5, 'requires_approval' => true, 'is_paid' => true, 'notice_period_days' => 7, 'is_active' => true],
            ['name' => 'Jury Duty', 'description' => 'Civic duty for jury service', 'leave_type_group_id' => $specialGroup->id, 'max_days_per_year' => 10, 'requires_approval' => false, 'is_paid' => true, 'notice_period_days' => 1, 'is_active' => true],
            ['name' => 'Voting Day', 'description' => 'Time off for voting in elections', 'leave_type_group_id' => $specialGroup->id, 'max_days_per_year' => 1, 'requires_approval' => false, 'is_paid' => true, 'notice_period_days' => 0, 'is_active' => true],
        ];

        foreach ($leaveTypes as $leaveType) {
            LeaveType::create($leaveType);
        }
    }
}

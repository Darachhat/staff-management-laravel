<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Cache dashboard data for 5 minutes to improve performance
        $cacheKey = 'dashboard_data_' . auth()->id();
        $dashboardData = Cache::remember($cacheKey, 300, function () {
            return $this->getDashboardData();
        });

        return view('dashboard', $dashboardData);
    }

    private function getDashboardData()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        // Get key statistics with trend comparison
        $totalEmployees = Employee::where('status', 'active')->count();
        $totalEmployeesLastMonth = Employee::where('status', 'active')
            ->where('created_at', '<', $startOfMonth)
            ->count();
        $employeeTrend = $totalEmployeesLastMonth > 0 
            ? (($totalEmployees - $totalEmployeesLastMonth) / $totalEmployeesLastMonth) * 100 
            : 0;

        $totalDepartments = Employee::distinct('position_id')->count();

        // Today's attendance statistics with trends
        $todayAttendances = Attendance::whereDate('date', $today)->count();
        $yesterdayAttendances = Attendance::whereDate('date', $today->copy()->subDay())->count();
        $attendanceTrend = $yesterdayAttendances > 0 
            ? (($todayAttendances - $yesterdayAttendances) / $yesterdayAttendances) * 100 
            : 0;

        $presentToday = Attendance::whereDate('date', $today)
            ->whereNotNull('check_in_time')
            ->count();
        $presentYesterday = Attendance::whereDate('date', $today->copy()->subDay())
            ->whereNotNull('check_in_time')
            ->count();
        $presentTrend = $presentYesterday > 0 
            ? (($presentToday - $presentYesterday) / $presentYesterday) * 100 
            : 0;

        $lateToday = Attendance::whereDate('date', $today)
            ->where('status', 'late')
            ->count();
        $lateYesterday = Attendance::whereDate('date', $today->copy()->subDay())
            ->where('status', 'late')
            ->count();
        $lateTrend = $lateYesterday > 0 
            ? (($lateToday - $lateYesterday) / $lateYesterday) * 100 
            : 0;

        // Leave statistics with trends
        $pendingLeaves = Leave::where('status', 'pending')->count();
        $approvedLeavesToday = Leave::where('status', 'approved')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->count();

        // Recent activities (last 7 days) with better ordering
        $recentAttendances = Attendance::with(['employee:id,first_name,last_name,profile_image'])
            ->whereDate('date', '>=', $today->copy()->subDays(7))
            ->orderBy('date', 'desc')
            ->orderBy('check_in_time', 'desc')
            ->limit(8)
            ->get();

        // Enhanced attendance trends for the past week
        $attendanceTrends = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $count = Attendance::whereDate('date', $date)
                ->whereNotNull('check_in_time')
                ->count();
            $attendanceTrends->push([
                'date' => $date->format('M d'),
                'count' => $count,
                'percentage' => $totalEmployees > 0 ? ($count / $totalEmployees) * 100 : 0
            ]);
        }

        // Employee status distribution
        $employeeStatusDistribution = Employee::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        // Upcoming birthdays (next 30 days)
        $upcomingBirthdays = Employee::whereRaw('DATE_ADD(date_of_birth, INTERVAL YEAR(CURDATE()) - YEAR(date_of_birth) + IF(DAYOFYEAR(CURDATE()) > DAYOFYEAR(date_of_birth), 1, 0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)')
            ->orderByRaw('DATE_ADD(date_of_birth, INTERVAL YEAR(CURDATE()) - YEAR(date_of_birth) + IF(DAYOFYEAR(CURDATE()) > DAYOFYEAR(date_of_birth), 1, 0) YEAR)')
            ->limit(5)
            ->get();

        // Recent leave requests with better data
        $recentLeaveRequests = Leave::with(['employee:id,first_name,last_name,profile_image'])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Department-wise attendance summary
        $departmentAttendance = DB::table('employees')
            ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
            ->where('attendances.date', $today)
            ->where('employees.status', 'active')
            ->select('employees.position_id', DB::raw('COUNT(*) as present_count'))
            ->groupBy('employees.position_id')
            ->get();

        // Quick stats for performance indicators
        $performanceMetrics = [
            'attendance_rate' => $totalEmployees > 0 ? ($presentToday / $totalEmployees) * 100 : 0,
            'punctuality_rate' => $presentToday > 0 ? (($presentToday - $lateToday) / $presentToday) * 100 : 0,
            'leave_approval_rate' => Leave::where('status', '!=', 'pending')->count() > 0 
                ? (Leave::where('status', 'approved')->count() / Leave::where('status', '!=', 'pending')->count()) * 100 
                : 0,
        ];

        return compact(
            'totalEmployees',
            'totalDepartments',
            'todayAttendances',
            'presentToday',
            'lateToday',
            'pendingLeaves',
            'approvedLeavesToday',
            'recentAttendances',
            'attendanceTrends',
            'employeeStatusDistribution',
            'upcomingBirthdays',
            'recentLeaveRequests',
            'departmentAttendance',
            'performanceMetrics',
            'employeeTrend',
            'attendanceTrend',
            'presentTrend',
            'lateTrend'
        );
    }
}

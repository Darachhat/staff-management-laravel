<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get key statistics
        $totalEmployees = Employee::where('status', 'active')->count();
        $totalDepartments = Employee::distinct('position_id')->count();

        // Today's attendance statistics
        $today = Carbon::today();
        $todayAttendances = Attendance::whereDate('date', $today)->count();
        $presentToday = Attendance::whereDate('date', $today)
            ->whereNotNull('check_in_time')
            ->count();
        $lateToday = Attendance::whereDate('date', $today)
            ->where('status', 'late')
            ->count();

        // Leave statistics
        $pendingLeaves = Leave::where('status', 'pending')->count();
        $approvedLeavesToday = Leave::where('status', 'approved')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->count();

        // Recent activities (last 7 days)
        $recentAttendances = Attendance::with('employee')
            ->whereDate('date', '>=', $today->copy()->subDays(7))
            ->orderBy('date', 'desc')
            ->orderBy('check_in_time', 'desc')
            ->limit(10)
            ->get();

        // Simple attendance trends
        $attendanceTrends = collect([]);

        // Employee status distribution
        $employeeStatusDistribution = Employee::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        // Simple upcoming birthdays (empty for now to avoid SQL issues)
        $upcomingBirthdays = collect([]);

        // Recent leave requests
        $recentLeaveRequests = Leave::with('employee')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
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
            'recentLeaveRequests'
        ));
    }
}

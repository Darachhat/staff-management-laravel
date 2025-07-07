<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\AttendanceZone;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['employee', 'attendanceZone']);

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->get('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->get('date_to'));
        }

        if ($request->filled('employee')) {
            $query->where('employee_id', $request->get('employee'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $attendances = $query->orderBy('date', 'desc')->paginate(15);
        $employees = Employee::where('status', 'active')->get();

        return view('attendances.index', compact('attendances', 'employees'));
    }

    public function clockIn(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $employee = Employee::findOrFail($request->employee_id);
        $today = Carbon::today();

        // Check if already clocked in today
        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', $today)
            ->first();

        if ($attendance && $attendance->check_in_time) {
            return response()->json(['error' => 'Already clocked in today'], 400);
        }

        // Create or update attendance record
        $attendance = Attendance::updateOrCreate(
            [
                'employee_id' => $employee->id,
                'date' => $today,
            ],
            [
                'check_in_time' => Carbon::now()->format('H:i:s'),
                'check_in_latitude' => $request->latitude,
                'check_in_longitude' => $request->longitude,
                'expected_check_in' => $employee->workDayTime->start_time,
            ]
        );

        // Determine status
        $this->updateAttendanceStatus($attendance);

        return response()->json(['success' => 'Clocked in successfully', 'attendance' => $attendance]);
    }

    public function clockOut(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $employee = Employee::findOrFail($request->employee_id);
        $today = Carbon::today();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', $today)
            ->first();

        if (!$attendance || !$attendance->check_in_time) {
            return response()->json(['error' => 'Must clock in first'], 400);
        }

        if ($attendance->check_out_time) {
            return response()->json(['error' => 'Already clocked out today'], 400);
        }

        $attendance->update([
            'check_out_time' => Carbon::now()->format('H:i:s'),
            'check_out_latitude' => $request->latitude,
            'check_out_longitude' => $request->longitude,
            'expected_check_out' => $employee->workDayTime->end_time,
        ]);

        // Calculate total hours and overtime
        $this->calculateWorkingHours($attendance);
        $this->updateAttendanceStatus($attendance);

        return response()->json(['success' => 'Clocked out successfully', 'attendance' => $attendance]);
    }

    private function updateAttendanceStatus(Attendance $attendance)
    {
        $status = 'present';

        if ($attendance->check_in_time && $attendance->expected_check_in) {
            if (Carbon::parse($attendance->check_in_time)->gt(Carbon::parse($attendance->expected_check_in))) {
                $status = 'late';
            }
        }

        if ($attendance->check_out_time && $attendance->expected_check_out) {
            if (Carbon::parse($attendance->check_out_time)->lt(Carbon::parse($attendance->expected_check_out))) {
                $status = 'early_departure';
            }
        }

        if ($attendance->overtime_hours > 0) {
            $status = 'overtime';
        }

        $attendance->update(['status' => $status]);
    }

    private function calculateWorkingHours(Attendance $attendance)
    {
        if (!$attendance->check_in_time || !$attendance->check_out_time) {
            return;
        }

        $checkIn = Carbon::parse($attendance->check_in_time);
        $checkOut = Carbon::parse($attendance->check_out_time);

        $totalMinutes = $checkOut->diffInMinutes($checkIn);
        $totalMinutes -= $attendance->break_duration;

        $totalHours = $totalMinutes / 60;

        // Calculate overtime (assuming 8 hours is standard)
        $standardHours = 8;
        $overtimeHours = max(0, $totalHours - $standardHours);

        $attendance->update([
            'total_hours' => $totalHours,
            'overtime_hours' => $overtimeHours,
        ]);
    }
}

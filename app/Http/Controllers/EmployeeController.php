<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Role;
use App\Models\EmployeeCategory;
use App\Models\WorkCondition;
use App\Models\WorkDayTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with(['position', 'role', 'employeeCategory', 'workCondition']);

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('employee_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->filled('position')) {
            $query->where('position_id', $request->get('position'));
        }

        $employees = $query->paginate(15);
        $positions = Position::where('is_active', true)->get();

        return view('employees.index', compact('employees', 'positions'));
    }

    public function create()
    {
        $positions = Position::where('is_active', true)->get();
        $roles = Role::where('is_active', true)->get();
        $categories = EmployeeCategory::where('is_active', true)->get();
        $workConditions = WorkCondition::where('is_active', true)->get();
        $workDayTimes = WorkDayTime::where('is_active', true)->get();

        return view('employees.create', compact('positions', 'roles', 'categories', 'workConditions', 'workDayTimes'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();

        // Generate employee ID if not provided
        if (!isset($data['employee_id'])) {
            $data['employee_id'] = 'EMP' . str_pad(Employee::count() + 1, 4, '0', STR_PAD_LEFT);
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('employees/profiles', 'public');
        }

        $employee = Employee::create($data);

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        $employee->load(['position', 'role', 'employeeCategory', 'workCondition', 'workDayTime', 'skills', 'services', 'documents', 'attendances', 'leaves']);

        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $positions = Position::where('is_active', true)->get();
        $roles = Role::where('is_active', true)->get();
        $categories = EmployeeCategory::where('is_active', true)->get();
        $workConditions = WorkCondition::where('is_active', true)->get();
        $workDayTimes = WorkDayTime::where('is_active', true)->get();

        return view('employees.edit', compact('employee', 'positions', 'roles', 'categories', 'workConditions', 'workDayTimes'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($employee->profile_image) {
                Storage::disk('public')->delete($employee->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('employees/profiles', 'public');
        }

        $employee->update($data);

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        // Delete profile image
        if ($employee->profile_image) {
            Storage::disk('public')->delete($employee->profile_image);
        }

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}

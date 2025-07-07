@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600 mt-2">Welcome back! Here's what's happening with your team today.</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Employees -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalEmployees }}</p>
                        <p class="text-sm text-gray-600">Total Employees</p>
                    </div>
                </div>
            </div>

            <!-- Present Today -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-semibold text-gray-900">{{ $presentToday }}</p>
                        <p class="text-sm text-gray-600">Present Today</p>
                    </div>
                </div>
            </div>

            <!-- Late Today -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-semibold text-gray-900">{{ $lateToday }}</p>
                        <p class="text-sm text-gray-600">Late Today</p>
                    </div>
                </div>
            </div>

            <!-- Pending Leaves -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-semibold text-gray-900">{{ $pendingLeaves }}</p>
                        <p class="text-sm text-gray-600">Pending Leaves</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Attendance -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Recent Attendance</h3>
                </div>
                <div class="p-6">
                    @forelse($recentAttendances as $attendance)
                        <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    @if($attendance->employee && $attendance->employee->profile_image)
                                        <img class="h-8 w-8 rounded-full" src="{{ Storage::url($attendance->employee->profile_image) }}" alt="{{ $attendance->employee->full_name }}">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-xs font-medium text-gray-700">
                                            {{ $attendance->employee ? substr($attendance->employee->first_name, 0, 1) : 'N/A' }}
                                        </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $attendance->employee ? $attendance->employee->full_name : 'Unknown Employee' }}
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $attendance->date }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-900">{{ $attendance->check_in_time ?: '--:--' }}</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $attendance->status === 'present' ? 'bg-green-100 text-green-800' :
                                   ($attendance->status === 'late' ? 'bg-yellow-100 text-yellow-800' :
                                   ($attendance->status === 'overtime' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No recent attendance records.</p>
                    @endforelse

                    @if($recentAttendances->count() > 0)
                        <div class="mt-4">
                            <a href="{{ route('attendances.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View all attendance →
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Leave Requests -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Recent Leave Requests</h3>
                </div>
                <div class="p-6">
                    @forelse($recentLeaveRequests as $leave)
                        <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    @if($leave->employee && $leave->employee->profile_image)
                                        <img class="h-8 w-8 rounded-full" src="{{ Storage::url($leave->employee->profile_image) }}" alt="{{ $leave->employee->full_name }}">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-xs font-medium text-gray-700">
                                            {{ $leave->employee ? substr($leave->employee->first_name, 0, 1) : 'N/A' }}
                                        </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $leave->employee ? $leave->employee->full_name : 'Unknown Employee' }}
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $leave->start_date }} - {{ $leave->end_date }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-900">{{ $leave->total_days }} day{{ $leave->total_days > 1 ? 's' : '' }}</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $leave->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                   ($leave->status === 'approved' ? 'bg-green-100 text-green-800' :
                                   ($leave->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                {{ ucfirst($leave->status) }}
                            </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No recent leave requests.</p>
                    @endforelse

                    @if($recentLeaveRequests->count() > 0)
                        <div class="mt-4">
                            <a href="{{ route('leaves.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View all leaves →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('employees.create') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Add Employee</p>
                            <p class="text-sm text-gray-500">Create new employee</p>
                        </div>
                    </div>
                </a>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Clock In/Out</p>
                            <p class="text-sm text-gray-500">Manage attendance</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Request Leave</p>
                            <p class="text-sm text-gray-500">Submit leave request</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">View Reports</p>
                            <p class="text-sm text-gray-500">Attendance reports</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Birthdays -->
        @if($upcomingBirthdays && $upcomingBirthdays->count() > 0)
            <div class="mt-8">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Upcoming Birthdays</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($upcomingBirthdays as $employee)
                                <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($employee->profile_image)
                                            <img class="h-10 w-10 rounded-full" src="{{ Storage::url($employee->profile_image) }}" alt="{{ $employee->full_name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-blue-300 flex items-center justify-center">
                                                <span class="text-sm font-medium text-blue-700">{{ substr($employee->first_name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $employee->full_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $employee->date_of_birth }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

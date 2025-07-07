@extends('layouts.app')

@section('content')
<div x-data="dashboard" x-init="init()" class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Enhanced Header -->
        <div class="mb-8 relative">
            <div class="flex items-center justify-between">
                <div class="animate-fade-in">
                    <h1 class="text-4xl font-bold text-gray-900 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Dashboard
                    </h1>
                    <p class="text-gray-600 mt-2 text-lg">Welcome back! Here's what's happening with your team today.</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-sm text-gray-500">
                        <span class="font-medium">Last updated:</span> 
                        <span x-text="new Date().toLocaleTimeString()"></span>
                    </div>
                    <button 
                        @click="refreshStats()"
                        :disabled="refreshing"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                        :class="{ 'animate-pulse': refreshing }"
                    >
                        <svg class="w-4 h-4 mr-2" :class="{ 'animate-spin': refreshing }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span x-text="refreshing ? 'Refreshing...' : 'Refresh'"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Enhanced Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Employees -->
            <div x-data="cardHover" 
                 @mouseenter="enter()" 
                 @mouseleave="leave()"
                 class="bg-white rounded-xl shadow-soft p-6 border border-gray-100 hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1 animate-slide-up">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg"
                                 :class="{ 'shadow-blue-500/25': hovered }">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-3xl font-bold text-gray-900 stat-number">{{ $totalEmployees }}</p>
                            <p class="text-sm text-gray-600 font-medium">Total Employees</p>
                        </div>
                    </div>
                    @if(isset($employeeTrend))
                    <div class="flex items-center">
                        <div class="flex items-center text-sm {{ $employeeTrend >= 0 ? 'text-success-600' : 'text-danger-600' }}">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($employeeTrend >= 0)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                @endif
                            </svg>
                            <span class="font-medium">{{ number_format(abs($employeeTrend), 1) }}%</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Present Today -->
            <div x-data="cardHover" 
                 @mouseenter="enter()" 
                 @mouseleave="leave()"
                 class="bg-white rounded-xl shadow-soft p-6 border border-gray-100 hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1 animate-slide-up">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-success-500 to-success-600 rounded-xl flex items-center justify-center shadow-lg"
                                 :class="{ 'shadow-success-500/25': hovered }">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-3xl font-bold text-gray-900 stat-number">{{ $presentToday }}</p>
                            <p class="text-sm text-gray-600 font-medium">Present Today</p>
                        </div>
                    </div>
                    @if(isset($presentTrend))
                    <div class="flex items-center">
                        <div class="flex items-center text-sm {{ $presentTrend >= 0 ? 'text-success-600' : 'text-danger-600' }}">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($presentTrend >= 0)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                @endif
                            </svg>
                            <span class="font-medium">{{ number_format(abs($presentTrend), 1) }}%</span>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Attendance Rate</span>
                        <span class="font-semibold">{{ $totalEmployees > 0 ? number_format(($presentToday / $totalEmployees) * 100, 1) : 0 }}%</span>
                    </div>
                    <div class="mt-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-success-500 to-success-600 h-2 rounded-full transition-all duration-500"
                             style="width: {{ $totalEmployees > 0 ? ($presentToday / $totalEmployees) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Late Today -->
            <div x-data="cardHover" 
                 @mouseenter="enter()" 
                 @mouseleave="leave()"
                 class="bg-white rounded-xl shadow-soft p-6 border border-gray-100 hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1 animate-slide-up">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-warning-500 to-warning-600 rounded-xl flex items-center justify-center shadow-lg"
                                 :class="{ 'shadow-warning-500/25': hovered }">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-3xl font-bold text-gray-900 stat-number">{{ $lateToday }}</p>
                            <p class="text-sm text-gray-600 font-medium">Late Today</p>
                        </div>
                    </div>
                    @if(isset($lateTrend))
                    <div class="flex items-center">
                        <div class="flex items-center text-sm {{ $lateTrend <= 0 ? 'text-success-600' : 'text-danger-600' }}">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($lateTrend <= 0)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                @endif
                            </svg>
                            <span class="font-medium">{{ number_format(abs($lateTrend), 1) }}%</span>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Punctuality Rate</span>
                        <span class="font-semibold">{{ $presentToday > 0 ? number_format((($presentToday - $lateToday) / $presentToday) * 100, 1) : 0 }}%</span>
                    </div>
                    <div class="mt-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-warning-500 to-warning-600 h-2 rounded-full transition-all duration-500"
                             style="width: {{ $presentToday > 0 ? (($presentToday - $lateToday) / $presentToday) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Pending Leaves -->
            <div x-data="cardHover" 
                 @mouseenter="enter()" 
                 @mouseleave="leave()"
                 class="bg-white rounded-xl shadow-soft p-6 border border-gray-100 hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1 animate-slide-up">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-danger-500 to-danger-600 rounded-xl flex items-center justify-center shadow-lg"
                                 :class="{ 'shadow-danger-500/25': hovered }">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-3xl font-bold text-gray-900 stat-number">{{ $pendingLeaves }}</p>
                            <p class="text-sm text-gray-600 font-medium">Pending Leaves</p>
                        </div>
                    </div>
                    @if($pendingLeaves > 0)
                    <div class="flex items-center">
                        <div class="bg-danger-100 text-danger-800 px-2 py-1 rounded-full text-xs font-medium animate-pulse">
                            Requires Action
                        </div>
                    </div>
                    @endif
                </div>
                @if($pendingLeaves > 0)
                <div class="mt-4">
                    <a href="{{ route('leaves.index') }}" 
                       class="inline-flex items-center text-sm text-danger-600 hover:text-danger-700 font-medium group">
                        <span>Review pending requests</span>
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Enhanced Data Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Recent Attendance -->
            <div class="bg-white rounded-xl shadow-soft border border-gray-100 animate-slide-up">
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Attendance</h3>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-sm text-gray-500">Live</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    @forelse($recentAttendances as $attendance)
                        <div class="flex items-center justify-between py-4 {{ !$loop->last ? 'border-b border-gray-50' : '' }} hover:bg-gray-50 rounded-lg transition-colors duration-200 px-2">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    @if($attendance->employee && $attendance->employee->profile_image)
                                        <img class="h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm" 
                                             src="{{ Storage::url($attendance->employee->profile_image) }}" 
                                             alt="{{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm">
                                            <span class="text-sm font-semibold text-white">
                                                {{ $attendance->employee ? substr($attendance->employee->first_name, 0, 1) : 'N/A' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $attendance->employee ? $attendance->employee->first_name . ' ' . $attendance->employee->last_name : 'Unknown Employee' }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $attendance->check_in_time ? Carbon\Carbon::parse($attendance->check_in_time)->format('g:i A') : '--:--' }}
                                    </p>
                                    @if($attendance->check_out_time)
                                        <p class="text-xs text-gray-500">
                                            Out: {{ Carbon\Carbon::parse($attendance->check_out_time)->format('g:i A') }}
                                        </p>
                                    @endif
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $attendance->status === 'present' ? 'bg-success-100 text-success-700' :
                                   ($attendance->status === 'late' ? 'bg-warning-100 text-warning-700' :
                                   ($attendance->status === 'overtime' ? 'bg-blue-100 text-blue-700' : 'bg-danger-100 text-danger-700')) }}">
                                    {{ ucfirst($attendance->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">No recent attendance records found.</p>
                            <p class="text-gray-400 text-xs mt-1">Records will appear here once employees check in.</p>
                        </div>
                    @endforelse

                    @if($recentAttendances->count() > 0)
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <a href="{{ route('attendances.index') }}" 
                               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium group">
                                <span>View all attendance records</span>
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Leave Requests -->
            <div class="bg-white rounded-xl shadow-soft border border-gray-100 animate-slide-up">
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Leave Requests</h3>
                        @if($pendingLeaves > 0)
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                                <span class="text-sm text-red-600 font-medium">{{ $pendingLeaves }} pending</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    @forelse($recentLeaveRequests as $leave)
                        <div class="flex items-center justify-between py-4 {{ !$loop->last ? 'border-b border-gray-50' : '' }} hover:bg-gray-50 rounded-lg transition-colors duration-200 px-2">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    @if($leave->employee && $leave->employee->profile_image)
                                        <img class="h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm" 
                                             src="{{ Storage::url($leave->employee->profile_image) }}" 
                                             alt="{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-sm">
                                            <span class="text-sm font-semibold text-white">
                                                {{ $leave->employee ? substr($leave->employee->first_name, 0, 1) : 'N/A' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $leave->employee ? $leave->employee->first_name . ' ' . $leave->employee->last_name : 'Unknown Employee' }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ Carbon\Carbon::parse($leave->start_date)->format('M d') }} - 
                                        {{ Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $leave->total_days }} day{{ $leave->total_days > 1 ? 's' : '' }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ ucfirst($leave->leave_type ?? 'General') }}
                                    </p>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $leave->status === 'pending' ? 'bg-warning-100 text-warning-700' :
                                   ($leave->status === 'approved' ? 'bg-success-100 text-success-700' :
                                   ($leave->status === 'rejected' ? 'bg-danger-100 text-danger-700' : 'bg-gray-100 text-gray-700')) }}">
                                    {{ ucfirst($leave->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">No recent leave requests found.</p>
                            <p class="text-gray-400 text-xs mt-1">Leave requests will appear here once submitted.</p>
                        </div>
                    @endforelse

                    @if($recentLeaveRequests->count() > 0)
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <a href="{{ route('leaves.index') }}" 
                               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium group">
                                <span>View all leave requests</span>
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Performance Metrics -->
        @if(isset($performanceMetrics))
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-soft p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-600">Attendance Rate</h4>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($performanceMetrics['attendance_rate'], 1) }}%</p>
                    </div>
                    <div class="w-16 h-16 relative">
                        <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-200" stroke="currentColor" stroke-width="2" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="text-blue-600" stroke="currentColor" stroke-width="2" fill="none" stroke-dasharray="{{ $performanceMetrics['attendance_rate'] }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-soft p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-600">Punctuality Rate</h4>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($performanceMetrics['punctuality_rate'], 1) }}%</p>
                    </div>
                    <div class="w-16 h-16 relative">
                        <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-200" stroke="currentColor" stroke-width="2" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="text-green-600" stroke="currentColor" stroke-width="2" fill="none" stroke-dasharray="{{ $performanceMetrics['punctuality_rate'] }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-soft p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-600">Leave Approval Rate</h4>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($performanceMetrics['leave_approval_rate'], 1) }}%</p>
                    </div>
                    <div class="w-16 h-16 relative">
                        <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-200" stroke="currentColor" stroke-width="2" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="text-purple-600" stroke="currentColor" stroke-width="2" fill="none" stroke-dasharray="{{ $performanceMetrics['leave_approval_rate'] }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Enhanced Quick Actions -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-gray-900">Quick Actions</h3>
                <p class="text-sm text-gray-500">Frequently used features</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('employees.create') }}" 
                   x-data="cardHover" 
                   @mouseenter="enter()" 
                   @mouseleave="leave()"
                   class="group bg-white p-6 rounded-xl shadow-soft border border-gray-100 hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-blue-500/25 transition-all duration-300"
                                 :class="{ 'scale-110': hovered }">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Add Employee</p>
                            <p class="text-sm text-gray-500">Create new employee record</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('attendances.create') }}" 
                   x-data="cardHover" 
                   @mouseenter="enter()" 
                   @mouseleave="leave()"
                   class="group bg-white p-6 rounded-xl shadow-soft border border-gray-100 hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-success-500 to-success-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-success-500/25 transition-all duration-300"
                                 :class="{ 'scale-110': hovered }">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-semibold text-gray-900 group-hover:text-success-600 transition-colors">Clock In/Out</p>
                            <p class="text-sm text-gray-500">Manage attendance</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('leaves.create') }}" 
                   x-data="cardHover" 
                   @mouseenter="enter()" 
                   @mouseleave="leave()"
                   class="group bg-white p-6 rounded-xl shadow-soft border border-gray-100 hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-warning-500 to-warning-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-warning-500/25 transition-all duration-300"
                                 :class="{ 'scale-110': hovered }">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-semibold text-gray-900 group-hover:text-warning-600 transition-colors">Request Leave</p>
                            <p class="text-sm text-gray-500">Submit leave request</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('attendances.index') }}" 
                   x-data="cardHover" 
                   @mouseenter="enter()" 
                   @mouseleave="leave()"
                   class="group bg-white p-6 rounded-xl shadow-soft border border-gray-100 hover:shadow-medium transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-purple-500/25 transition-all duration-300"
                                 :class="{ 'scale-110': hovered }">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">View Reports</p>
                            <p class="text-sm text-gray-500">Attendance reports</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Attendance Trends Chart -->
        @if(isset($attendanceTrends) && $attendanceTrends->count() > 0)
        <div class="bg-white rounded-xl shadow-soft border border-gray-100 p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Attendance Trends (Last 7 Days)</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-500">Daily Attendance</span>
                </div>
            </div>
            <div class="grid grid-cols-7 gap-4">
                @foreach($attendanceTrends as $trend)
                    <div class="text-center">
                        <div class="mb-2">
                            <div class="h-24 bg-gray-100 rounded-lg flex items-end justify-center p-1">
                                <div class="bg-gradient-to-t from-blue-500 to-blue-400 rounded-sm transition-all duration-500"
                                     style="width: 100%; height: {{ $trend['percentage'] }}%"></div>
                            </div>
                        </div>
                        <p class="text-xs font-medium text-gray-900">{{ $trend['count'] }}</p>
                        <p class="text-xs text-gray-500">{{ $trend['date'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Enhanced Upcoming Birthdays -->
        @if($upcomingBirthdays && $upcomingBirthdays->count() > 0)
            <div class="bg-white rounded-xl shadow-soft border border-gray-100 animate-slide-up">
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Upcoming Birthdays</h3>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-pink-500 rounded-full animate-pulse"></div>
                            <span class="text-sm text-pink-600">{{ $upcomingBirthdays->count() }} coming up</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($upcomingBirthdays as $employee)
                            <div class="flex items-center p-4 bg-gradient-to-r from-pink-50 to-purple-50 rounded-xl border border-pink-100 hover:shadow-md transition-shadow duration-200">
                                <div class="flex-shrink-0">
                                    @if($employee->profile_image)
                                        <img class="h-12 w-12 rounded-full object-cover ring-2 ring-white shadow-sm" 
                                             src="{{ Storage::url($employee->profile_image) }}" 
                                             alt="{{ $employee->first_name }} {{ $employee->last_name }}">
                                    @else
                                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-pink-500 to-purple-500 flex items-center justify-center shadow-sm">
                                            <span class="text-lg font-bold text-white">{{ substr($employee->first_name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-gray-900">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                                    <p class="text-sm text-gray-600">{{ Carbon\Carbon::parse($employee->date_of_birth)->format('M d') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

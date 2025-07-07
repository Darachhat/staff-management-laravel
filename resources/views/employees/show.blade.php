@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $employee->full_name }}</h1>
                    <p class="text-gray-600 mt-1">{{ $employee->employee_id }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('employees.edit', $employee) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit Employee
                    </a>
                    <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Back to List
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Profile Image -->
                @if($employee->profile_image)
                    <div class="md:col-span-2">
                        <img class="h-32 w-32 rounded-full mx-auto" src="{{ Storage::url($employee->profile_image) }}" alt="{{ $employee->full_name }}">
                    </div>
                @endif

                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Personal Information</h3>
                    <dl class="space-y-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                            <dd class="text-sm text-gray-900">{{ $employee->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="text-sm text-gray-900">{{ $employee->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="text-sm text-gray-900">{{ $employee->phone ?: 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                            <dd class="text-sm text-gray-900">{{ $employee->date_of_birth ? $employee->date_of_birth->format('M j, Y') : 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Gender</dt>
                            <dd class="text-sm text-gray-900">{{ $employee->gender ? ucfirst($employee->gender) : 'Not specified' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Work Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Work Information</h3>
                    <dl class="space-y-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Employee ID</dt>
                            <dd class="text-sm text-gray-900">{{ $employee->employee_id }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $employee->status === 'active' ? 'bg-green-100 text-green-800' :
                                   ($employee->status === 'inactive' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Hire Date</dt>
                            <dd class="text-sm text-gray-900">{{ $employee->hire_date->format('M j, Y') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            @if($employee->address)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Address</h3>
                    <p class="text-sm text-gray-900">{{ $employee->address }}</p>
                </div>
            @endif

            @if($employee->emergency_contact_name || $employee->emergency_contact_phone)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Emergency Contact</h3>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($employee->emergency_contact_name)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="text-sm text-gray-900">{{ $employee->emergency_contact_name }}</dd>
                            </div>
                        @endif
                        @if($employee->emergency_contact_phone)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="text-sm text-gray-900">{{ $employee->emergency_contact_phone }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            @endif
        </div>
    </div>
@endsection

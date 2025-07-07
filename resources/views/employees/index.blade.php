@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Employees</h1>
            <a href="{{ route('employees.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Employee
            </a>
        </div>

        <!-- Employee List -->
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200">
                @forelse($employees ?? [] as $employee)
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($employee->profile_image)
                                            <img class="h-10 w-10 rounded-full" src="{{ Storage::url($employee->profile_image) }}" alt="{{ $employee->full_name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                <span class="text-sm font-medium text-gray-700">{{ substr($employee->first_name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="flex items-center">
                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                {{ $employee->full_name }}
                                            </p>
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $employee->status === 'active' ? 'bg-green-100 text-green-800' :
                                               ($employee->status === 'inactive' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($employee->status) }}
                                        </span>
                                        </div>
                                        <div class="mt-2 flex">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <p>{{ $employee->employee_id }} • {{ $employee->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('employees.show', $employee) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    <a href="{{ route('employees.edit', $employee) }}" class="text-green-600 hover:text-green-900">Edit</a>
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="px-4 py-8 text-center text-gray-500">
                        No employees found. <a href="{{ route('employees.create') }}" class="text-blue-600 hover:text-blue-800">Add the first employee</a>.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection

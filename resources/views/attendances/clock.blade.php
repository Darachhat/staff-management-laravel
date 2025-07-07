@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Clock In/Out</h1>
            <p class="text-gray-600">Track your daily attendance</p>
        </div>

        <!-- Current Time Display -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8 text-center">
            <div class="text-4xl font-bold text-gray-900 mb-2" id="current-time">
                {{ now()->format('H:i:s') }}
            </div>
            <div class="text-lg text-gray-600">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>

        <!-- Employee Selection -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <div class="mb-4">
                <label for="employee-select" class="block text-sm font-medium text-gray-700 mb-2">Select Employee</label>
                <select id="employee-select" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Choose an employee...</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->full_name }} ({{ $employee->employee_id }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Clock In/Out Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <button id="clock-in-btn"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Clock In
                </button>

                <button id="clock-out-btn"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-6 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Clock Out
                </button>
            </div>
        </div>

        <!-- Today's Attendance -->
        <div class="bg-white rounded-lg shadow-lg p-6" id="attendance-status" style="display: none;">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Today's Attendance</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm text-gray-600">Clock In</div>
                    <div class="text-lg font-semibold" id="check-in-time">--:--</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm text-gray-600">Clock Out</div>
                    <div class="text-lg font-semibold" id="check-out-time">--:--</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm text-gray-600">Total Hours</div>
                    <div class="text-lg font-semibold" id="total-hours">0.00</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update current time every second
        setInterval(function() {
            const now = new Date();
            document.getElementById('current-time').textContent = now.toLocaleTimeString();
        }, 1000);

        // Clock In/Out functionality
        document.getElementById('clock-in-btn').addEventListener('click', function() {
            const employeeId = document.getElementById('employee-select').value;
            if (!employeeId) {
                alert('Please select an employee first.');
                return;
            }

            clockAction('clock-in', employeeId);
        });

        document.getElementById('clock-out-btn').addEventListener('click', function() {
            const employeeId = document.getElementById('employee-select').value;
            if (!employeeId) {
                alert('Please select an employee first.');
                return;
            }

            clockAction('clock-out', employeeId);
        });

        function clockAction(action, employeeId) {
            // Get user location if available
            navigator.geolocation.getCurrentPosition(function(position) {
                const data = {
                    employee_id: employeeId,
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude,
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                };

                fetch(`/attendance/${action}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': data._token
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert(result.success);
                            updateAttendanceStatus(result.attendance);
                        } else {
                            alert(result.error || 'An error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while processing your request.');
                    });
            }, function(error) {
                // Location not available, proceed without location
                const data = {
                    employee_id: employeeId,
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                };

                fetch(`/attendance/${action}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': data._token
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert(result.success);
                            updateAttendanceStatus(result.attendance);
                        } else {
                            alert(result.error || 'An error occurred');
                        }
                    });
            });
        }

        function updateAttendanceStatus(attendance) {
            document.getElementById('attendance-status').style.display = 'block';
            document.getElementById('check-in-time').textContent = attendance.check_in_time || '--:--';
            document.getElementById('check-out-time').textContent = attendance.check_out_time || '--:--';
            document.getElementById('total-hours').textContent = attendance.total_hours || '0.00';
        }
    </script>
@endsection

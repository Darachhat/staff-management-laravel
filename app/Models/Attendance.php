<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'attendance_zone_id',
        'date',
        'check_in_time',
        'check_out_time',
        'expected_check_in',
        'expected_check_out',
        'break_duration',
        'total_hours',
        'overtime_hours',
        'status',
        'notes',
        'check_in_latitude',
        'check_in_longitude',
        'check_out_latitude',
        'check_out_longitude',
    ];

    protected $casts = [
        'date' => 'date',
        'total_hours' => 'decimal:2',
        'overtime_hours' => 'decimal:2',
        'check_in_latitude' => 'decimal:8',
        'check_in_longitude' => 'decimal:8',
        'check_out_latitude' => 'decimal:8',
        'check_out_longitude' => 'decimal:8',
    ];

    // Custom accessors for time fields
    public function getCheckInTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value) : null;
    }

    public function getCheckOutTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value) : null;
    }

    public function getExpectedCheckInAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value) : null;
    }

    public function getExpectedCheckOutAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value) : null;
    }

    // Relationships
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function attendanceZone(): BelongsTo
    {
        return $this->belongsTo(AttendanceZone::class);
    }

    // Accessors
    public function getIsLateAttribute(): bool
    {
        if (!$this->check_in_time || !$this->expected_check_in) {
            return false;
        }

        return $this->check_in_time->gt($this->expected_check_in);
    }

    public function getIsEarlyDepartureAttribute(): bool
    {
        if (!$this->check_out_time || !$this->expected_check_out) {
            return false;
        }

        return $this->check_out_time->lt($this->expected_check_out);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'hourly_rate', 'monthly_salary',
        'working_hours_per_day', 'working_days_per_week', 'is_active'
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'monthly_salary' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}

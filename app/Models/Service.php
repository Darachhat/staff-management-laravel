<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'hourly_rate', 'fixed_price', 'is_active'];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'fixed_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class)
            ->withPivot('custom_rate', 'assigned_date')
            ->withTimestamps();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AttendanceZone;

class AttendanceZoneSeeder extends Seeder
{
    public function run()
    {
        $zones = [
            [
                'name' => 'Main Office Building',
                'description' => 'Primary office location for check-in/out',
                'latitude' => 11.5564,
                'longitude' => 104.9282,
                'radius' => 100, // 100 meters
                'is_active' => true
            ],
            [
                'name' => 'Branch Office Downtown',
                'description' => 'Downtown branch office location',
                'latitude' => 11.5449,
                'longitude' => 104.8922,
                'radius' => 75,
                'is_active' => true
            ],
            [
                'name' => 'Client Site A',
                'description' => 'Client location for on-site work',
                'latitude' => 11.5604,
                'longitude' => 104.9144,
                'radius' => 50,
                'is_active' => true
            ],
            [
                'name' => 'Client Site B',
                'description' => 'Secondary client location',
                'latitude' => 11.5434,
                'longitude' => 104.8789,
                'radius' => 60,
                'is_active' => true
            ],
            [
                'name' => 'Warehouse Location',
                'description' => 'Warehouse and logistics center',
                'latitude' => 11.5234,
                'longitude' => 104.8456,
                'radius' => 150,
                'is_active' => true
            ],
            [
                'name' => 'Remote Work Hub',
                'description' => 'Co-working space for remote workers',
                'latitude' => 11.5678,
                'longitude' => 104.9543,
                'radius' => 80,
                'is_active' => true
            ],
        ];

        foreach ($zones as $zone) {
            AttendanceZone::create($zone);
        }
    }
}

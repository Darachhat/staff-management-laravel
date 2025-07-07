<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Holiday;
use Carbon\Carbon;

class HolidaySeeder extends Seeder
{
    public function run()
    {
        $currentYear = Carbon::now()->year;

        $holidays = [
            // International Holidays
            ['name' => 'New Year\'s Day', 'date' => "{$currentYear}-01-01", 'description' => 'New Year celebration', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Valentine\'s Day', 'date' => "{$currentYear}-02-14", 'description' => 'Day of love and romance', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'International Women\'s Day', 'date' => "{$currentYear}-03-08", 'description' => 'Celebrating women\'s achievements', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'International Workers\' Day', 'date' => "{$currentYear}-05-01", 'description' => 'International Labor Day', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Children\'s Day', 'date' => "{$currentYear}-06-01", 'description' => 'International Children\'s Day', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Christmas Day', 'date' => "{$currentYear}-12-25", 'description' => 'Christmas celebration', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],

            // Cambodian Holidays
            ['name' => 'Victory Day', 'date' => "{$currentYear}-01-07", 'description' => 'Victory over Khmer Rouge Day', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Meak Bochea Day', 'date' => "{$currentYear}-02-24", 'description' => 'Buddhist holiday (date varies)', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'King\'s Birthday', 'date' => "{$currentYear}-05-14", 'description' => 'His Majesty\'s Birthday', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Royal Plowing Ceremony', 'date' => "{$currentYear}-05-20", 'description' => 'Chattra Meas (date varies)', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Visak Bochea Day', 'date' => "{$currentYear}-05-26", 'description' => 'Buddha\'s Birthday (date varies)', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Queen Mother\'s Birthday', 'date' => "{$currentYear}-06-18", 'description' => 'Her Majesty\'s Birthday', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Constitution Day', 'date' => "{$currentYear}-09-24", 'description' => 'Constitution and Coronation Day', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Commemoration Day', 'date' => "{$currentYear}-10-15", 'description' => 'Commemoration of King Father Norodom Sihanouk', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Independence Day', 'date' => "{$currentYear}-11-09", 'description' => 'Independence from France', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Water Festival Day 1', 'date' => "{$currentYear}-11-13", 'description' => 'Bon Om Touk - Water Festival (date varies)', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Water Festival Day 2', 'date' => "{$currentYear}-11-14", 'description' => 'Bon Om Touk - Water Festival (date varies)', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Water Festival Day 3', 'date' => "{$currentYear}-11-15", 'description' => 'Bon Om Touk - Water Festival (date varies)', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],

            // Company Specific Holidays
            ['name' => 'Company Foundation Day', 'date' => "{$currentYear}-03-15", 'description' => 'Company anniversary celebration', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Team Building Day', 'date' => "{$currentYear}-07-15", 'description' => 'Annual team building event', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Summer Break', 'date' => "{$currentYear}-08-15", 'description' => 'Company summer break', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Year End Party', 'date' => "{$currentYear}-12-30", 'description' => 'Annual year-end celebration', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],

            // Next year holidays (for planning)
            ['name' => 'New Year\'s Day', 'date' => ($currentYear + 1) . "-01-01", 'description' => 'New Year celebration', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Independence Day', 'date' => ($currentYear + 1) . "-11-09", 'description' => 'Independence from France', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
            ['name' => 'Christmas Day', 'date' => ($currentYear + 1) . "-12-25", 'description' => 'Christmas celebration', 'is_recurring' => true, 'recurrence_type' => 'yearly', 'is_active' => true],
        ];

        foreach ($holidays as $holiday) {
            Holiday::create($holiday);
        }
    }
}

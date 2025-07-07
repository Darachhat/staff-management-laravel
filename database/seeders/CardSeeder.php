<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;
use App\Models\Employee;
use Carbon\Carbon;

class CardSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::where('status', 'active')->get();
        $cardTypes = ['rfid', 'nfc', 'barcode'];
        $statuses = ['active', 'inactive', 'blocked', 'lost'];

        foreach ($employees as $employee) {
            // Each employee gets 1-2 cards (current and maybe an old one)
            $numberOfCards = rand(1, 2);

            for ($i = 0; $i < $numberOfCards; $i++) {
                $issuedDate = Carbon::parse($employee->hire_date)->addDays(rand(0, 30));
                $expiryDate = $issuedDate->copy()->addYears(2);

                // First card is always active, second might be inactive/lost
                $cardStatus = $i === 0 ? 'active' : $statuses[array_rand($statuses)];

                // Generate unique card number
                $cardNumber = 'CARD-' . str_pad($employee->id, 4, '0', STR_PAD_LEFT) . '-' . str_pad($i + 1, 2, '0', STR_PAD_LEFT);

                Card::create([
                    'employee_id' => $employee->id,
                    'card_number' => $cardNumber,
                    'card_type' => $cardTypes[array_rand($cardTypes)],
                    'issued_date' => $issuedDate->format('Y-m-d'),
                    'expiry_date' => $expiryDate->format('Y-m-d'),
                    'status' => $cardStatus,
                    'notes' => $cardStatus !== 'active' ? 'Previous card - ' . ucfirst($cardStatus) : null,
                ]);
            }
        }
    }
}

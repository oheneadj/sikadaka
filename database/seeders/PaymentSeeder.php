<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 2000 contributions
        Payment::factory()->count(2000)->state(['payment_type' => 'CONTRIBUTION'])->create();
        // Create 500 donations
        Payment::factory()->count(500)->state(['payment_type' => 'DONATION'])->create();
    }
}

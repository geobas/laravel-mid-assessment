<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\PaymentGateway;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentGateway::factory()->create([
            'name' => 'Credit Card',
        ]);

        PaymentGateway::factory()->create([
            'name' => 'Debit Card',
        ]);

        PaymentGateway::factory()->create([
            'name' => 'PayPal',
        ]);
    }
}

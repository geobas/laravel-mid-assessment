<?php

use App\Enums\OrderStatus;
use App\Enums\TransactionStatus;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentGateway;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->constrained();
            $table->foreignIdFor(Order::class)->constrained();
            $table->foreignIdFor(PaymentGateway::class)->constrained();
            $table->string('code')->nullable();
            $table->enum('status', TransactionStatus::fetchValues())->default(TransactionStatus::PENDING->value); // values are fetched from TransactionStatus enum class
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

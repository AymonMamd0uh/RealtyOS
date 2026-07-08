<?php

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
        Schema::create('payment_transactions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('subscription_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('provider')
                ->default('paymob');

            $table->string('provider_transaction_id')
                ->unique();

            $table->string('provider_order_id')
                ->nullable();

            $table->string('merchant_order_id')
                ->nullable();

            $table->decimal('amount', 12, 2);

            $table->string('currency', 10)
                ->default('EGP');

            $table->string('status');

            $table->json('payload')
                ->nullable();

            $table->timestamp('paid_at')
                ->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
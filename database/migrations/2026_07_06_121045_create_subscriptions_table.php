<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('plan_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('status', [
                'trial',
                'active',
                'expired',
                'cancelled',
            ])->default('trial');

            $table->timestamp('trial_ends_at')->nullable();

            $table->timestamp('starts_at')->nullable();

            $table->timestamp('ends_at')->nullable();

            $table->timestamp('cancelled_at')->nullable();

            // Stripe أو Paymob
            $table->string('provider')->nullable();

            $table->string('provider_subscription_id')->nullable();

            $table->boolean('is_lifetime')->default(false);

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {

            $table->string('provider_transaction_id')
                ->nullable()
                ->after('provider_subscription_id');

            $table->string('provider_order_id')
                ->nullable()
                ->after('provider_transaction_id');

            $table->string('provider_intention_id')
                ->nullable()
                ->after('provider_order_id');

            $table->decimal('paid_amount', 12, 2)
                ->nullable()
                ->after('provider_intention_id');

            $table->string('paid_currency', 10)
                ->nullable()
                ->after('paid_amount');

            $table->timestamp('paid_at')
                ->nullable()
                ->after('paid_currency');
        });
    }

    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {

            $table->dropColumn([
                'provider_transaction_id',
                'provider_order_id',
                'provider_intention_id',
                'paid_amount',
                'paid_currency',
                'paid_at',
            ]);
        });
    }
};
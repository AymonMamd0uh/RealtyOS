<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->timestamp('subscription_expiring_notified_at')
                ->nullable();

            $table->timestamp('subscription_expired_notified_at')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'subscription_expiring_notified_at',
                'subscription_expired_notified_at',
            ]);
        });
    }
};
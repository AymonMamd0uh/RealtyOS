<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {

            $table->timestamp('follow_up_due_notified_at')
                ->nullable()
                ->after('follow_up_completed');

            $table->timestamp('follow_up_overdue_notified_at')
                ->nullable()
                ->after('follow_up_due_notified_at');

        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {

            $table->dropColumn([
                'follow_up_due_notified_at',
                'follow_up_overdue_notified_at',
            ]);

        });
    }
};
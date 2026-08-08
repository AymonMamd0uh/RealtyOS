<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->string('owner_name')->nullable()->after('description');
            $table->string('owner_phone')->nullable()->after('owner_name');
            $table->string('owner_email')->nullable()->after('owner_phone');

            $table->string('group_name')->nullable()->after('stage_id');
            $table->string('building_number')->nullable()->after('group_name');
            $table->string('unit_number')->nullable()->after('building_number');

            $table->text('internal_notes')->nullable()->after('status');

        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->dropColumn([
                'owner_name',
                'owner_phone',
                'owner_email',
                'group_name',
                'building_number',
                'unit_number',
                'internal_notes',
            ]);

        });
    }
};
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
    Schema::table('leads', function (Blueprint $table) {

        // Budget
        $table->decimal('budget_min', 15, 2)->nullable()->after('property_id');
        $table->decimal('budget_max', 15, 2)->nullable()->after('budget_min');

        // Preferred Location
        $table->foreignId('city_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->foreignId('area_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->foreignId('compound_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        // Property Requirements
        $table->string('property_type')->nullable();

        $table->unsignedTinyInteger('bedrooms')->nullable();
        $table->unsignedTinyInteger('bathrooms')->nullable();

        $table->unsignedInteger('min_area')->nullable();
        $table->unsignedInteger('max_area')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('leads', function (Blueprint $table) {

        $table->dropConstrainedForeignId('city_id');
        $table->dropConstrainedForeignId('area_id');
        $table->dropConstrainedForeignId('compound_id');

        $table->dropColumn([
            'budget_min',
            'budget_max',
            'property_type',
            'bedrooms',
            'bathrooms',
            'min_area',
            'max_area',
        ]);
    });
}
};

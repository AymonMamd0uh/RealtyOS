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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            // Company & Agent
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Reference
            $table->string('reference_number')->unique();

            // Basic Info
            $table->string('title');
            $table->text('description')->nullable();

            // Enums
            $table->string('property_type');
            $table->string('listing_type');

            // Location
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->foreignId('area_id')->constrained()->cascadeOnDelete();

            $table->foreignId('compound_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('stage_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Pricing
            $table->decimal('price', 15, 2);

            // Specs
            $table->decimal('built_area', 10, 2)->nullable();
            $table->decimal('land_area', 10, 2)->nullable();

            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();

            $table->unsignedSmallInteger('floor_number')->nullable();

            $table->boolean('is_furnished')->default(false);

            // Status
            $table->string('status')->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};

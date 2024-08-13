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
        Schema::create('practitioner_age_range', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('practitioners');
            $table->foreignId('age_range_id')->constrained('age_ranges');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practitioner_age_ranges');
    }
};
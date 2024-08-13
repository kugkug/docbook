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
        Schema::create('practitioner_focus_area', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('practitioners');
            $table->foreignId('focus_area_id')->constrained('focus_areas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practitioner_focus_areas');
    }
};
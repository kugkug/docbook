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
        Schema::create('practitioner_specialties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->constrained('practitioners');
            $table->bigInteger('specialty_type_id')->constrained('specialty_types');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practitioner_specialties');
    }
};
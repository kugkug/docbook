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
        Schema::create('practitioner_modality', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('practitioners');
            $table->foreignId('visit_reason_id')->constrained('modalities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practitioner_modalities');
    }
};
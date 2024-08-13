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
        Schema::create('practitioner_educations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable()->constrained('practitioners');
            $table->string('institution_name')->nullable();
            $table->string('degree_credential_etc')->nullable();
            $table->string('acquired_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practitioner_educations');
    }
};
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
        Schema::create('practitioner_faiths', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("parent_id")->constrained('practitioners');
            $table->bigInteger("faith_id")->constrained('faiths');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practitioner_faiths');
    }
};
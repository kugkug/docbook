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
        Schema::create('license_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('license_type_id')->constrained('license_types');
            $table->string('license_number')->nullable();
            $table->string('state')->nullable();
            $table->date('expiration_date')->nullable();
            $table->bigInteger('parent_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_details');
    }
};
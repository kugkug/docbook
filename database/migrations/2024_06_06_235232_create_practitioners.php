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
        Schema::create('practitioners', function (Blueprint $table) {
            $table->id();
            $table->string('profile_photo_url')->nullable();
            $table->string('practioner_signature_url')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('npi_number')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('ext')->nullable();
            $table->string('fax')->nullable();
            $table->string('birthdate')->nullable();
            $table->bigInteger('gender')->nullable();
            $table->string('profile_type');
            $table->bigInteger('professional_suffix')->nullable();
            $table->string('practice_website')->nullable();
            $table->bigInteger('faith')->nullable();
            $table->foreignId('creator_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practitioners');
    }
};
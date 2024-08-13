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
        Schema::create('accepted_visits', function (Blueprint $table) {
            $table->id();
            $table->boolean('video_visit')->unsigned()->nullable();
            $table->boolean('in_person_visit')->unsigned()->nullable();
            $table->bigInteger('parent_id')->nullable()->constrained('practitioners');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accepted_visits');
    }
};
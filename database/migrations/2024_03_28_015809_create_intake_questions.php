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
        Schema::create('intake_questions', function (Blueprint $table) {
            $table->id();
            $table->string("code")->nullable();
            $table->text("question");
            $table->integer("sort_order");
            $table->boolean("is_multiple_choice");
            $table->boolean("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intake_questions');
    }
};

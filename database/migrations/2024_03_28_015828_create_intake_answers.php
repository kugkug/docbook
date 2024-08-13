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
        Schema::create('intake_answers', function (Blueprint $table) {
            $table->id();
            $table->string("question_code")->nullable();
            $table->string("answer")->nullable();
            $table->integer("sort_order");
            $table->string("next_question_code")->nullable();
            $table->boolean("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intake_answers');
    }
};

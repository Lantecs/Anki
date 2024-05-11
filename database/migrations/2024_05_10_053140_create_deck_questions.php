<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deck_questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->unsignedBigInteger('user_deck_id');
            $table->foreign('user_deck_id')->references('user_deck_id')->on('user_deck');
            $table->string('front');
            $table->string('back');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deck_questions');
    }
};

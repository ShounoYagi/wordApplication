<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_question', function (Blueprint $table) {
            $table->id();
            $table->string('QuestionText');
            $table->string('Answer');
            $table->string('Category1', 100)->nullable();
            $table->string('Category2', 100)->nullable();
            $table->string('Category3', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_question');
    }
}

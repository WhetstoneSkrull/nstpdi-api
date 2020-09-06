<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_exercises', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('exercise_name');
            $table->text('exercise_link')->unique();
            $table->string('pic')->nullable();
            $table->string('batch')->nullable();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->float('training_fee')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('training_exercises');
    }
}

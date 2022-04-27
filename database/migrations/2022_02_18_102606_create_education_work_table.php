<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_work', function (Blueprint $table) {
            $table->id();
            $table->string('highschool')->nullable();
            $table->string('college')->nullable();
            $table->string('training_institute')->nullable();
            $table->string('additional_educational')->nullable();
            $table->string('job_experiences')->nullable();
            $table->string('relevant_skills')->nullable();
            $table->string('position_apply')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('education_work');
    }
}

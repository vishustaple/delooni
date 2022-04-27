<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('requirement');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->date('date');
            $table->string('start_time')->comment("09:00:00");
            $table->string('end_time')->comment("11:00:00");
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('rescheduled_at')->nullable();
            $table->tinyInteger('status')->default(1)->comment('accepted,decline,resheduled');
            $table->tinyInteger('type')->default(1);
            $table->foreignId('assign_to')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->index(['title', 'status']);
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
        Schema::dropIfExists('jobs');
    }
}

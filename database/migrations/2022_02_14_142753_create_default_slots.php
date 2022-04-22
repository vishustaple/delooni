<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultSlots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_slots', function (Blueprint $table) {
            $table->id();
            $table->time('start_time')->comment("in time format");
            $table->time('end_time')->comment("in time format");
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('type')->default(1);
            $table->index(['start_time', 'end_time']);
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
        Schema::dropIfExists('default_slots');
    }
}

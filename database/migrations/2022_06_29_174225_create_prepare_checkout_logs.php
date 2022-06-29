<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrepareCheckoutLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prepare_checkout_logs', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->longText('description');
            $table->string('buildnumaber');
            $table->string('timestamp');
            $table->string('ndc');
            $table->string('checkout_id');
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
        Schema::dropIfExists('prepare_checkout_logs');
    }
}

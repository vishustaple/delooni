<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_details', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('servie_id');
            $table->foreign('servie_id')->references('id')->on('services')->onDelete('cascade');

            $table->double('price_per_hour')->default(0.00);
            $table->double('price_per_day')->default(0.00);
            $table->double('price_per_month')->default(0.00);
            $table->string('currency', 10)->nullable();
            $table->boolean('status')->default(1)->comment("0=> inactive, 1=> active");

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('service_details');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longtext('description')->nullable();
            $table->integer('status')->default(1)->comment("1=> active, 2=>inactive");
            $table->string('service_image')->nullable();
            $table->float('price_per_hour')->nullable();
            $table->float('price_per_day')->nullable();
            $table->float('price_per_month')->nullable();
            $table->unsignedBigInteger('service_category_id');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('services');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}

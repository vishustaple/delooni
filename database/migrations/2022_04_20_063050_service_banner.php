<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServiceBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_banners', function (Blueprint $table) {
               $table->id();
               $table->string("service_banner_image");
               $table->integer('status')->default(1)->comment("1=> active, 2=>inactive");
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
        Schema::dropIfExists('service_banners');   
    }
}

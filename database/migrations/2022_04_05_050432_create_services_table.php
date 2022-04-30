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
            $table->string('title');
            $table->longtext('description')->nullable();
            $table->string('service_image')->nullable();
            $table->integer("cat_id");
            $table->integer("sub_cat_id");
            $table->double('price_per_hour')->default(0.00);
            $table->double('price_per_day')->default(0.00);
            $table->double('price_per_month')->default(0.00);
            $table->string('currency', 10)->nullable();
            $table->integer('status')->default(1)->comment("1=> active, 2=>inactive");
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('services');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}

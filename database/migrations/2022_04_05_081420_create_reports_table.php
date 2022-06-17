<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->enum('reporting_issue',['inquiries', 'support request']);
            
            $table->integer('service_category_id');
            $table->integer('subcategory_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('service_provider_id');
            $table->foreign('service_provider_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('subject');
            $table->longtext('message');

            $table->boolean('status')->default(1)->comment("0=> closed, 1=> open");
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
        Schema::dropIfExists('reports');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->longText('message');
            $table->foreignId('to_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('from_user')->constrained('users')->onDelete('cascade');
            $table->boolean('status')->default(0);
            $table->boolean('read')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('contact_us');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

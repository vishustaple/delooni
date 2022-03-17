<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique();

            $table->string('dob')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('country')->nullable();
            

            $table->string('spoken_language')->nullable()->comment("Drop down");
            $table->string('other_spoken_language')->nullable()->comment("input");
            $table->string('primary_mode_of_transport')->nullable()->comment("select box");
            $table->string('experience')->nullable();
            $table->integer('travel_distance')->nullable();
            $table->string('earliest_start_date')->nullable();
            $table->string('aspire_to_achieve')->nullable()->comment("What do you aspire to achieve with an experience from Thorough?");
            $table->text('hobbies')->nullable();
            $table->text('long_term_goal')->nullable();
            $table->string('goal')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('is_notification')->default(1);
            $table->integer('role_id')->default(0);
            $table->integer('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('form_step')->default(1);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

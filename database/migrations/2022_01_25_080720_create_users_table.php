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
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->string('password');
            $table->string('nationality')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('country')->nullable();
            $table->string('counry_code')->nullable()->comment('eg. +91, +62 etc');
            $table->string('country_short_code')->nullable()->comment("eg. 'gb', 'in', 'us', etc");
            $table->string('spoken_language')->nullable()->comment("Drop down");
            $table->string('other_spoken_language')->nullable()->comment("input");
            $table->string('primary_mode_of_transport')->nullable()->comment("select box");
            $table->enum('service_provider_type', ['default', 'individual','company'])->default('default')->comment("default => it might be customer, guest but not service provider.");
            // $table->string('experience')->nullable();
            // $table->integer('travel_distance')->nullable();
            // $table->string('earliest_start_date')->nullable();
            // $table->string('aspire_to_achieve')->nullable()->comment("What do you aspire to achieve with an experience from Thorough?");
            // $table->text('hobbies')->nullable();
            // $table->text('long_term_goal')->nullable();
            // $table->string('goal')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->boolean('is_notification')->default(1)->comment("0=> inactive, 1=> active");
            $table->integer('status')->default(1)->comment("0=> inactive, 1=> active, 3=>disabled, 4=>blacklist");
            $table->integer('created_by')->nullable();
            $table->string('currency', 10)->nullable();
            $table->boolean('email_verified')->default(0)->comment("0=>not verified, 1=>verified");
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('form_step')->default(1)->comment("0=>all form step completed, the value (1, 2 etc) stands for from no has to be submitted.");
            
            # socials
            $table->integer('whatspp_no')->nullable();
            $table->string('snapchat_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            
            
            $table->string('license_cr_no')->nullable();
            $table->string('license_cr_photo')->nullable();
            $table->longtext('description')->nullable();
            $table->rememberToken();
            // $table->timestamps();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
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
        Schema::dropIfExists('users');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

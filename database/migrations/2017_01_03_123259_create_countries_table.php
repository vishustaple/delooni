<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_name');
            $table->string('iso3',3)->nullable();
            $table->string('numeric_code',3)->nullable();
            $table->string('short_name',2)->nullable();
            $table->string('currency_code')->nullable();
            $table->string('capital')->nullable();
            $table->string('country_code')->nullable();
            $table->string('currency_name')->nullable();
            $table->string('symbol')->nullable(); 
            $table->string('tld')->nullable(); 
            $table->string('native')->nullable(); 
            $table->string('region')->nullable(); 
            $table->string('subregion')->nullable(); 
            $table->text('timezones')->nullable(); 
            $table->text('translations')->nullable(); 
            $table->double('latitude', 10, 8)->nullable();
            $table->double('longitude', 11, 8)->nullable();
            $table->string('emoji')->nullable(); 
            $table->string('emojiU')->nullable(); 
            $table->tinyInteger('flag')->nullable();
            $table->boolean('status')->default(0);           
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
        Schema::dropIfExists('countries');
    }
}

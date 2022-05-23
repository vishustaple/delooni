<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string("plan_name");
            $table->longtext("description")->nullable();
            $table->string("validity")->nullable();
            $table->integer("price_per_plan");
            $table->integer("user_type")->default(0)->comment("1=> customer, 2=>spindividual,3=>spcompany");
            $table->integer("plan_type")->default(0)->comment("1=> adsplan, 2=>boostplan,3=>appaccessplan");
            $table->integer('status')->default(1)->comment("1=> active, 0=>inactive");
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
        Schema::dropIfExists('subscriptions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPrepareCheckout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prepare_checkout_logs', function (Blueprint $table) {
            $table->string('amount')->after('user_id');
            $table->string('payment_type')->after('amount');
            $table->string('testmode')->after('payment_type');
            $table->string('merchant_transaction_id')->after('testmode');
            $table->string('customer_email')->after('merchant_transaction_id');
            $table->string('billing_street1')->after('customer_email');
            $table->string('billing_city')->after('billing_street1');
            $table->string('billing_state')->after('billing_city');
            $table->string('billing_country')->after('billing_state');
            $table->string('billing_postcode')->after('billing_country');
            $table->string('customer_givenname')->after('billing_postcode');
            $table->string('customer_surname')->after('customer_givenname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prepare_checkout_logs', function (Blueprint $table) {
            //
        });
    }
}

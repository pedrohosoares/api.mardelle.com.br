<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrayothersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trayothers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned()->index();
            $table->bigInteger('customer_id')->unsigned()->index();
            $table->decimal('total',8,2)->nullable();
            $table->decimal('partial_total',8,2);
            $table->date('date')->nullable();
            $table->string('payment_form')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('access_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('status')->nullable();
            $table->text('json');
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
        Schema::table('trayothers',function(Blueprint $table){
            $table->dropForeign('trayothers_traycustomer_id_foreign');
        });
        Schema::dropIfExists('trayothers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrayaddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trayaddress', function (Blueprint $table) {
            $table->id();
            $table->string('zip_code')->index();
            $table->string('city');
            $table->string('state');
            $table->string('neighborhood');
            $table->string('country');
            $table->text('json');
            $table->bigInteger('customer_id')->unsigned()->index();
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
        Schema::table('trayaddress',function(Blueprint $table){
            $table->dropForeign('trayaddress_traycustomer_id_foreign');
        });
        Schema::dropIfExists('trayaddress');
    }
}

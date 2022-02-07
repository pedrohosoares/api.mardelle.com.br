<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_averages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('average_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('average_id')->references('id')->on('averages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_averages',function(Blueprint $table){
            $table->dropForeign('user_averages_user_id_foreign');
            $table->dropForeign('user_averages_average_id_foreign');
        });
        Schema::dropIfExists('user_averages');
    }
}

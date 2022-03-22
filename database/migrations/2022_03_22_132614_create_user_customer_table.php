<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_customer', function (Blueprint $table) {
           
            $table->integer('user_id')->unsigned()->index();
            // $table->foreign('user_id')->references('id')->on('users');
            $table->integer('customer_id')->unsigned()->index();
            // $table->foreign('customer_id')->references('id')->on('users');
            $table->primary(['user_id', 'customer_id']);
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
        Schema::dropIfExists('user_customer');
    }
}

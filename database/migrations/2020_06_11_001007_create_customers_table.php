<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstName');
            $table->String('lastName');
            $table->String('email');
            $table->string('Address');
            $table->string('City');
            $table->string('Province');
            $table->string('PostalCode');
            $table->string('shipping_Address');
            $table->string('shipping_City');
            $table->string('shipping_Province');
            $table->string('shipping_PostalCode');
            $table->string('Phone');
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
        Schema::dropIfExists('customers');
    }
}

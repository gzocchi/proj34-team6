<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            // "parte order"
            $table->id(); // order id
            $table->float('price', 6, 2);
            $table->boolean('paid');
            // "parte customer"
            $table->string('customer_name', 60);
            $table->string('customer_address');
            $table->string('customer_telephone', 50);
            $table->string('customer_mail', 100);

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
        Schema::dropIfExists('orders');
    }
}

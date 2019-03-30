<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            //$table->integer('order_id')->nullable()->unsigned();
            $table->integer('book_id')->nullable()->unsigned();
            $table->integer('magazin_id')->nullable()->unsigned();
            $table->date('date')->nullable();
            $table->integer('qty');
            $table->integer('qty_m');//from indexcontr click buy
            $table->integer('status_paied')->default(0);
            $table->integer('book_or_mag')->default(0);// top5 sort
            $table->float('price')->default(0);
            $table->timestamps();
        });
        Schema::table('orders_products', function (Blueprint $table) {
            
           $table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('order_id')->references('id')->on('orders');//oplata zapishet id ordera
           //
            $table->foreign('book_id')->references('id')->on('books');
           // 
            $table->foreign('magazin_id')->references('id')->on('magazins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_products');
    }
}

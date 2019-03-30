<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMagazinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('magazins', function (Blueprint $table) {
            
            $table->integer('orders_product_id')->nullable()->unsigned();   
        });

        Schema::table('magazins', function (Blueprint $table) {
            
            $table->foreign('orders_product_id')->references('id')->on('orders_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNextOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('book_id')->nullable()->unsigned();
            $table->integer('magazin_id')->nullable()->unsigned();
       
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books');
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
        //
    }
}

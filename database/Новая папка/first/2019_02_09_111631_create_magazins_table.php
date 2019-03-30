<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagazinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazins', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('category_id')->nullable();
            $table->string('slug');
            $table->string('name');
            $table->string('autor');
            $table->integer('number_per_year')->nullable();
            $table->integer('year')->nullable();
            $table->integer('number')->nullable();
            $table->integer('size');
            $table->float('price')->default(0);
            $table->float('sub_price')->default(0);
            $table->float('old_price')->default(0);
            $table->enum('status', ['0', '1']);
            $table->string('img')->default('no_image.jpg');
            $table->enum('hit_magazin', ['0', '1']);
            $table->integer('discont_privat')->nullable();
            $table->timestamps();
            $table->integer('user_id')->nullable()->unsigned();            
            $table->integer('orders_product_id')->nullable()->unsigned();
        });

        Schema::table('magazins', function (Blueprint $table) {
            
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('orders_product_id')->references('id')->on('orders_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazins');
    }
}

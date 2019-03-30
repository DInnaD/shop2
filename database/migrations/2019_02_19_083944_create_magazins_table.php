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
            $table->integer('user_id')->nullable()->unsigned();
            $table->tinyInteger('category_id')->nullable();//extra
            $table->string('slug')->default(0);//extra
            $table->string('name')->default(0);
            $table->integer('page')->nullable();
            $table->string('autor');
            $table->integer('number_per_year')->nullable();
            $table->integer('year')->nullable();
            $table->integer('number')->nullable();
            $table->integer('size');
            $table->float('price')->default(0);
            $table->float('sub_price')->default(0);
            $table->float('old_price')->default(0);//extra
            $table->string('img')->default('no_image.jpg');
            $table->integer('discont_global')->nullable();
            $table->integer('status')->default(0);//is_magazin_or_book
            $table->integer('hit_magazin')->default(0);//top of views
            $table->timestamps();
            $table->integer('discont_privat')->nullable(); //on/of user privat global discont
        });

        Schema::table('magazins', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users');
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

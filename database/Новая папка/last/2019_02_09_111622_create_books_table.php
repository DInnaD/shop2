<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('category_id')->nullable();
            $table->string('slug')->default(0);
            $table->string('name')->default(0);
            $table->string('autor');
            $table->integer('page')->nullable();
            $table->integer('year')->nullable();
            $table->integer('is_hard')->default(0);
            $table->string('kindof');
            $table->integer('size');
            $table->float('price')->default(0);
            $table->float('old_price')->default(0);
            $table->integer('status');
            $table->string('img')->default('no_image.jpg');
            $table->integer('hit_book');
            $table->integer('discont_privat')->nullable();
            $table->timestamps();
            $table->integer('user_id')->nullable()->unsigned();
        });
        Schema::table('books', function (Blueprint $table) {
            
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
        Schema::dropIfExists('books');
    }
}

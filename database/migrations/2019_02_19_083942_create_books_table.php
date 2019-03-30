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
            $table->integer('user_id')->nullable()->unsigned();
            $table->tinyInteger('category_id')->nullable();//extra
            $table->string('slug')->default(0);//extra
            $table->string('name')->default(0);
            $table->string('author_name')->nullable();
            $table->integer('page')->nullable();
            $table->string('autor')->nullable();
            $table->integer('year')->nullable();
            $table->integer('is_hard')->default(0);//html checkbox
            $table->boolean('is_hard_hard')->default(0);//laravel checkbox
            $table->string('kindof');
            $table->integer('size');
            $table->float('price')->default(0);
            $table->float('old_price')->default(0);//extra
            $table->string('img')->default('no_image.jpg');
            $table->integer('discont_global')->nullable();
            $table->integer('status')->default('1');//is_book_or_magazin
            $table->integer('hit_book')->default(0);//top of views 
            $table->timestamps();
            $table->integer('discont_privat')->default(0);//on/of user privat global discont
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_histories', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->unsignedBigInteger('book_id');
            $table->integer('qty');
            $table->integer('type');
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('book_histories')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_histories');
    }
}

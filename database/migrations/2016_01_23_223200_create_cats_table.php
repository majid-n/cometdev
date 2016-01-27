<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 80);
            $table->integer('parent')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->index('id');
            $table->index('parent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cats');
    }
}

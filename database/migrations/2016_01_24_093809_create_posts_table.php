<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 80);
            $table->text('description');
            $table->text('smalldescription');
            $table->string('link', 255)->nullable();
            $table->integer('parent');
            $table->string('thumb', 100);
            $table->string('image', 100);
            $table->integer('views')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}

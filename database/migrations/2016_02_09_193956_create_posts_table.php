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
        Schema::create('cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 80);
            $table->integer('parent')->unsigned()->index();
            $table->timestamps();
            $table->softDeletes();
            
            $table->engine = 'InnoDB';
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 80);
            $table->text('description');
            $table->text('smalldescription');
            $table->string('link', 255)->nullable();
            $table->integer('cat_id')->unsigned();
            $table->string('thumb', 100);
            $table->string('image', 100);
            $table->integer('views')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cat_id')
                  ->references('id')->on('cats')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->engine = 'InnoDB';
        });

        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->timestamps();
            $table->foreign('post_id')
                  ->references('id')->on('posts')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('likes');
        Schema::drop('posts');
        Schema::drop('cats');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname', 150);
            $table->string('email', 150);
            $table->string('tel', 15);
            $table->text('description');
            $table->string('ip', 20);
            $table->text('replymsg')->nullable();
            $table->tinyInteger('seen')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
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
        Schema::drop('supports');
    }
}

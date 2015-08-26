<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
	        $table->increments('id');
	        $table->integer('from_userid')->unsigned();
	        $table->integer('to_userid')->unsigned();
	        $table->string('title');
	        $table->boolean('seen')->default(0);
	        $table->string('link')->nullable();
	        $table->timestamps();

	        $table->foreign('from_userid')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
	        $table->foreign('to_userid')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notifications');
    }
}

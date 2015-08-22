<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_members', function (Blueprint $table) {
	        $table->integer('user_id')->unsigned()->index();
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

	        $table->integer('task_id')->unsigned()->index();
	        $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');

	        $table->boolean('accepted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task_members');
    }
}

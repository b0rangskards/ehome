<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
	        $table->increments('id');
	        $table->integer('household_id')->unsigned();
	        $table->integer('parent_id')->unsigned()->nullable();
	        $table->string('name');
	        $table->string('slug');
	        $table->text('description')->nullable();
	        $table->datetime('due_at')->nullable();
	        $table->string('recurring_at')->nullable();
	        $table->tinyInteger('priority')->default(1); // task priority default to important
	        $table->string('image')->nullable();
	        $table->string('status', 15)->default('pending');
	        $table->softDeletes();
	        $table->timestamps();

	        $table->foreign('parent_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
	        $table->foreign('household_id')->references('id')->on('households')->onDelete('cascade')->onUpdate('cascade');
        });

	    DB::statement('ALTER TABLE tasks ADD coordinates POINT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}

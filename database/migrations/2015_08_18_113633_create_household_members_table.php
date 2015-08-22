<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseholdMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('household_members', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('household_id')->unsigned();
	        $table->integer('user_id')->unsigned();
	        $table->softDeletes();

	        $table->foreign('household_id')->references('id')->on('households')->onDelete('cascade')->onUpdate('cascade');
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('household_members');
    }
}

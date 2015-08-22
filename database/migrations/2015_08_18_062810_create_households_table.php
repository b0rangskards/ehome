<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseholdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('households', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('head_id')->unsigned();
	        $table->string('address');
	        $table->softDeletes();
            $table->timestamps();

	        $table->foreign('head_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

	    DB::statement('ALTER TABLE households ADD coordinates POINT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('households');
    }
}

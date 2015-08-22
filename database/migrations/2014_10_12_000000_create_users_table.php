<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname', 100);
	        $table->string('lastname', 100);
	        $table->char('middleinitial')->nullable();
	        $table->string('gender', 6)->default('male');
	        $table->string('mobile_no', 20)->nullable();
	        $table->string('email')->unique();
            $table->string('password', 60);
	        $table->tinyInteger('role');
	        $table->string('activation_code', 30)->nullable();
	        $table->timestamp('activated_at')->nullable();
	        $table->timestamp('last_login')->nullable();
            $table->rememberToken();
	        $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

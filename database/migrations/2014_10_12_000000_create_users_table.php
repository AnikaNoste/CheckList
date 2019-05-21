<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
		//$numberList = Config::get('admin.numberList');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
			$table->string('role')->default('0');
			$table->integer('numberlList')->default(6);
			$table->boolean('block')->default(true); 
            $table->rememberToken();
            $table->timestamps();
        });
    }
	
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

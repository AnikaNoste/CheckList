<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckListTable extends Migration
{
    public function up()
    {
        Schema::create('checkList', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('userId');
			$table->string('titleList', 100); 	
			$table->boolean('status')->default(false); 
            $table->timestamps();			
        });
    }

    public function down()
    {
        Schema::dropIfExists('checkList');
    }
}

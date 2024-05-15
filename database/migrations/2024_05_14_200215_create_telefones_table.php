<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

	public function up()
	{
		Schema::create('telefones', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('ddd', 2);
            $table->string('numero', 9);
            $table->timestamps();
            $table->softDeletes();
		});
	}


	public function down()
	{
		Schema::drop('telefones');
	}
};

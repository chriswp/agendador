<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

	public function up()
	{
		Schema::create('tarefa_status', function(Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('descricao', 200);
            $table->timestamps();
            $table->softDeletes();
		});
	}


	public function down()
	{
		Schema::drop('tarefa_status');
	}
};

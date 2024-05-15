<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tarefas', function(Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('titulo', 60);
            $table->string('descricao', 200);
            $table->date('data_fim')->nullable();
            $table->bigInteger('tarefa_status_id')->default(1);
            $table->bigInteger('usuario_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(['tarefa_status_id'])->references(['id'])->on('tarefa_status');
            $table->foreign(['usuario_id'])->references(['id'])->on('usuarios');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tarefas');
	}
};

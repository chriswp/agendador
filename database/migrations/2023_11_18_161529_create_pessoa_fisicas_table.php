<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up()
    {
        Schema::create('pessoas_fisicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pessoa_id');
            $table->string('cpf', 11)->unique();
            $table->date('data_nascimento')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign(['pessoa_id'])->references(['id'])->on('pessoas');
        });
    }

    public function down()
    {
        Schema::drop('pessoas_fisicas');
    }
};

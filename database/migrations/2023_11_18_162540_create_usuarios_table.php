<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pessoa_fisica_id');
            $table->integer('usuario_nivel_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('ativo')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(['pessoa_fisica_id'])->references(['id'])->on('pessoas_fisicas');
            $table->foreign(['usuario_nivel_id'])->references(['id'])->on('usuario_niveis');
        });
    }


    public function down()
    {
        Schema::drop('usuarios');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('pessoa_telefone', function (Blueprint $table) {
            $table->bigInteger('pessoa_id');
            $table->bigInteger('telefone_id');

            $table->foreign(['pessoa_id'])->references(['id'])->on('pessoas');
            $table->foreign(['telefone_id'])->references(['id'])->on('telefones');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pessoa_telefone');
    }
};

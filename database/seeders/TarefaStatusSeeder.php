<?php

namespace Database\Seeders;

use App\Models\PessoaFisica;
use App\Models\TarefaStatus;
use Illuminate\Database\Seeder;

class TarefaStatusSeeder extends Seeder
{
    public function run(): void
    {
        if (!TarefaStatus::exists()) {
            TarefaStatus::create([
                'id' => 1,
                'descricao' => 'pendente',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            TarefaStatus::create([
                'id' => 2,
                'descricao' => 'concluído',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

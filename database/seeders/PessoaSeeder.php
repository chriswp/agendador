<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use Illuminate\Database\Seeder;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Pessoa::exists()) {
            Pessoa::create([
                'nome' => 'Administrador EasyJur',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Pessoa::create([
                'nome' => 'Usuário Teste',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

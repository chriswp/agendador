<?php

namespace Database\Seeders;

use App\Models\PessoaFisica;
use Illuminate\Database\Seeder;

class PessoaFisicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!PessoaFisica::exists()) {
            PessoaFisica::create([
                'pessoa_id' => 1,
                'cpf' => '49703704000',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            PessoaFisica::create([
                'pessoa_id' => 2,
                'cpf' => '67397725090',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

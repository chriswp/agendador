<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UsuarioNivelSeeder::class]);
        $this->call([TarefaStatusSeeder::class]);
        $this->call([PessoaSeeder::class]);
        $this->call([PessoaFisicaSeeder::class]);
        $this->call([UsuarioSeeder::class]);
    }
}

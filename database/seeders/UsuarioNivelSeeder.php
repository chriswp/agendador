<?php

namespace Database\Seeders;

use App\Models\UsuarioNivel;
use Illuminate\Database\Seeder;

class UsuarioNivelSeeder extends Seeder
{
    public function run(): void
    {
        if (!UsuarioNivel::exists()) {
            UsuarioNivel::create([
                'nome' => 'administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            UsuarioNivel::create([
                'nome' => 'representante',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

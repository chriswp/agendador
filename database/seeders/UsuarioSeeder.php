<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{

    public function run(): void
    {
        if (!Usuario::exists()) {
            Usuario::updateOrCreate([
                'email' => 'easyjur@email.com',
                'password' => 'cI!RoK8k',
                'pessoa_fisica_id' => 1,
                'usuario_nivel_id' => 1,
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Usuario::updateOrCreate([
                'email' => 'christopher.webpg@gmail.com',
                'password' => 'Bi&r72u!',
                'pessoa_fisica_id' => 2,
                'usuario_nivel_id' => 2,
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

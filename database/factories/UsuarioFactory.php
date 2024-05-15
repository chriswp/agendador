<?php

namespace Database\Factories;

use App\Models\PessoaFisica;
use App\Models\UsuarioNivel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioFactory extends Factory
{

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'pessoa_fisica_id' => PessoaFisica::factory(),
            'usuario_nivel_id' => UsuarioNivel::factory(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

}

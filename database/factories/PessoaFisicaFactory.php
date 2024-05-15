<?php

namespace Database\Factories;

use App\Models\Pessoa;
use App\Models\PessoaFisica;
use App\Models\UsuarioNivel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PessoaFisica>
 */
class PessoaFisicaFactory extends Factory
{

    public function definition(): array
    {
        return [
            'pessoa_id' => Pessoa::factory(),
            'cpf' => $this->faker->unique()->numerify('###########'),
            'data_nascimento' => $this->faker->date(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PessoaFactory extends Factory
{

    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
        ];
    }
}

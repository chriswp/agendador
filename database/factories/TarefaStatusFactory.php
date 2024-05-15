<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TarefaStatus>
 */
class TarefaStatusFactory extends Factory
{

    public function definition(): array
    {
        return [
            'descricao' => $this->faker->word(),
        ];
    }
}

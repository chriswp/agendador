<?php

namespace Database\Factories;

use App\Models\TarefaStatus;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class TarefaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(2),
            'descricao' => fake()->sentence(),
            'tarefa_status_id' => TarefaStatus::factory(),
        ];
    }
}

<?php

namespace Tests\Feature\Models;

use App\Models\PessoaFisica;
use App\Models\Tarefa;
use App\Models\TarefaStatus;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TarefaTes extends TestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $usuario = Usuario::factory()->create();
        $status = TarefaStatus::factory()->create();
        $this->actingAs($usuario);
        $dados = [
            'titulo' => 'tarefa',
            'descricao' => 'descricao apenas para teste',
            'tarefa_status_id' => $status->id
        ];

        $tarefa = Tarefa::create($dados);
        $this->assertEquals(1,$tarefa->count());
        $this->assertInstanceOf(Tarefa::class,$tarefa);
        $this->assertDatabaseHas($tarefa->getTable(),$dados);
    }

    public function testIndex()
    {
        $usuario = Usuario::factory()->create();
        $this->actingAs($usuario);
        $tarefas = Tarefa::factory(5)->create();
        $this->assertEquals(5,$tarefas->count());
        $this->assertInstanceOf(Collection::class,$tarefas);
    }

    public function testUpdate()
    {
        $usuario = Usuario::factory()->create();
        $this->actingAs($usuario);
        $dados = [
            'titulo' => 'tarefa update',
            'descricao' => 'descricao apenas para teste',
        ];
        $tarefa = Tarefa::factory()->create();
        $tarefa->update($dados);
        $this->assertInstanceOf(Tarefa::class,$tarefa);
        $this->assertDatabaseHas($tarefa->getTable(),$dados);
    }

    public function testDelete()
    {
        $usuario = Usuario::factory()->create();
        $this->actingAs($usuario);
        $tarefa = Tarefa::factory()->create();
        $remover = $tarefa->delete();
        $this->assertTrue($remover);
    }
}

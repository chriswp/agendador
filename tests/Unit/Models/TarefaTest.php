<?php

namespace Tests\Unit\Models;

use App\Models\Tarefa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use Prettus\Repository\Traits\TransformableTrait;
use Tests\TestCase;

class TarefaTest extends TestCase
{
    private Tarefa $tarefa ;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tarefa =  new Tarefa();
    }


    public function testFillableAttribute()
    {
        $fillable = ['titulo','descricao', 'data_fim','tarefa_status_id','usuario_id'];
        $this->assertEquals($fillable, $this->tarefa->getFillable());
    }

    public function testIfUseTraits()
    {
        $traits = [
            TransformableTrait::class,
            SoftDeletes::class,
            Auditable::class,
            HasFactory::class
        ];
        $traitsTarefa = array_keys(class_uses(Tarefa::class));
        $this->assertEquals($traits, $traitsTarefa);
    }
}

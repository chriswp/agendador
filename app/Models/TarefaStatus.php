<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class TarefaStatus extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    CONST PENDENTE = 1;
    CONST CONCLUIDO = 2;

  protected $table = 'tarefa_status';
    protected $fillable = ['descricao'];

}

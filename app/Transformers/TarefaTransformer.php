<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Tarefa;


class TarefaTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['usuario','status'];

    public function transform(Tarefa $model)
    {
        return [
            'id'         => (int) $model->id,
            'titulo' => $model->titulo,
            'descricao' => $model->descricao,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeUsuario(Tarefa $model)
    {
        $usuario =  $model->usuario;
        if(isset($usuario)){
            return $this->item($usuario, new UsuarioTransformer());
        }

        return null;
    }

    public function includeStatus(Tarefa $model)
    {
        $status =  $model->status;
        if(isset($status)){
            return $this->item($status, new TarefaStatusTransformer());
        }

        return null;
    }
}

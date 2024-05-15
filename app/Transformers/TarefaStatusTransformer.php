<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\TarefaStatus;

class TarefaStatusTransformer extends TransformerAbstract
{

    public function transform(TarefaStatus $model)
    {
        return [
            'id'         => (int) $model->id,
            'descricao' => $model->descricao,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

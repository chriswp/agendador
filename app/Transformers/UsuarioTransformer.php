<?php

namespace App\Transformers;

use App\Models\Usuario;
use League\Fractal\TransformerAbstract;


class UsuarioTransformer extends TransformerAbstract
{

    public function transform(Usuario $model)
    {
        return [
            'id' => (int) $model->id,
            'nome' => $model->pessoaFisica->pessoa->nome,
            'email' => $model->email,
            'nivel' => $model->nivel->nome,
        ];
    }
}

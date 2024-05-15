<?php

namespace App\Criteria;

use App\Models\UsuarioNivel;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class TarefasUsuarioCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        $usuario = auth()->user();
        if ($usuario->usuario_nivel_id == UsuarioNivel::USUARIO) {
            return $model->where('usuario_id', $usuario->id);
        }

        return $model;
    }
}

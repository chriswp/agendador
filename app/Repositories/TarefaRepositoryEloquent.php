<?php

namespace App\Repositories;

use App\Criteria\TarefasUsuarioCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TarefaRepository;
use App\Models\Tarefa;
use App\Validators\TarefaValidator;


class TarefaRepositoryEloquent extends BaseRepository implements TarefaRepository
{

    public function model()
    {
        return Tarefa::class;
    }


    public function validator()
    {
        return TarefaValidator::class;
    }


    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(app(TarefasUsuarioCriteria::class));
    }

}

<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TarefaStatusRepository;
use App\Models\TarefaStatus;
use App\Validators\TarefaStatusValidator;

/**
 * Class TarefaStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TarefaStatusRepositoryEloquent extends BaseRepository implements TarefaStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TarefaStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TarefaStatusValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

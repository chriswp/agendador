<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TelefoneRepository;
use App\Models\Telefone;
use App\Validators\TelefoneValidator;

/**
 * Class TelefoneRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TelefoneRepositoryEloquent extends BaseRepository implements TelefoneRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Telefone::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

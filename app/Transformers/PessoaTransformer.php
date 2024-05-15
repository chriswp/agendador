<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Pessoa;

/**
 * Class PessoaTransformer.
 *
 * @package namespace App\Transformers;
 */
class PessoaTransformer extends TransformerAbstract
{
    /**
     * Transform the Pessoa entity.
     *
     * @param \App\Models\Pessoa $model
     *
     * @return array
     */
    public function transform(Pessoa $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

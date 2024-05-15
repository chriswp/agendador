<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\PessoaFisica;

/**
 * Class PessoaFisicaTransformer.
 *
 * @package namespace App\Transformers;
 */
class PessoaFisicaTransformer extends TransformerAbstract
{
    /**
     * Transform the PessoaFisica entity.
     *
     * @param \App\Models\PessoaFisica $model
     *
     * @return array
     */
    public function transform(PessoaFisica $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

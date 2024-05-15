<?php

namespace App\Presenters;

use App\Transformers\PessoaFisicaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PessoaFisicaPresenter.
 *
 * @package namespace App\Presenters;
 */
class PessoaFisicaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PessoaFisicaTransformer();
    }
}

<?php

namespace App\Presenters;

use App\Transformers\PessoaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PessoaPresenter.
 *
 * @package namespace App\Presenters;
 */
class PessoaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PessoaTransformer();
    }
}

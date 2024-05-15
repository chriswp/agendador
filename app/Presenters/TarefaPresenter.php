<?php

namespace App\Presenters;

use App\Transformers\TarefaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TarefaPresenter.
 *
 * @package namespace App\Presenters;
 */
class TarefaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TarefaTransformer();
    }
}

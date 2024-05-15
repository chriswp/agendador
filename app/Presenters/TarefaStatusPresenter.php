<?php

namespace App\Presenters;

use App\Transformers\TarefaStatusTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TarefaStatusPresenter.
 *
 * @package namespace App\Presenters;
 */
class TarefaStatusPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TarefaStatusTransformer();
    }
}

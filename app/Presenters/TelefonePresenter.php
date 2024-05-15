<?php

namespace App\Presenters;

use App\Transformers\TelefoneTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TelefonePresenter.
 *
 * @package namespace App\Presenters;
 */
class TelefonePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TelefoneTransformer();
    }
}

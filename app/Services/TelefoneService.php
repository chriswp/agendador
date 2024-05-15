<?php

namespace App\Services;

use App\Presenters\TelefonePresenter;
use App\Repositories\TelefoneRepository;
use App\Validators\TelefoneValidator;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Presenter\FractalPresenter;
use Prettus\Validator\LaravelValidator;

class TelefoneService extends ApiService
{

    protected function repository(): RepositoryInterface
    {
        return app(TelefoneRepository::class);
    }

    protected function presenter(): FractalPresenter
    {
        return app(TelefonePresenter::class);
    }

    protected function validator(): LaravelValidator
    {
        return app(TelefoneValidator::class);
    }
}

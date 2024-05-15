<?php

namespace App\Services;

use App\Models\Pessoa;
use App\Presenters\PessoaPresenter;
use App\Repositories\PessoaRepository;
use App\Validators\PessoaValidator;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Presenter\FractalPresenter;
use Prettus\Validator\LaravelValidator;

class PessoaService extends ApiService
{
    public function createPessoaFisica(array $dados): Pessoa
    {
        return DB::transaction(function () use ($dados) {
            $pessoa = $this->repository()->create($dados['pessoa']);
            $pessoa->pessoaFisica()->create($dados['pessoaFisica']);
            return $pessoa;
        });

    }

    protected function repository(): RepositoryInterface
    {
        return app(PessoaRepository::class);
    }

    protected function presenter(): FractalPresenter
    {
        return app(PessoaPresenter::class);
    }

    protected function validator(): LaravelValidator
    {
        return app(PessoaValidator::class);
    }
}

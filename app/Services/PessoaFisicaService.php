<?php

namespace App\Services;

use App\Models\PessoaFisica;
use App\Presenters\PessoaFisicaPresenter;
use App\Repositories\PessoaFisicaRepository;
use App\Validators\PessoaFisicaValidator;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Presenter\FractalPresenter;
use Prettus\Validator\LaravelValidator;

class PessoaFisicaService extends ApiService
{
    protected PessoaService $pessoaService;

    public function __construct(
        PessoaService $pessoaService,
    ) {
        $this->pessoaService = $pessoaService;
    }

    public function create(array $dados): PessoaFisica
    {
        $pessoa = $this->pessoaService->createPessoaFisica($dados);
        return $pessoa->pessoaFisica;
    }

    public function edit(array $data, $id)
    {

        $pessoaFisica = $this->repository()->update($data['pessoaFisica'], $id);
        $pessoaFisica->pessoa()->update($data['pessoa']);
        return $pessoaFisica;

    }

    public function update(Request $request, $id)
    {
        $pessoaFisica = $this->repository()->find($id);
        $pessoa = $pessoaFisica->pessoa();
        $pessoaFisica->update($request->all());
        $pessoaFisica->pessoa()->update($pessoa);

        return $pessoaFisica->refresh();
    }

    protected function repository(): RepositoryInterface
    {
        return app(PessoaFisicaRepository::class);
    }

    protected function presenter(): FractalPresenter
    {
        return app(PessoaFisicaPresenter::class);
    }

    protected function validator(): LaravelValidator
    {
        return app(PessoaFisicaValidator::class);
    }
}

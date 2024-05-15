<?php

namespace App\Services;

use App\Models\TarefaStatus;
use App\Presenters\TarefaPresenter;
use App\Repositories\TarefaRepository;
use App\Validators\TarefaValidator;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Presenter\FractalPresenter;
use Prettus\Validator\LaravelValidator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TarefaService extends ApiService
{

    protected function repository(): RepositoryInterface
    {
       return app(TarefaRepository::class);
    }

    protected function presenter(): FractalPresenter
    {
        return app(TarefaPresenter::class);
    }

    protected function validator(): LaravelValidator
    {
        return app(TarefaValidator::class);
    }

    public function finalizar($id)
    {
        $tarefa = $this->repository()->find($id);
        if (!$tarefa) {
            throw new NotFoundHttpException('Tarefa não encontrada');
        }
        return $this->repository()->update(['tarefa_status_id' => TarefaStatus::CONCLUIDO], $id);
    }
}

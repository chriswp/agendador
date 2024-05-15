<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Services\TarefaService;


class TarefasController extends ApiController
{

    protected function service(): ApiService
    {
        return app(TarefaService::class);
    }

    public function finalizar($id)
    {
        return $this->service()->finalizar($id);
    }
}

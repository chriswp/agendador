<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPasswordRequest;
use App\Models\UsuarioNivel;
use App\Services\ApiService;
use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseHttp;


class UsuariosController extends ApiController
{
    protected function service(): ApiService
    {
        return app(UsuarioService::class);
    }



    public function changePassword(UpdateUserPasswordRequest $request)
    {
        $usuario = auth()->user();
        $this->service()->updatePassword($usuario->id, $request->password);
        return response()->json(['message' => 'Senha atualizada com sucesso!']);
    }
}

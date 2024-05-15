<?php

namespace App\Builders\Usuario;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuarioCreateResponseBuilder
{
    protected Model $data;
    protected string $token;

    public function __construct(Model $data)
    {
        $this->data = $data;
        $this->token = JWTAuth::fromUser($data);
    }

    public function build()
    {
        return [
            'nome' => $this->data->pessoaFisica->pessoa->nome,
            'email' => $this->data->email,
            'token' => $this->token
        ];
    }
}

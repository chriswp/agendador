<?php

namespace App\Builders\Usuario;

class UsuarioCreateRequestBuilder
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return [
            'pessoa' => [
                'nome' => $this->data['nome'],
            ],
            'pessoaFisica' => [
                'cpf' => $this->data['cpf'],
                'data_nascimento' => $this->data['dataNascimento'],
                'email' => $this->data['email'],
            ],
            'usuario' => [
                'email' => $this->data['email'],
                'password' => $this->data['password'],
                'usuario_nivel_id' => 2
            ],
        ];
    }
}

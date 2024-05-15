<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;


class PessoaFisicaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'cpf' => 'required|cpf|unique:pessoas_fisicas',
            'email' => 'required|unique:usuarios,email',
        ],
        ValidatorInterface::RULE_UPDATE => [

        ],
    ];
}



<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;


class TarefaValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'titulo' => 'required|string|max:60',
            'descricao' => 'required|string|max:255',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'titulo' => 'required|string|max:60',
            'descricao' => 'required|string|max:255',
        ],
    ];
}

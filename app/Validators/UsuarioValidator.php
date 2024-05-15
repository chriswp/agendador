<?php

namespace App\Validators;

use App\Rules\Maior16AnosValidator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\Rules\Password;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class UsuarioValidator extends LaravelValidator
{
    public function __construct(Factory $factory)
    {
        $this->rules = [
            ValidatorInterface::RULE_CREATE => [
                'nome' => 'required|string|max:100',
                'cpf' => ['required', 'cpf'],
                'email' => ['required', 'email', 'unique:usuarios,email'],
                'dataNascimento' => ['nullable', 'before:today', new Maior16AnosValidator()],
                'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
                'password_confirmation' => 'required|min:6',
            ],
            ValidatorInterface::RULE_UPDATE => [],
        ];
        parent::__construct($factory);
    }
}

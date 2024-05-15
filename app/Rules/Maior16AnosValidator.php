<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Maior16AnosValidator implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       $dataNascimento = Carbon::parse($value);
       $maior16Anos = Carbon::now();
       $diferenca = (int)$dataNascimento->diff($maior16Anos)->format('%y');
       
       if($diferenca < 16) {
           $fail('A pessoa deve ser maior de 16 anos.');
       }
    }
}

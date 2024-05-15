<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class CheckUserPassword implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $currentPassword = auth()->user()->getAuthPassword();
        $isCorrect = Hash::check($value, $currentPassword);
        if ($isCorrect === false) {
            $fail('A senha  atual informada está incorreta.');
        }
    }
}

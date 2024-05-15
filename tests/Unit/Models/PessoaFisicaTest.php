<?php

namespace Tests\Unit\Models;

use App\Models\PessoaFisica;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable;
use Prettus\Repository\Traits\TransformableTrait;
use Tests\TestCase;

class PessoaFisicaTest extends TestCase
{
    private PessoaFisica $pessoaFisica;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pessoaFisica = new PessoaFisica();
    }


    public function testFillableAttribute()
    {
        $fillable = [
            'pessoa_id',
            'cpf',
            'data_nascimento'
        ];
        $this->assertEquals($fillable, $this->pessoaFisica->getFillable());
    }

    public function testIfUseTraits()
    {
        $traits = [
            TransformableTrait::class,
            SoftDeletes::class,
            Auditable::class,
            HasFactory::class
        ];
        $traitsPessoaFisica = array_keys(class_uses(PessoaFisica::class));
        $this->assertEquals($traits, $traitsPessoaFisica);
    }
}

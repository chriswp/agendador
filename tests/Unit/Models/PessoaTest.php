<?php

namespace Tests\Unit\Models;

use App\Models\Pessoa;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable;
use Prettus\Repository\Traits\TransformableTrait;
use Tests\TestCase;

class PessoaTest extends TestCase
{
    private Pessoa $pessoa;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pessoa = new Pessoa();
    }


    public function testFillableAttribute()
    {
        $fillable = [
            'nome'
        ];
        $this->assertEquals($fillable, $this->pessoa->getFillable());
    }

    public function testIfUseTraits()
    {
        $traits = [
            TransformableTrait::class,
            SoftDeletes::class,
            Auditable::class,
            HasFactory::class
        ];
        $traitsPessoa = array_keys(class_uses(Pessoa::class));
        $this->assertEquals($traits, $traitsPessoa);
    }
}

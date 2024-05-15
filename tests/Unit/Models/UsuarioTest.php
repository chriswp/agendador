<?php

namespace Tests\Unit\Models;

use App\Models\Usuario;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable;
use Prettus\Repository\Traits\TransformableTrait;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    private Usuario $usuario;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usuario = new Usuario();
    }


    public function testFillableAttribute()
    {
        $fillable = [
            'pessoa_fisica_id',
            'usuario_nivel_id',
            'email',
            'password',
            'ativo'
        ];
        $this->assertEquals($fillable, $this->usuario->getFillable());
    }

    public function testIfUseTraits()
    {
        $traits = [
            HasApiTokens::class,
            HasFactory::class,
            Notifiable::class,
            CanResetPassword::class,
            Auditable::class
        ];
        $traitsUsuario = array_keys(class_uses(Usuario::class));
        $this->assertEquals($traits, $traitsUsuario);
    }
}

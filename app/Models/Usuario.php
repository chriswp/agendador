<?php

namespace App\Models;


use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject, CanResetPassword, AuditableInterface
{
    use HasApiTokens, HasFactory, Notifiable, \Illuminate\Auth\Passwords\CanResetPassword, Auditable;


    protected $fillable = [
        'pessoa_fisica_id',
        'usuario_nivel_id',
        'email',
        'password',
        'ativo'
    ];

    protected $attributes = [
        'ativo' => false
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['nome'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function nivel()
    {
        return $this->belongsTo(UsuarioNivel::class, 'usuario_nivel_id');
    }

    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password)) {
            $password = Hash::make($password);
        }
        $this->attributes['password'] = $password;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getNomeAttribute()
    {
        return $this->pessoaFisica->pessoa->nome;
    }

    public function pessoaFisica()
    {
        return $this->belongsTo(PessoaFisica::class);
    }

}

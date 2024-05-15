<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class UsuarioNivel extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes, HasFactory;

    const ADMIN = 1;
    const USUARIO = 2;

    protected $table = 'usuario_niveis';
    protected $fillable = ['nome'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}

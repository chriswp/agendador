<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pessoa extends Model implements Transformable, AuditableInterface
{
    use TransformableTrait, SoftDeletes, Auditable, HasFactory;

    protected $fillable = ['nome'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function pessoaFisica(): HasOne
    {
        return $this->hasOne(PessoaFisica::class);
    }


    public function telefones(): BelongsToMany
    {
        return $this->belongsToMany(Telefone::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Telefone extends Model implements Transformable, AuditableInterface
{
    use TransformableTrait, SoftDeletes, Auditable;

    protected $fillable = ['ddd', 'numero'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function setNumeroAttribute($value)
    {
        $this->attributes['numero'] = preg_replace('/[^0-9]/', '', $value);
    }
}

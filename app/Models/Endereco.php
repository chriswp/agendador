<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Endereco extends Model implements Transformable, AuditableInterface
{
    use TransformableTrait, SoftDeletes, Auditable;

    protected $fillable = [
        'cidade_id',
        'logradouro',
        'numero',
        'complemento',
        'cep',
        'bairro',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = [
        'endereco_completo'
    ];

    public function setCepAttribute($value): void
    {
        $this->attributes['cep'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function getCepAttribute(): string
    {
        $cep = $this->attributes['cep'];
        return substr($cep, 0, 5).'-'.substr($cep, 5, 3);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function getEnderecoCompletoAttribute()
    {
        if ($this->complemento == null) {
            return $this->logradouro.', '.$this->numero.' - '.$this->bairro.' - '.$this->cidade->descricao.', '.$this->cidade->estado->uf.','.$this->cep;
        }
        return $this->logradouro.', '.$this->numero.' - '.$this->complemento.' - '.$this->bairro.' - '.$this->cidade->descricao.', '.$this->cidade->estado->uf.', '.$this->cep;
    }

}

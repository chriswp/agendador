<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PessoaFisica extends Model implements Transformable, AuditableInterface
{
    use TransformableTrait, SoftDeletes, Auditable, HasFactory;

    protected $table = 'pessoas_fisicas';

    protected $fillable = [
        'pessoa_id',
        'cpf',
        'data_nascimento',
    ];

    protected $dates = [
        'data_nascimento',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'pessoa_id' => 'integer',
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function setCpfAttribute($value): void
    {
        $this->attributes['cpf'] = preg_replace('/[^0-9]/', '', $value);
    }

//    public function getCpfAttribute()
//    {
//        $cpf = $this->attributes['cpf'];
//        $ultimosTresDigitos = substr($cpf, -3);
//        return str_repeat('*', strlen($cpf) - 3).$ultimosTresDigitos;
//    }

//    public function setDataNascimentoAttribute($value): void
//    {
//        $this->attributes['data_nascimento'] = $value;
//        $dataFormatoBr = Carbon::createFromFormat('d/m/Y', $value);
//
//        if ($dataFormatoBr !== false && !Carbon::hasFormat('Y-m-d', $value)) {
//            $this->attributes['data_nascimento'] = $dataFormatoBr->format('Y-m-d');
//        }
//    }
//
//    public function setDataExpedicaoAttribute($value): void
//    {
//        $this->attributes['data_expedicao'] = $value;
//
//        if (!is_null($value)) {
//            $this->attributes['data_expedicao'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
//        }
//    }

    public function usuario(): HasOne
    {
        return $this->hasOne(Usuario::class);
    }
}

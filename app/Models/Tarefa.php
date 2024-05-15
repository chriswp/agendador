<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Tarefa extends Model implements Transformable, AuditableInterface
{
    use TransformableTrait, SoftDeletes, Auditable, HasFactory;

    protected $fillable = ['titulo','descricao', 'data_fim','tarefa_status_id','usuario_id'];

    protected $casts = [
        'data_fim' => 'date:Y-m-d',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $userId = auth()->user()->id;
            $model->usuario_id = $userId;
        });
    }

    public function status()
    {
        return $this->belongsTo(TarefaStatus::class, 'tarefa_status_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

}

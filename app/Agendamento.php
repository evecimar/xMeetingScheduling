<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{   
    protected $fillable = [
        'descricao', 'sala_id', 'solicitante_email', 'inicio', 'fim', 'status'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public static function boot(){
        parent::boot();
        
        static::saving(function ($agendamento) {
            $agendamento->inicio = Carbon::createFromFormat('d/m/Y H:i', $agendamento->inicio);
            $agendamento->fim = Carbon::createFromFormat('d/m/Y H:i', $agendamento->fim);
        });

    }

    public function getInicioAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y H:i');
    }

    public function getFimAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y H:i');
    }

}
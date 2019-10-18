<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const Ativo = 1;
    const Cancelado = 2;
    
    protected $fillable = [
        'nome', 'descricao'
    ];
}

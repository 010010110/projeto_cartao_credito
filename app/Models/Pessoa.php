<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'documento',
        'telefone',
        'tipo'
    ];

    function endereco()
    {
        return $this->hasOne('App\Models\Endereco', 'endereco_id');
    }

}

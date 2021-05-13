<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoa';

    protected $fillable = [
        'nome',
        'documento',
        'telefone',
        'tipo',
        'endereco_id'
    ];

    function endereco()
    {
        return $this->hasOne('App\Models\Endereco', 'endereco_id');
    }

}

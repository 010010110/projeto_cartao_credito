<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    use HasFactory;

    protected $table = 'cartao';

    protected $fillable = [
        'tipo',
        'status',
        'numero',
        'senha',
        'cvv',
        'categoria',
        'user_id',
        'pessoa_id',
        'bandeira_id'
    ];

    protected $hidden = [
        'senha',
        'cvv'
    ];

    protected $casts = [
        'data_emissao' => 'date',
        'validade' => 'date'
    ];

    function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    function pessoa()
    {
        return $this->hasOne('App\Models\Pessoa', 'id', 'pessoa_id');
    }

    function bandeira()
    {
        return $this->hasOne('App\Models\Bandeira', 'id', 'bandeira_id');
    }

}

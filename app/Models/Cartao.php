<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'status',
        'numero',
        'senha',
        'cvv',
        'categoria',
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

    function bandeira()
    {
        return $this->hasOne('App\Models\Bandeira', 'bandeira_id');
    }

}

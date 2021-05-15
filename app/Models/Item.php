<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';

    protected $fillable = [
        'valor',
        'descricao',
        'parcelas'
    ];

    protected $dates = [
        'created_at'
    ];

    function fatura()
    {
        return $this->belongsToMany('App\Models\Fatura', 'fatura_has_item',
            'item_id', 'fatura_id')->with('fatura');
    }

}

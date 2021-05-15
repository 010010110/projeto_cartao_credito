<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    use HasFactory;

    protected $table = 'fatura';

    protected $fillable = [
        'status',
        'user_id'
    ];

    protected $dates = [
        'created_at'
    ];

    function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    function item()
    {
        return $this->belongsToMany('App\Models\Item', 'fatura_has_item',
            'fatura_id', 'item_id');
    }

    function pagamentos()
    {
        return $this->hasMany('App\Models\Pagamento');
    }

}

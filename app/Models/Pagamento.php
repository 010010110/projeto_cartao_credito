<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor',
        'fatura_id'
    ];

    protected $dates = [
        'created_at'
    ];

    function fatura()
    {
        return $this->belongsTo('App\Models\Fatura', 'fatura_id');
    }

}

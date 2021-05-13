<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    use HasFactory;

    protected $table = 'fatura';

    protected $fillable = [
        'status'
    ];

    protected $dates = [
        'created_at'
    ];

    function pagamentos()
    {
        return $this->hasMany('App\Models\Pagamento');
    }

}

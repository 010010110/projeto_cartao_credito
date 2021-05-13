<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bandeira extends Model
{
    use HasFactory;

    protected $table = 'bandeira';

    protected $fillable = [
        'nome',
        'variante',
        'imagem'
    ];

}

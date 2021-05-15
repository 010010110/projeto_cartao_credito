<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'tipo',
        'status',
        'email',
        'password',
        'renda_mensal',
        'limite',
        'pessoa_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function pessoa()
    {
        return $this->belongsTo('App\Models\Pessoa', 'pessoa_id');
    }

    function cartoes()
    {
        return $this->hasMany('App\Models\Cartao', 'user_id')
            ->with('bandeira')->with('pessoa');
    }

    function faturas()
    {
        return $this->belongsToMany('App\Models\Fatura', 'user_has_fatura',
            'user_id', 'fatura_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}

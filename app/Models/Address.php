<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'alias',
        'calle',
        'numero',
        'referencia',
        'distrito',
        'provincia',
        'departamento',
        'codigo_postal',
        'es_principal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

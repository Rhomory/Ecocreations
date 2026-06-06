<?php

namespace App\Models;

use App\Models\Concerns\Blameable;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use Blameable;

    protected $fillable = [
        'codigo',
        'tipo',
        'valor',
        'min_compra',
        'valido_desde',
        'valido_hasta',
        'usos_max',
        'usos_actuales',
        'activo',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

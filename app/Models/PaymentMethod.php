<?php

namespace App\Models;

use App\Models\Concerns\Blameable;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use Blameable;

    protected $fillable = [
        'nombre',
        'codigo',
        'icono',
        'activo',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

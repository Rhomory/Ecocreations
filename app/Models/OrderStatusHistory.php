<?php

namespace App\Models;

use App\Models\Concerns\Blameable;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    use Blameable;

    protected $fillable = [
        'order_id',
        'estado',
        'comentario',
        'user_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

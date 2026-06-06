<?php

namespace App\Models;

use App\Models\Concerns\Blameable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Blameable;

    protected $fillable = [
        'numero_orden',
        'user_id',
        'address_id',
        'payment_method_id',
        'coupon_id',
        'subtotal',
        'descuento',
        'igv',
        'envio',
        'total',
        'estado',
        'notas',
        'niubiz_purchase_number',
        'niubiz_transaction_id',
        'niubiz_action_code',
        'niubiz_response',
        'pagado_at',
    ];

    protected $casts = [
        'niubiz_response' => 'array',
        'pagado_at'       => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}

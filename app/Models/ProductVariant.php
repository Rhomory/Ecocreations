<?php

namespace App\Models;

use App\Models\Concerns\Blameable;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use Blameable;

    protected $fillable = [
        'product_id',
        'sku',
        'color',
        'tamano',
        'precio_extra',
        'stock',
        'imagen',
        'cloudinary_public_id',
        'activo',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

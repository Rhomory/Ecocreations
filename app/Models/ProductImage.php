<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'ruta',
        'cloudinary_public_id',
        'alt_text',
        'orden',
        'es_principal',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

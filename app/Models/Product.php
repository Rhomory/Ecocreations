<?php

namespace App\Models;

use App\Models\Concerns\Blameable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static int count(string $columns = '*')
 */
class Product extends Model
{
    use Blameable;

    protected $fillable = [
        'category_id',
        'nombre',
        'slug',
        'descripcion_corta',
        'descripcion_larga',
        'precio_base',
        'es_personalizable',
        'es_destacado',
        'material',
        'activo',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}

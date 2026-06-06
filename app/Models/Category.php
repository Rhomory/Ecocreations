<?php

namespace App\Models;

use App\Models\Concerns\Blameable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Blameable;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'icono',
        'imagen',
        'cloudinary_public_id',
        'activo',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

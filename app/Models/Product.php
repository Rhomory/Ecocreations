<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static int count(string $columns = '*')
 */
class Product extends Model
{
    //

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

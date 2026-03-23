<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'ecom_products';
    protected $guarded = [];

        public function stock()
    {
        return $this->hasOne(Product_stocks::class, 'product_id');
    }

    public function galleries()
    {
        return $this->hasMany(Product_galleries::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

  
}

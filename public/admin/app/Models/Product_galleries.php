<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_galleries extends Model
{
    use HasFactory;

    protected $table = 'ecom_product_images';
    // protected $primaryKey = 'id';
        protected $guarded = [];
     public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    } 
}

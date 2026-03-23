<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_stocks extends Model
{
    use HasFactory;

    protected $table = 'ecom_stocks';
    // protected $primaryKey = 'id';
      protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Add any additional relationships or methods as needed
}

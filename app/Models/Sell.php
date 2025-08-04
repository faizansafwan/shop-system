<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    //
    protected $fillable = [
        'shop_id',
        'product_id',
        'qty',
        'price',
        'extra_qty',
        'discount',
        'description',
        'payment_status'
    ];


    // A Sell belongs to one Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // A Sell belongs to one Shop
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}

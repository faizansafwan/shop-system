<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    public function manufactures()
    {
        return $this->hasMany(Manufacture::class, 'product_id', 'id');
    }


    // A Product has many Sells
    public function sells()
    {
        return $this->hasMany(Sell::class, 'product_id', 'id');
    }

}

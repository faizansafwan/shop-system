<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $fillable = [
        'name',
        'address',
        
    ];


    // A Shop has many Sells
    public function sells()
    {
        return $this->hasMany(Sell::class, 'shop_id', 'id');
    }
}

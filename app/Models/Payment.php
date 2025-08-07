<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'sell_id',
        'method',
        'amount',
        'balance',
        'status'
    ];

    public function sell()
    {
        return $this->belongsTo(Sell::class, 'sell_id');
    }

}

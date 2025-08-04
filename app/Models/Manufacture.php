<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    //
    protected $fillable = [
        'product_id',
        'batch_no',
        'price',
        'qty',
        'exp_date',
        'manufacture_date',
        'description'
    ];


    public function product()
{
    return $this->belongsTo(Product::class, 'product_id', 'id');
}


}

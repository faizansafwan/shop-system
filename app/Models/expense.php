<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    //
    protected $fillable = [
        'name',
        'price',
        'description', 
    ];
}

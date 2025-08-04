<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $table = 'inventory';

    protected $fillable = [
        'inventory_id',
        'name',
        'unit_type',
        'cost',
        'count',
        'discount',
        'total_cost',
    ];


    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'unit_type'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'inventory_id');
    }

}

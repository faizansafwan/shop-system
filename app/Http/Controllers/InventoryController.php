<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryItem;

class InventoryController extends Controller
{
    public function index()
    {
        $items = Inventory::with('inventoryItem')->latest()->get();
        $inventoryItems = InventoryItem::all();

        return view('inventory', compact('items', 'inventoryItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventory_items,id',
            'cost' => 'required|numeric|min:0',
            'count' => 'required|integer|min:1',
            
        ]);

        // Calculate total cost
        $cost = floatval($request->input('cost'));
        $count = intval($request->input('count'));
        $discount = floatval($request->input('discount'));
        $totalCost = ($cost * $count) * (1 - ($discount / 100));

        Inventory::create([
            'inventory_id' => $request->input('inventory_id'),
            'cost' => $cost,
            'count' => $count,
            'discount' => $discount,
            'total_cost' => $totalCost,
        ]);

        return redirect()->back()->with('success', 'Inventory item added successfully!');
    }

    public function edit($id)
    {
        $editItem = Inventory::findOrFail($id);
        $items = Inventory::with('inventoryItem')->latest()->get();
        $inventoryItems = InventoryItem::all();

        return view('inventory', compact('items', 'editItem', 'inventoryItems'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventory_items,id',
            'cost' => 'required|numeric|min:0',
            'count' => 'required|integer|min:1',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $inventory = Inventory::findOrFail($id);

        $cost = floatval($request->input('cost'));
        $count = intval($request->input('count'));
        $discount = floatval($request->input('discount'));
        $totalCost = ($cost * $count) * (1 - ($discount / 100));

        $inventory->update([
            'inventory_id' => $request->input('inventory_id'),
            'cost' => $cost,
            'count' => $count,
            'discount' => $discount,
            'total_cost' => $totalCost,
        ]);

        return redirect()->route('inventory.index')->with('success', 'Inventory item updated successfully!');
    }


    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->back()->with('success', 'Inventory item deleted successfully!');
    }
}

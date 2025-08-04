<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItem;

class InventoryItemController extends Controller
{
    //
    public function index()
    {
        $items = InventoryItem::latest()->get();
        return view('inventoryItem', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item-name' => 'required|string|max:255',
            'unit-type' => 'required|string',
        ]);

        InventoryItem::create([
            'name' => $request->input('item-name'),
            'unit_type' => $request->input('unit-type'),
        ]);

        return redirect()->back()->with('success', 'Inventory item added successfully!');
    }


    public function edit($id)
    {
        $items = InventoryItem::latest()->get(); // For showing all items
        $editItem = InventoryItem::findOrFail($id); // For editing
        return view('inventoryItem', compact('items', 'editItem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item-name' => 'required|string|max:255',
            'unit-type' => 'required|string',
        ]);

        $item = InventoryItem::findOrFail($id);
        $item->update([
            'name' => $request->input('item-name'),
            'unit_type' => $request->input('unit-type'),
        ]);

        return redirect()->route('inventory.item.index')->with('success', 'Inventory item updated successfully!');
    }

    public function destroy($id)
    {
        $item = InventoryItem::findOrFail($id);
        $item->delete();

        return redirect()->route('inventory.item.index')->with('success', 'Item deleted successfully.');
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::latest()->get();
        return view('shops', compact('shops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        Shop::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('shops.index')->with('success', 'Shop added successfully!');
    }

    public function edit($id)
    {
        $shops = Shop::latest()->get();
        $editShop = Shop::findOrFail($id);
        return view('shops', compact('shops', 'editShop'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $shop = Shop::findOrFail($id);
        $shop->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('shops.index')->with('success', 'Shop updated successfully!');
    }

    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return redirect()->route('shops.index')->with('success', 'Shop deleted successfully!');
    }
}

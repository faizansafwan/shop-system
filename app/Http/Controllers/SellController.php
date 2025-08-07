<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class SellController extends Controller
{
    // Show all sell records with product and shop relationships
    public function index()
    {
        $sells = Sell::with(['product', 'shop'])->latest()->get();
        $products = Product::all();
        $shops = Shop::all();

        return view('sells', compact('sells', 'products', 'shops'));
    }

    // Store a new sell record
    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'qty.*' => 'required|integer|min:1',
            'price.*' => 'required|numeric|min:0',
            'discount.*' => 'nullable|numeric|min:0',
            'description.*' => 'nullable|string|max:255',
            
        ]);

        $count = count($request->product_id);
        $saleIds = [];

        for ($i = 0; $i < $count; $i++) {
            $qty = $request->qty[$i];
            $price = $request->price[$i];
            $discount = $request->discount[$i] ?? 0;
            $total = ($price - $discount) * $qty;

            $sale = Sell::create([
                'shop_id' => $request->shop_id,
                'product_id' => $request->product_id[$i],
                'qty' => $qty,
                'price' => $price,
                'discount' => $discount,
                'total' => $total,
                'description' => $request->description[$i] ?? '',
                
            ]);

            $saleIds[] = $sale->id;
        }


        // Redirect to the payment page with the latest sale ID
        $lastSaleId = end($saleIds);
        return redirect()->route('payments.create', ['sell_id' => $lastSaleId]);
    }


    // Show edit form
    public function edit($id)
    {
        $editSell = Sell::findOrFail($id);
        $sells = Sell::with(['product', 'shop'])->latest()->get();
        $products = Product::all();
        $shops = Shop::all();

        return view('sells', compact('editSell', 'sells', 'products', 'shops'));
    }

    // Update sell record
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'shop_id' => 'required|exists:shops,id',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'extra_qty' => 'nullable|integer|min:0',
            'discount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'payment_status' => 'required|in:paid,unpaid,partial',
        ]);

        $sell = Sell::findOrFail($id);
        $sell->update($request->all());

        return redirect()->route('sells')->with('success', 'Sell record updated successfully!');
    }

    // Delete sell record
    public function destroy($id)
    {
        $sell = Sell::findOrFail($id);
        $sell->delete();

        return redirect()->back()->with('success', 'Sell record deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Manufacture;
use App\Models\Product;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    // Show all manufacture records
    public function index()
    {
        $manufactures = Manufacture::with('product')->latest()->get();
        $products = Product::all();

        return view('manufactures', compact('manufactures', 'products'));
    }

    // Store a new manufacture record
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'batch_no' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:1',
            'exp_date' => 'required|date|after:today',
            'manufacture_date' => 'required|date|before_or_equal:today',
            'description' => 'nullable|string|max:255',
        ]);

        Manufacture::create($request->all());

        return redirect()->back()->with('success', 'Manufacture record created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $editManufacture = Manufacture::findOrFail($id);
        $manufactures = Manufacture::with('product')->latest()->get();
        $products = Product::all();

        return view('manufactures', compact('editManufacture', 'manufactures', 'products'));
    }

    // Update manufacture record
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'batch_no' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:1',
            'exp_date' => 'required|date|after:today',
            'manufacture_date' => 'required|date|before_or_equal:today',
            'description' => 'nullable|string|max:255',
        ]);

        $manufacture = Manufacture::findOrFail($id);
        $manufacture->update($request->all());

        return redirect()->route('manufactures.index')->with('success', 'Manufacture record updated successfully!');
    }

    // Delete manufacture record
    public function destroy($id)
    {
        $manufacture = Manufacture::findOrFail($id);
        $manufacture->delete();

        return redirect()->back()->with('success', 'Manufacture record deleted successfully!');
    }
}

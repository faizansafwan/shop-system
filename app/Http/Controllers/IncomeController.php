<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::latest()->get();
        return view('incomes', compact('incomes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Income::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('incomes.index')->with('success', 'Income added successfully!');
    }

    public function edit($id)
    {
        $incomes = Income::latest()->get();
        $editIncome = Income::findOrFail($id);
        return view('incomes', compact('incomes', 'editIncome'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $income = Income::findOrFail($id);
        $income->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('incomes.index')->with('success', 'Income updated successfully!');
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();

        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully!');
    }
}

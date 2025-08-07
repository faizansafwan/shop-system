<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function index()
    {
        $payments = Payment::with([ 'sell'])->latest()->get();

        return view('payment', compact('payments'));
    }


    public function create(Request $request)
    {
        $sellId = $request->get('sell_id');
        $sell = Sell::with(['shop', 'product'])->where('id', $sellId)->firstOrFail();

        return view('paymentForm', compact('sell'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'sell_id' => 'required|exists:sells,id',
            'method' => 'required|string|max:50',
            'status' => 'required|in:paid,non paid,partial',
            'amount' => 'required|numeric|min:0',  // required since form requires it
        ]);

        // Fetch the sell record to get total
        $sell = Sell::findOrFail($request->sell_id);

        // Calculate balance safely on server side
        $balance = $sell->total - $request->amount;

        // Optional: Make sure balance is not negative (e.g. amount > total)
        if ($balance < 0) {
            return back()->withErrors(['amount' => 'Amount paid cannot be greater than total sell amount.'])->withInput();
        }

        Payment::create([
            'sell_id' => $request->sell_id,
            'method' => $request->method,
            'status' => $request->status,
            'amount' => $sell->total,
            'balance' => $balance,
        ]);

        return redirect()->route('sells.index')->with('success', 'Payment recorded successfully!');
    }




}

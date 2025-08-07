@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<div class="p-4 bg-white rounded shadow text-gray-600">
    <h2 class="text-xl font-bold mb-6">Make Payment for Sale #{{ $sell->id }}</h2>

    <div class="flex justify-between mb-6">
        <!-- Shop Details -->
        <div class="w-1/2 pr-4 ">
            <h3 class="font-semibold text-lg mb-2">Shop Details</h3>
            <p><strong>ID:</strong> {{ $sell->shop->id }}</p>
            <p><strong>Name:</strong> {{ $sell->shop->name }}</p>
            <p><strong>Address:</strong> {{ $sell->shop->address }}</p>
        </div>

        <!-- Divider -->
        <div class="border-l border-gray-200 h-auto mx-4"></div>

        <!-- Product Details -->
        <div class="w-1/2 pl-4">
            <h3 class="font-semibold text-lg mb-2">Product Details</h3>
            <p><strong>ID:</strong> {{ $sell->product->id }}</p>
            <p><strong>Name:</strong> {{ $sell->product->name }}</p>
            <p><strong>Cost:</strong> Rs. {{ number_format($sell->price, 2) }}</p>
            <p><strong>Quantity:</strong> {{ $sell->qty }}</p>
        </div>
    </div>

    <p class="pb-3 mb-5 text-right text-lg border-b border-gray-200"><strong>Total:</strong> Rs. {{ number_format($sell->total, 2) }}</p>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="sell_id" value="{{ $sell->id }}">

        <label class="block mb-2 font-medium">Payment Method:</label>
        <select name="method" class="border p-2 rounded w-full mb-4" required>
            <option value="cash">Cash</option>
            <option value="card">Card</option>
            <option value="bank">Bank Transfer</option>
        </select>

        <label class="block mb-2 font-medium">Status:</label>
        <select name="status" class="border p-2 rounded w-full mb-6" required>
            <option value="paid">Paid</option>
            <option value="non paid">Non Paid</option>
            <option value="partial">Partial</option>
        </select>

        <label class="block mb-2 font-medium">Amount Paid:</label>
        <input type="number" step="0.01" name="amount" value="{{ $sell->total }}" class="border p-2 rounded w-full mb-4" required>

        

        <label class="block mb-2 font-medium">Balance:</label>
        <input type="text" id="balance" class="border p-2 rounded w-full mb-6 bg-gray-100" readonly>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Submit Payment
            </button>
        </div>
    </form> 

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const amountInput = document.querySelector('input[name="amount"]');
            const balanceInput = document.getElementById('balance');
            const statusSelect = document.querySelector('select[name="status"]');
            const total = {{ $sell->total }};

            function updateBalance() {
                const paid = parseFloat(amountInput.value) || 0;
                const balance = (total - paid).toFixed(2);
                balanceInput.value = `Rs. ${balance}`;
            }

            function handleStatusChange() {
                const status = statusSelect.value;

                if (status === 'paid') {
                    amountInput.value = total.toFixed(2);
                    amountInput.readOnly = true;
                } else if (status === 'non paid') {
                    amountInput.value = 0;
                    amountInput.readOnly = true;
                } else {
                    amountInput.readOnly = false;
                }

                updateBalance();
            }

            // Event Listeners
            amountInput.addEventListener('input', updateBalance);
            statusSelect.addEventListener('change', handleStatusChange);

            // Initialize on page load
            handleStatusChange();
        });
    </script>


</div>
@endsection

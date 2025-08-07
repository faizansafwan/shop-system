@extends('layouts.app')

@section('title', 'New Sale')

@section('content')
<div class="w-full bg-white rounded-lg shadow p-4">

    {{-- Header: Sale ID & Date --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">
            Sale ID: #
        </h2>
        <span class="text-gray-600">
            Date: {{ \Carbon\Carbon::now()->format('Y-m-d') }}
        </span>
    </div>

    <form action="{{ route('sells.store') }}" method="POST">
        @csrf

        {{-- Shop Selection --}}
        <div class="mb-6 border-gray-200 rounded">
            <label for="shop_id" class="block font-medium mb-1">Select Shop:</label>
            <div class="flex gap-2 items-center">
                <select id="shop_id" name="shop_id" class="border p-2 w-full max-w-md" onchange="handleShopChange(this)">
                    <option value=""> Choose a Shop </option>
                    @foreach($shops as $shop)
                        <option value="{{ $shop->id }}" data-address="{{ $shop->address }}">{{ $shop->name }}</option>
                    @endforeach
                    <option value="add_new">+ Add New Shop</option>
                </select>

                <a href="{{ route('shops.store') }}" id="add-shop-link" class="hidden text-sm text-blue-600 hover:underline" target="_blank">Go to Add Shop</a>
            </div>
            <p id="shop-address" class="mt-2 text-sm text-gray-700"></p>
        </div>


        {{-- Product Entry --}}
        <div id="products-container">
            <div class=" p-4 product-row ">
                {{-- ❌ Remove Button --}}
                

                <div class="grid grid-cols-6 gap-2">
                    <input type="text" name="product_id[]" placeholder="Product" class="border border-gray-200 rounded p-2" required />
                    <input type="number" name="qty[]" placeholder="Qty" class="border border-gray-200 rounded p-2" required />
                    <input type="number" name="price[]" placeholder="Cost" class="border border-gray-200 rounded p-2" required />
                    <input type="number" name="discount[]" placeholder="Discount" class="border border-gray-200 rounded p-2" />
                    <input type="number" name="total[]" placeholder="Total" class="border border-gray-200 rounded p-2 bg-gray-100" readonly />
                    <input type="text" name="description[]" placeholder="Description" class="border border-gray-200 rounded p-2" />
                </div>
            </div>

        </div>

        {{-- <button type="button" onclick="addProductRow()" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700 mb-6">
            + Add Product
        </button> --}}

        {{-- Totals and Payment --}}
        <div class="flex justify-end flex-wrap gap-6">
            

            <div class="w-full md:w-1/2 space-y-2">
                <div class="flex justify-between">
                    <span class="font-medium">Subtotal:</span>
                    <span id="subtotal">Rs. 0.00</span>
                </div>
                {{-- <div class="flex justify-between items-center">
                    <label class="font-medium">Amount Paid:</label>
                    <input type="number" name="paid" class="border p-1 w-32" oninput="calculateBalance()" />
                </div> --}}
                {{-- <div class="flex justify-between">
                    <span class="font-medium">Balance:</span>
                    <span id="balance">Rs. 0.00</span>
                </div> --}}

                {{-- Payment Method --}}
               {{-- <div>
                    <label for="payment_status" class="block mb-1 font-medium">Payment Method:</label>
                    <select name="payment_status" class="border p-2 w-full">
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="partial">Partial</option>
                    </select>
                </div> --}}
            </div>

        </div>

        {{-- Submit --}}
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                Go to Payment
            </button>
        </div>
    </form>
</div>

{{-- JS for dynamic behavior --}}
<script>
    function showShopAddress(select) {
        const address = select.options[select.selectedIndex].getAttribute('data-address');
        document.getElementById('shop-address').innerText = address ? 'Address: ' + address : '';
    }

    function addProductRow() {
        const container = document.getElementById('products-container');
        const row = document.querySelector('.product-row').cloneNode(true);
        row.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(row);
    }

    function calculateTotals() {
        let subtotal = 0;
        const rows = document.querySelectorAll('.product-row');

        rows.forEach(row => {
            const qty = parseFloat(row.querySelector('input[name="qty[]"]').value) || 0;
            const price = parseFloat(row.querySelector('input[name="price[]"]').value) || 0;
            const discount = parseFloat(row.querySelector('input[name="discount[]"]').value) || 0;
            const total = (price - discount) * qty;

            if (!isNaN(total)) {
                row.querySelector('input[name="total[]"]').value = total.toFixed(2);
                subtotal += total;
            }
        });

        document.getElementById('subtotal').innerText = `Rs. ${subtotal.toFixed(2)}`;

        const paid = parseFloat(document.querySelector('input[name="paid"]').value) || 0;
        const balance = subtotal - paid;
        document.getElementById('balance').innerText = `Rs. ${balance.toFixed(2)}`;
    }

    function calculateBalance() {
        calculateTotals(); // recalculate everything
    }

    // Event listener for changes in qty, price, or discount
    document.addEventListener('input', e => {
        const targetName = e.target.name;
        if (['qty[]', 'price[]', 'discount[]', 'paid'].includes(targetName)) {
            calculateTotals();
        }
    });

    function handleShopChange(select) {
        const address = select.options[select.selectedIndex].getAttribute('data-address');
        const addShopLink = document.getElementById('add-shop-link');

        if (select.value === 'add_new') {
            window.open('{{ route('shops.store') }}', '_blank'); 
            select.value = '';
            document.getElementById('shop-address').innerText = '';
            return;
        }

        addShopLink.classList.add('hidden');
        document.getElementById('shop-address').innerText = address ? 'Address: ' + address : '';
    }


    function removeProductRow(button) {
        const row = button.closest('.product-row');
        const container = document.getElementById('products-container');

        // Prevent removing the last remaining row
        if (container.querySelectorAll('.product-row').length > 1) {
            row.remove();
            calculateTotals(); // Recalculate totals after removing
        } else {
            alert("At least one product is required.");
        }
    }

</script>

@endsection

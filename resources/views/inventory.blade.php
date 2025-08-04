@extends('layouts.app')

@section('title', 'Inventory Management')

@section('content')
<div class="w-full px-4">
  <div class="bg-white rounded-lg shadow p-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Inventory Management</h2>
      <button 
        id="addInventoryBtn"
        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center"
      >
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add Inventory
      </button>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Inventory Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Inventory ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Unit Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Cost</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Count</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Discount</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Total Cost</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($items as $item)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->id }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->inventory_id }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->inventoryItem->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->inventoryItem->unit_type }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($item->cost, 2) }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->count }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->discount }}%</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${{ number_format($item->total_cost, 2) }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <a href="{{ route('inventory.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                <form method="POST" action="{{ route('inventory.destroy', $item->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                No inventory items found. Add your first item above.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal for Add Inventory -->
<div id="inventoryModal" class="fixed inset-0 bg-opacity-20 overflow-y-auto h-full w-full hidden z-50 backdrop-blur-sm">
  <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <!-- Modal Header -->
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-900">{{ isset($editItem) ? 'Edit Inventory Item' : 'Add New Inventory Item' }}</h3>
        <button id="closeModal" class="text-gray-400 hover:text-gray-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal Form -->
      <form id="inventoryForm" method="POST" action="{{ isset($editItem) ? route('inventory.update', $editItem->id) : route('inventory.store') }}" class="space-y-4">
        @csrf
        @if(isset($editItem))
          @method('POST')
        @endif

        <!-- ID -->
        <div>
          <label for="modal-id" class="block text-sm font-medium text-gray-700 mb-1">Inventory Item</label>
          <select
              id="modal-id"
              name="inventory_id"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">Select item</option>
            @foreach ($inventoryItems as $inventoryItem)
                <option value="{{ $inventoryItem->id }}"
                    {{ old('inventory_id', isset($editItem) ? $editItem->inventory_id : '') == $inventoryItem->id ? 'selected' : '' }}>
                    {{ $inventoryItem->name }} ({{ $inventoryItem->unit_type }})
                </option>
            @endforeach
          </select>
        </div>



        <!-- Cost -->
        <div>
          <label for="modal-cost" class="block text-sm font-medium text-gray-700 mb-1">Cost</label>
          <div class="relative">
            <span class="absolute left-3 top-2 text-gray-500">$</span>
            <input 
              type="number" 
              id="modal-cost" 
              name="cost" 
              value="{{ old('cost', isset($editItem) ? $editItem->cost : '') }}"
              step="0.01"
              placeholder="0.00" 
              class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
        </div>

        <!-- Count -->
        <div>
          <label for="modal-count" class="block text-sm font-medium text-gray-700 mb-1">Count</label>
          <input 
            type="number" 
            id="modal-count" 
            name="count" 
            value="{{ old('count', isset($editItem) ? $editItem->count : '') }}"
            placeholder="Enter count" 
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          />
        </div>

        <!-- Discount -->
        <div>
          <label for="modal-discount" class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
          <input 
            type="number" 
            id="modal-discount" 
            name="discount" 
            value="{{ old('discount', isset($editItem) ? $editItem->discount : '') }}"
            min="0"
            max="100"
            placeholder="0" 
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          />
        </div>

        <!-- Total Cost (Read-only, calculated) -->
        <div>
          <label for="modal-total-cost" class="block text-sm font-medium text-gray-700 mb-1">Total Cost</label>
          <div class="relative">
            <span class="absolute left-3 top-2 text-gray-500">$</span>
            <input 
              type="text" 
              id="modal-total-cost" 
              name="total_cost" 
              readonly
              placeholder="0.00" 
              class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700"
            />
          </div>
        </div>

        <!-- Modal Buttons -->
        <div class="flex justify-end space-x-3 pt-4">
          <button 
            type="button" 
            id="cancelBtn"
            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors"
          >
            Cancel
          </button>
          <button 
            type="submit" 
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
          >
            {{ isset($editItem) ? 'Update Inventory' : 'Save Inventory' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('inventoryModal');
    const addBtn = document.getElementById('addInventoryBtn');
    const closeBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const form = document.getElementById('inventoryForm');
    
    // Cost and Count inputs for calculation
    const costInput = document.getElementById('modal-cost');
    const countInput = document.getElementById('modal-count');
    const discountInput = document.getElementById('modal-discount');
    const totalCostInput = document.getElementById('modal-total-cost');

    // Open modal
    addBtn.addEventListener('click', function() {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    // Close modal functions
    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        form.reset();
        totalCostInput.value = '';
    }

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Calculate total cost
    function calculateTotal() {
        const cost = parseFloat(costInput.value) || 0;
        const count = parseInt(countInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;
        
        const subtotal = cost * count;
        const discountAmount = subtotal * (discount / 100);
        const total = subtotal - discountAmount;
        
        totalCostInput.value = total.toFixed(2);
    }

    // Add event listeners for calculation
    costInput.addEventListener('input', calculateTotal);
    countInput.addEventListener('input', calculateTotal);
    discountInput.addEventListener('input', calculateTotal);

    // Calculate initial total if editing
    if (costInput.value || countInput.value || discountInput.value) {
        calculateTotal();
    }

    // Add focus functionality to all inputs
    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('click', function() {
            this.focus();
        });
    });
});
</script>
@endsection
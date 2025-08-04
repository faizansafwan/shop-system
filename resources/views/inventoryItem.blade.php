@extends('layouts.app')

@section('title', 'Inventory Item')

@section('content')
<div class="w-full px-4">
  <div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4 border-b pb-2">
      <h4 class="text-xl font-semibold">{{ isset($editItem) ? 'Edit Inventory Item' : 'Add Inventory Item' }}</h4>
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

    <form method="POST" action="{{ isset($editItem) ? route('inventory.item.update', $editItem->id) : route('inventory.item.store') }}">
      @csrf
      @if(isset($editItem))
        @method('POST')
      @endif

      <!-- Name -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center">
        <label for="item-name" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Name</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('item-name') ? 'border-red-500' : '' }}">
            <input 
              type="text" 
              id="item-name" 
              name="item-name" 
              value="{{ old('item-name', isset($editItem) ? $editItem->name : '') }}"
              placeholder="Enter Item Name" 
              class="w-full outline-none bg-transparent focus:outline-none" 
              autocomplete="off"
            />
          </div>
          @error('item-name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Unit Type -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center">
        <label for="unit-type" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Unit Type</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('unit-type') ? 'border-red-500' : '' }}">
            <select 
              id="unit-type" 
              name="unit-type" 
              class="w-full outline-none bg-transparent focus:outline-none cursor-pointer"
            >
              <option value="" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == '' ? 'selected' : '' }}>Select Unit Type</option>
              <option value="pieces" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'pieces' ? 'selected' : '' }}>Pieces</option>
              <option value="kg" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'kg' ? 'selected' : '' }}>Kilograms (kg)</option>
              <option value="g" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'g' ? 'selected' : '' }}>Grams (g)</option>
              <option value="l" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'l' ? 'selected' : '' }}>Liters (L)</option>
              <option value="ml" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'ml' ? 'selected' : '' }}>Milliliters (ml)</option>
              <option value="m" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'm' ? 'selected' : '' }}>Meters (m)</option>
              <option value="cm" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'cm' ? 'selected' : '' }}>Centimeters (cm)</option>
              <option value="boxes" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'boxes' ? 'selected' : '' }}>Boxes</option>
              <option value="packs" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'packs' ? 'selected' : '' }}>Packs</option>
              <option value="bottles" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'bottles' ? 'selected' : '' }}>Bottles</option>
              <option value="cans" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'cans' ? 'selected' : '' }}>Cans</option>
              <option value="bags" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'bags' ? 'selected' : '' }}>Bags</option>
              <option value="rolls" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'rolls' ? 'selected' : '' }}>Rolls</option>
              <option value="sheets" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'sheets' ? 'selected' : '' }}>Sheets</option>
              <option value="units" {{ old('unit-type', isset($editItem) ? $editItem->unit_type : '') == 'units' ? 'selected' : '' }}>Units</option>
            </select>
          </div>
          @error('unit-type')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Buttons -->
      <div class="flex justify-end space-x-2 pt-4">
        @if(isset($editItem))
          <a href="{{ route('inventory.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
            Cancel
          </a>
        @endif
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
          {{ isset($editItem) ? 'Update Inventory' : 'Add Inventory' }}
        </button>
      </div>
    </form>

    <!-- Inventory Table -->
    <div class="overflow-x-auto py-5">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Unit Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($items as $item)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->id }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->unit_type }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <a href="{{ route('inventory.item.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                <form method="POST" action="{{ route('inventory.item.destroy', $item->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                No inventory items found. Add your first item above.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add focus functionality to all input fields
    const inputs = document.querySelectorAll('input, select');
    
    inputs.forEach(input => {
        // Add click event to focus the input
        input.addEventListener('click', function() {
            this.focus();
        });
        
        // Add focus event for visual feedback
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('border-blue-500', 'ring-2', 'ring-blue-200');
        });
        
        // Remove focus styles when input loses focus
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('border-blue-500', 'ring-2', 'ring-blue-200');
        });
    });
    
    // Special handling for select dropdown
    const select = document.getElementById('unit-type');
    if (select) {
        select.addEventListener('change', function() {
            if (this.value) {
                this.classList.add('text-gray-900');
            } else {
                this.classList.remove('text-gray-900');
            }
        });
    }
});
</script>
@endsection
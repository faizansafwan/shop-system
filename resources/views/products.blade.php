@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="w-full px-4">
  <div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4 border-b pb-2">
      <h4 class="text-xl font-semibold">Add Products</h4>
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

    <form method="POST" action="{{ isset($editProduct) ? route('products.update', $editProduct->id) : route('products.store') }}">
      @csrf
      @if(isset($editProduct))
          @method('POST') {{-- You can change to PUT if you like --}}
      @endif



      <!-- Name -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label for="item-name" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Product Name</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('item-name') ? 'border-red-500' : '' }}">
            <input 
              type="text" name="name" id="name"
                value="{{ old('name', $editProduct->name ?? '') }}"
                placeholder="Enter Product Name"
              class="w-full outline-none bg-transparent focus:outline-none" 
              autocomplete="off"
            />
          </div>
          @error('name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label for="item-name" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Product Code</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('item-name') ? 'border-red-500' : '' }}">
            <input 
              type="text" name="code" id="code"
                value="{{ old('code', $editProduct->code ?? '') }}"
                placeholder="Enter Product Code"
              class="w-full outline-none bg-transparent focus:outline-none" 
              autocomplete="off"
            />
          </div>
          @error('code')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label for="item-name" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Product Description</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('item-name') ? 'border-red-500' : '' }}">
            <input 
              type="text" name="description" id="description"
                value="{{ old('description', $editProduct->description ?? '') }}"
                placeholder="Enter Description"
              class="w-full outline-none bg-transparent focus:outline-none" 
              autocomplete="off"
            />
          </div>
          @error('description')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Buttons -->
      <div class="flex justify-end space-x-2 pt-4">
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
              {{ isset($editProduct) ? 'Update Product' : 'Add Product' }}
          </button>
          @if(isset($editProduct))
              <a href="{{ route('products.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">Cancel</a>
          @endif
      </div>

      
  </form>


    <!-- Inventory Table -->
    <div class="overflow-x-auto py-5">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Code </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Description</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($products as $product)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->id }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->code }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->description }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
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
    
   
});
</script>
@endsection
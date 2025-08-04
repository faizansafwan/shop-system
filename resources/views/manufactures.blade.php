@extends('layouts.app')

@section('title', 'Manufactures')

@section('content')
<div class="w-full px-4">
  <div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4 border-b pb-2">
      <h4 class="text-xl font-semibold">
        {{ isset($editManufacture) ? 'Edit Manufacture' : 'Add Manufacture' }}
      </h4>
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

    <form method="POST" action="{{ isset($editManufacture) ? route('manufactures.update', $editManufacture->id) : route('manufactures.store') }}">
      @csrf
      @if(isset($editManufacture))
        @method('PUT')
      @endif

      <!-- Product -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Product</label>
        <div class="sm:w-3/4 w-full">
          <select name="product_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-200">
            <option value="">Select a product</option>
            @foreach($products as $product)
              <option value="{{ $product->id }}" {{ old('product_id', $editManufacture->product_id ?? '') == $product->id ? 'selected' : '' }}>
                {{ $product->name }}
              </option>
            @endforeach
          </select>
          @error('product_id')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

    <!-- BAtch no -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label for="item-name" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Batch No.</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('item-name') ? 'border-red-500' : '' }}">
            <input 
              type="text" 
              id="batch_no" name="batch_no" 
              value="{{ old('batch_no', isset($editManufacture) ? $editManufacture->batch_no : '') }}"
              placeholder="Enter Batch Name" 
              class="w-full outline-none bg-transparent focus:outline-none" 
              autocomplete="off"
            />
          </div>
          @error('item-name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

    <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label for="item-name" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Price</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('item-name') ? 'border-red-500' : '' }}">
            <input 
              type="text" 
              id="price" name="price" 
              value="{{ old('price', isset($editManufacture) ? $editManufacture->price : '') }}"
              placeholder="Enter Price" 
              class="w-full outline-none bg-transparent focus:outline-none" 
              autocomplete="off"
            />
          </div>
          @error('item-name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>


      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label for="item-name" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Quantity</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('item-name') ? 'border-red-500' : '' }}">
            <input 
              type="text" 
              id="qty" 
              name="qty" 
              value="{{ old('item-name', isset($editManufacture) ? $editManufacture->qty : '') }}"
              placeholder="Enter Quantity" 
              class="w-full outline-none bg-transparent focus:outline-none" 
              autocomplete="off"
            />
          </div>
          @error('item-name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>


      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label for="item-name" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Expire Date</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('item-name') ? 'border-red-500' : '' }}">
            <input 
              type="text" 
              id="exp_date" 
              name="exp_date" 
              value="{{ old('item-name', isset($editManufacture) ? $editManufacture->exp_date : '') }}"
              placeholder="Enter expire Date" 
              class="w-full outline-none bg-transparent focus:outline-none" 
              autocomplete="off"
            />
          </div>
          @error('item-name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>


      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label for="item-name" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Manufacure Date</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('item-name') ? 'border-red-500' : '' }}">
            <input 
              type="text" 
              id="manufacture_date" 
              name="manufacture_date" 
              value="{{ old('item-name', isset($editManufacture) ? $editManufacture->manufacture_date : '') }}"
              placeholder="Enter Manufacture Date" 
              class="w-full outline-none bg-transparent focus:outline-none" 
              autocomplete="off"
            />
          </div>
          @error('item-name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>


      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label for="item-name" class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Description</label>
        <div class="sm:w-3/4 w-full">
          <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-colors {{ $errors->has('item-name') ? 'border-red-500' : '' }}">
            <input 
              type="text" 
              id="description" 
              name="description" 
              value="{{ old('description', isset($editManufacture) ? $editManufacture->description : '') }}"
              placeholder="Enter Description" 
              class="w-full outline-none bg-transparent focus:outline-none" 
              autocomplete="off"
            />
          </div>
          @error('item-name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>


     

      <!-- Buttons -->
      <div class="flex justify-end space-x-2 pt-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
          {{ isset($editManufacture) ? 'Update' : 'Add' }} Manufacture
        </button>
        @if(isset($editManufacture))
          <a href="{{ route('manufactures.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">Cancel</a>
        @endif
      </div>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto py-5">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 border-b">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 border-b">Product</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 border-b">Batch</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 border-b">Qty</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 border-b">Price</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 border-b">Exp</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 border-b">MFG</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 border-b">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($manufactures as $m)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm text-gray-900">{{ $m->id }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $m->product->name ?? '-' }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $m->batch_no }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $m->qty }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $m->price }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $m->exp_date }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $m->manufacture_date }}</td>
              <td class="px-6 py-4 text-sm text-gray-500">
                <a href="{{ route('manufactures.edit', $m->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                <form method="POST" action="{{ route('manufactures.destroy', $m->id) }}" class="inline" onsubmit="return confirm('Are you sure?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No manufactures found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

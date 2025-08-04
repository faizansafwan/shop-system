@extends('layouts.app')

@section('title', 'Expenses')

@section('content')
<div class="w-full px-4">
  <div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4 border-b pb-2">
      <h4 class="text-xl font-semibold">{{ isset($editExpense) ? 'Edit Expense' : 'Add Expense' }}</h4>
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

    <form method="POST" action="{{ isset($editExpense) ? route('expenses.update', $editExpense->id) : route('expenses.store') }}">
      @csrf
      @if(isset($editExpense))
        @method('PUT')
      @endif

      <!-- Name -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Expense Name</label>
        <div class="sm:w-3/4 w-full">
          <input 
            type="text" name="name" id="name"
            value="{{ old('name', $editExpense->name ?? '') }}"
            class="w-full border border-gray-300 rounded-md px-3 py-2 outline-none"
            placeholder="Enter name" autocomplete="off"
          />
          @error('name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Price -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Price</label>
        <div class="sm:w-3/4 w-full">
          <input 
            type="number" name="price" id="price" step="0.01"
            value="{{ old('price', $editExpense->price ?? '') }}"
            class="w-full border border-gray-300 rounded-md px-3 py-2 outline-none"
            placeholder="Enter price" autocomplete="off"
          />
          @error('price')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Description -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center py-2">
        <label class="sm:w-1/4 font-medium text-gray-700 mb-2 sm:mb-0">Description</label>
        <div class="sm:w-3/4 w-full">
          <textarea 
            name="description" id="description" rows="3"
            class="w-full border border-gray-300 rounded-md px-3 py-2 outline-none"
            placeholder="Optional notes">{{ old('description', $editExpense->description ?? '') }}</textarea>
          @error('description')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Submit Buttons -->
      <div class="flex justify-end space-x-2 pt-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
          {{ isset($editExpense) ? 'Update Expense' : 'Add Expense' }}
        </button>
        @if(isset($editExpense))
          <a href="{{ route('expenses.index') }}" class="px-4 py-2 border text-gray-700 rounded-md hover:bg-gray-50">Cancel</a>
        @endif
      </div>
    </form>

    <!-- Expenses Table -->
    <div class="overflow-x-auto py-6">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border-b">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border-b">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border-b">Price</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border-b">Description</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($expenses as $expense)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm text-gray-900">{{ $expense->id }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $expense->name }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ number_format($expense->price, 2) }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $expense->description }}</td>
              <td class="px-6 py-4 text-sm text-gray-500">
                <a href="{{ route('expenses.edit', $expense->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this expense?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No expense records found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

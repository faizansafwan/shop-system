@extends('layouts.app')

@section('title', 'Sells')

@section('content')
<div class="w-full px-4">
  <div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4 flex justify-between items-center border-b pb-2">
      <h4 class="text-xl font-semibold">Sales</h4>
      <a href="{{ route('sells.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Add Sale</a>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <!-- Sales Table -->
    <div class="overflow-x-auto py-5">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Shop</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Total</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Issue Date</th>

            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($sells as $sell)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $sell->shop->name ?? 'N/A' }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                Rs. {{ number_format(($sell->qty + $sell->extra_qty) * $sell->price - $sell->discount, 2) }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $sell->created_at->format('Y-m-d') }}
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 space-x-2">
                <a href="{{ route('sells.edit', $sell->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                <form method="POST" action="{{ route('sells.destroy', $sell->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                No sales records found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection

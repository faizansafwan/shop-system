<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/sells', function () {
    return view('sells');
});

// Route::get('/products', function () {
//     return view('products');
// });

Route::get('/expenses', function () {
    return view('expenses');
});

Route::get('/incomes', function () {
    return view('incomes');
});

Route::get('/shops', function () {
    return view('shops');
});


Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'store'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logouts', [AuthController::class, 'logout'])->name('user.logout');

// Inventory routes
Route::prefix('inventory')->group(function () {
    Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');
    Route::post('/', [InventoryController::class, 'store'])->name('inventory.store');
    Route::get('/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::post('/{id}/update', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
});

// Inventory Item routes
Route::prefix('inventory-item')->group(function () {
    Route::get('/', [InventoryItemController::class, 'index'])->name('inventory.item.index');
    Route::post('/', [InventoryItemController::class, 'store'])->name('inventory.item.store');
    Route::get('/{id}', [InventoryItemController::class, 'edit'])->name('inventory.item.edit');
    Route::post('/{id}/update', [InventoryItemController::class, 'update'])->name('inventory.item.update');
    Route::delete('/{id}', [InventoryItemController::class, 'destroy'])->name('inventory.item.destroy');
});

// Product routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});


// Shop routes
Route::prefix('shops')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shops.index');
    Route::post('/', [ShopController::class, 'store'])->name('shops.store');
    Route::get('/{id}', [ShopController::class, 'edit'])->name('shops.edit');
    Route::post('/{id}/update', [ShopController::class, 'update'])->name('shops.update');
    Route::delete('/{id}', [ShopController::class, 'destroy'])->name('shops.destroy');
});


// Manufactures routes
Route::prefix('manufactures')->group(function () {
    Route::get('/', [ManufactureController::class, 'index'])->name('manufactures.index');
    Route::post('/', [ManufactureController::class, 'store'])->name('manufactures.store');
    Route::get('/{id}', [ManufactureController::class, 'edit'])->name('manufactures.edit');
    Route::put('/{id}/update', [ManufactureController::class, 'update'])->name('manufactures.update');
    Route::delete('/{id}', [ManufactureController::class, 'destroy'])->name('manufactures.destroy');
});


// income routes
Route::prefix('incomes')->group(function () {
    Route::get('/', [IncomeController::class, 'index'])->name('incomes.index');
    Route::post('/', [IncomeController::class, 'store'])->name('incomes.store');
    Route::get('/{id}', [IncomeController::class, 'edit'])->name('incomes.edit');
    Route::put('/{id}/update', [IncomeController::class, 'update'])->name('incomes.update');
    Route::delete('/{id}', [IncomeController::class, 'destroy'])->name('incomes.destroy');
});


// expense routes
Route::prefix('expenses')->group(function () {
    Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::post('/', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/{id}', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/{id}/update', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
});


// sells routes
Route::prefix('sells')->group(function () {

    Route::get('/add', function () {
        $shops = \App\Models\Shop::all();
        $latestSale = \App\Models\Sell::latest()->first();
        $saleId = $latestSale ? $latestSale->id + 1 : 1;
    
        return view('newSale', compact('shops', 'saleId'));
    })->name('sells.create');
    

    Route::get('/', [SellController::class, 'index'])->name('sells.index');
    Route::post('/', [SellController::class, 'store'])->name('sells.store');
    Route::get('/{id}', [SellController::class, 'edit'])->name('sells.edit');
    Route::put('/{id}/update', [SellController::class, 'update'])->name('sells.update');
    Route::delete('/{id}', [SellController::class, 'destroy'])->name('sells.destroy');
});


// payments routes
Route::prefix('payments')->group(function () {
    Route::get('/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
    // Route::put('/{id}/update', [PaymentController::class, 'update'])->name('expenses.update');
    // Route::delete('/{id}', [PaymentController::class, 'destroy'])->name('expenses.destroy');
});





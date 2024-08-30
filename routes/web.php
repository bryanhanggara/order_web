<?php

use App\Models\products;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('products', ProductsController::class);
    
    Route::get('data', function(){
        return DataTables::of(products::query())
        ->addColumn('aksi', function ($product) {
            return '<div class="d-flex justify-content-start">
                        <a href="' . route('products.edit', $product->id) . '" class="btn btn-warning btn-sm me-2" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="' . route('products.destroy', $product->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>';
        })
        ->rawColumns(['aksi'])
        ->make(true);
    })->name('data');

})->middleware(['auth', 'verified', 'isAdmin']);

Route::prefix('home')->group(function(){
    Route::get('products/list', [ProductController::class, 'list'])->name('products.list');
    Route::resource('orders', OrderController::class);
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

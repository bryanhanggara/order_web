<?php

use App\Models\order;
use App\Models\products;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\HistoryOrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('home')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('products', ProductsController::class);
    Route::resource('orders', OrderController::class);
    Route::get('products/list', [ProductController::class, 'list'])->name('products.list');
    Route::get('history', [HistoryOrderController::class,'historyOrder'])->name('history');
    Route::get('/history/{id}', [HistoryOrderController::class, 'show'])->name('history.show');

    
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

    Route::get('order-data', function() {
        return DataTables::of(\App\Models\order::with('items')
            ->where('user_id', auth()->id())
            ->get())
            ->addColumn('aksi', function ($order) {
                return '<div class="d-flex justify-content-start">
                            <a href="' . route('history.show', $order->id) . '" class="btn btn-info btn-sm me-2" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                        </div>';
            })
            ->addColumn('total', function ($order) {
                return $order->items->sum(function ($item) {
                    return $item->quantity * $item->price;
                });
            })
            ->editColumn('created_at', function ($order) {
                return $order->created_at->format('Y-m-d');
            })
             ->rawColumns(['aksi'])
            ->make(true);
    })->name('order-data');
    

})->middleware(['auth']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

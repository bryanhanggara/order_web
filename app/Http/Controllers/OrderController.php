<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\products;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); 
        
        $orders = Order::with('items') 
            ->where('user_id', $userId)
            ->whereDate('created_at', now()->toDateString()) // Hari ini
            ->get();

        $totalRupiah = $orders->reduce(function ($carry, $order) {
            // Cek apakah order_items tidak null
            if ($order->items) {
                return $carry + $order->items->reduce(function ($carry, $item) {
                    return $carry + ($item->quantity * $item->price);
                }, 0);
            }
            return $carry;
        }, 0);

        return view('order.index', compact('totalRupiah'));
    }


    public function create()
    {
        $products = products::all(); 

        return view('order.create', compact('products'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);
    
        $totalPrice = 0;

        $order = order::create([
            'user_id' => auth()->id(),
            'total_price' => 0,
            'status' => 'pending',
        ]);

        foreach ($request->input('products', []) as $productData) {
            $product = products::findOrFail($productData['id']);

            if ($product->stock < $productData['quantity']) {
                return redirect()->back()->withErrors(['Stock for product ' . $product->name . ' is insufficient.']);
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productData['id'],
                'quantity' => $productData['quantity'],
                'price' => $product->price,
                'total' => $productData['quantity'] * $product->price,
            ]);

            $product->stock -= $productData['quantity'];
            $product->save();
        }
        return redirect()->route('orders.create')->with('success', 'Pesanan berhasil dibuat!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\products;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
        ]);
    
        $totalPrice = 0;

        $order = order::create([
            'user_id' => auth()->id(),
            'total_price' => 0,
            'status' => 'pending',
        ]);

        foreach ($validated['products'] as $productData) {
            $product = products::find($productData['id']);
            $total = $product->price * $productData['quantity'];
    
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productData['id'],
                'quantity' => $productData['quantity'],
                'price' => $product->price,
                'total' => $total,
            ]);
    
            $totalPrice += $total;
        }
    
        $order->update(['total_price' => $totalPrice]);

        return redirect()->route('orders.create')->with('success', 'Pesanan berhasil dibuat!');
    }
}

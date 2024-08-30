<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class HistoryOrderController extends Controller
{
    public function historyOrder()
    {
        return view('order.history');   
    }

    public function show($id)
    {
        $order = order::with('items.product') 
            ->where('id', $id)
            ->where('user_id', auth()->id()) 
            ->firstOrFail();
    
        return view('order.show', compact('order'));
    }
    
}

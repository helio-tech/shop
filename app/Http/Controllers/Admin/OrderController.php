<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('admin.orders.index', compact('orders'));
    }

    public function confirm(Order $order)
    {
        $order->update([
            'staff_id' => Auth::id()
        ]);

        return redirect()->route('admin.orders.index');
    }
}

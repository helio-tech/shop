<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function show()
    {
        return view('guest.payment.show');
    }

    public function store(Request $request)
    {
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'password' => ''
            ]
        );

        $order = DB::transaction(function () use ($user) {
            $order = Order::create([
                'staff_id' => null,
                'customer_id' => $user->id,
            ]);

            foreach(Cart::content() as $cart_item) {
                $order->items()->create([
                    'price_id' => $cart_item->name->currentPrice->id,
                    'quantity' => $cart_item->qty
                ]);
                Cart::remove($cart_item->rowId);
            }

            return $order;
        });

        return redirect()->route('guest.orders.show', $order);
    }
}

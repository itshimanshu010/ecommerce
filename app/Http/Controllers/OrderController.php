<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
            // Retrieve user and cart items
            $user = auth()->user();
            $cartItems = json_decode($request->input('cart_items'));

            // Create a new order
            $order = new Order();
            $order->user_id = $user->id;
            $order->status = 'pending';
            $order->save();

            // Create order details for each cart item
            foreach ($cartItems as $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $item->id;
                $orderDetail->user_id = $user->id;
                $orderDetail->quantity = $item->quantity;
                $orderDetail->price = $item->unit_price;
                $orderDetail->amount = $item->quantity * $item->unit_price;
                $orderDetail->status = 'pending';
                $orderDetail->save();
            }
        
            // Clear the user's cart (optional)
            // Assuming you have a method to clear the cart
            // $user->clearCart();
        
            return response()->json([
                "status" => 1,
                "message" => "Order placed successfully",
            ]);

    }
}

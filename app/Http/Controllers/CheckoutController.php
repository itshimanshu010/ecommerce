<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function checkoutCart()
    {
        $cartItems = Basket::where("user_id", auth()->id())
            ->where("status", "active")
            ->where("checked", 1)
            ->get();

        foreach ($cartItems as $item) {
            // Retrieve the product based on the product_id stored in the basket
            $product = Product::findOrFail($item->product_id);
            // Update the cart item with the product name
            $item->title = $product->title;
            $item->image =
                asset("public/admin/images/product/") . "/" . $product->images;
        }

        return view("frontend.checkout.checkout", ["cartItems" => $cartItems]);
    }

    public function updateCheckoutSummary()
    {
        $user = auth()->user();
    
        // Retrieve checked items from the database
        $checkedItems = Basket::where('user_id', $user->id)
                              ->where('status', 'active')
                              ->where('checked', 1)
                              ->get();
    
        // Calculate subtotal, shipping, and total based on the checked items
        $subtotal = 0;
        foreach ($checkedItems as $item) {
            $subtotal += $item->total;
        }
    
        // Calculate shipping charge
        $shipping = $subtotal < 500 ? 49 : 0;
    
        // Calculate total
        $total = $subtotal + $shipping;
    
        // Return JSON response with updated values
        return response()->json([
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total
        ]);
    }

}

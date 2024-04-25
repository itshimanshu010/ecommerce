<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     


    public function showCart()
    {
        
         
            $cartItems = Basket::where('user_id', auth()->id())
                                ->where('status', 'active')
                                ->get();

                                foreach ($cartItems as $cartItem) {
                                    // Retrieve the product based on the product_id stored in the basket
                                    $product = Product::findOrFail($cartItem->product_id);
                                    // Update the cart item with the product name
                                    $cartItem->title = $product->title;
                                    $cartItem->image=asset('public/admin/images/product/').'/'.$product->images;
                                }
                               
    
            return response()->json(['cartItems' => $cartItems]);
        
    }

    public function index()
    {$cartItems = Basket::where('user_id', auth()->id())
        ->where('status', 'active')
        ->get();
        foreach ($cartItems as $item) {
            // Retrieve the product based on the product_id stored in the basket
            $product = Product::findOrFail($item->product_id);
            // Update the cart item with the product name
            $item->title = $product->title;
            $item->image=asset('public/admin/images/product/').'/'.$product->images;
        }
        return view('frontend.home.cart', ['cartItems' => $cartItems]);
    }


    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $user = auth()->user();
    
        // Check if the item already exists in the user's cart
        $basket = Basket::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->where('status', 'active')
                        ->first();
    
        if ($basket) {
                
            $basket->quantity += 1;
            $basket->total = $basket->unit_price * $basket->quantity;
            $basket->save();
        } else {
            // If the item doesn't exist
            $product = Product::findOrFail($productId);
            $unitPrice = $product->price;
            $quantity = 1;
    
            $basket = new Basket();
            $basket->user_id = $user->id;
            $basket->product_id = $productId;
            $basket->status = 'active';
            $basket->quantity = $quantity;
            $basket->unit_price = $unitPrice;
            $basket->total = $unitPrice * $quantity; 
            $basket->save();
        }
    
        return response()->json([
            'status'=> 1,
            'message' => 'Product added to cart successfully',
        ]);
    }
    
    public function removeItem(Request $request)
    {
       
        $item = Basket::find($request->basket_id);
        if ($item) {
             $item->delete();
                return response()->json(['message' => 'Item removed successfully']);
                }
        return response()->json(['message' => 'Item not found'], 404);
    }

    public function removeCartItem(Request $request)
    {
        $item = Basket::find($request->id);
    
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
    
        $item->delete();
        return response()->json(['message' => 'Item removed successfully']);
    }

    public function checkoutCart()
    {
             $cartItems = Basket::where('user_id', auth()->id())
                                ->where('status', 'active')
                                
                                ->get();

             foreach ($cartItems as $item) {
                 // Retrieve the product based on the product_id stored in the basket
                 $product = Product::findOrFail($item->product_id);
                 // Update the cart item with the product name
                 $item->title = $product->title;
                 $item->image = asset('public/admin/images/product/') . '/' . $product->images;
             }

             return view('frontend.home.checkout', ['cartItems' => $cartItems]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function show(Basket $basket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function edit(Basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Basket $basket)
    {
        //
    }
}

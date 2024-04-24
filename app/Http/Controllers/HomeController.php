<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Basket;

class HomeController extends Controller
{
    public function index()
    {
    
        return view('frontend.home.index');
    }

    public function shopPage()
    {
        $products = Product::all();
        return view('frontend.home.shop', compact('products'));
    }

    public function singleProduct(Product $records, $id)
    {
       $product = Product::findOrFail($id);
       $productVariants = $product->variants;
        return view('frontend.home.singleproduct', compact('product', 'productVariants'));
    }

    
}

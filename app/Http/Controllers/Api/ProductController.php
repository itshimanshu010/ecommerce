<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{   
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index($id)
    {
        $product = Product::withfind($id);

        if ($product) {
            $productData = [
                'id' => $product->id,
                'title' => $product->title,
                'image_url' => asset('admin/images/product/' . $product->images),
                'status' => $product->status,
                'quantity' => $product->quantity,
                'price' => $product->price,
                'category_id' => $product->category_id,
                'sub_category_id' => $product->sub_category_id,
            ];
    
            return response()->json([
                'status' => 1,
                'message' => 'Product found',
                
                'data' => $productData,
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Product not found',
               
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
{
    $products = Product::with(['category:id,name,image'])->get();

    if ($products->isNotEmpty()) {
        // $productsData = $products->map(function ($product) {
        //     return [
        //         'id' => $product->id,
        //         'title' => $product->title,
        //         'image_url' => asset('public/admin/images/product/' . $product->images),
        //         'status' => $product->status,
        //         'quantity' => $product->quantity,
        //         'price' => $product->price,
        //         'category_id' => $product->category_id,
        //         'sub_category_id' => $product->sub_category_id,
        //     ];
        // });

        return response()->json([
            'status' => 1,
            'message' => $products->count() . " products found",
            
            'data' => $products,
        ], 200);
    } else {
        return response()->json([
            'status' => 0,
            'message' => "No products found",
          
        ], 200);
    }
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', 'string', 'in:active,inactive'],
            'quantity' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'sub_category_id' => ['required', 'exists:sub_categories,id'],
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors()->first(),
            ]);
        } else {
            $data = [
                'title' => $request->title,
                'status' => $request->status,
                
                'quantity' => $request->quantity,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
            ];
    
            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('admin/images/product/'), $imageName);
                $data['images'] = $imageName;
            }
            $slug = Str::slug($request->input('title'));
            $data['slug'] = $slug;

            DB::beginTransaction();
    
            try {
                $product = Product::create($data);
                DB::commit();
            
            } catch (\Exception $e) {
                DB::rollBack();
                p($e->getMessage());
                $product = null;
            }

            if($product != null){
                return response()->json([
                    'status' => 1,
                    'message'=>'product registerd successfully',
                    'data' => $product
                ],200);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message'=>'internal server error'
                ],500);
            }
        }
    }
    

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
   
    $validator = Validator::make($request->all(), [
        'title' => ['required', 'string', 'max:255'],
        'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'quantity' => ['required', 'integer', 'min:0'],
        'price' => ['required', 'numeric', 'min:0'],
    ]);

    if ($validator->fails()) {
        dd($validator->errors());
        return response()->json([
            'status' => 0,
            'message' => $validator->errors()->first(),
        ]);
    }

    $product = Product::find($id);

    if (is_null($product)) {
        return response()->json([
            'status' => 0,
            'message' => 'Product not found'
        ], 404);
    }

    DB::beginTransaction();

    try {
        
        $product->fill($request->all())->save();
        $product->title = $request->input('title');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images/product/'), $imageName);
            $product->images = $imageName;
        }

        if ($product->isDirty('title')) {
            $product->slug = Str::slug($product->title);
        }

        $product->save();
        DB::commit();

        return response()->json([
            'status' => 1,
            'message' => 'Product updated successfully',
            'data' => $product
        ], 200);
    } catch (\Exception $err) {
        DB::rollBack();
        return response()->json([
            'status' => 0,
            'message' => 'Internal server error',
            'error_msg' => $err->getMessage()
        ], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 0,
                'message' => 'Product not found'], 404);
        }
    
        $product->delete();
    
        return response()->json([
            'status' => 1,
            'message' => 'Product deleted successfully']);
    }

    public function addVariant(Request $request, $productId)
    {
        // Validate the incoming request data
        $request->validate([
            'color' => 'required|string',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the product
        $product = Product::findOrFail($productId);

        // Create a new product variant
        $variant = new ProductVariant();
        $variant->product_id = $productId;
        $variant->color = $request->input('color');
        $variant->size = $request->input('size');
        $variant->quantity = $request->input('quantity');
        $variant->status = 'active'; // You can set a default status here or in the migration
        $variant->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product variant added successfully.');
    }




}

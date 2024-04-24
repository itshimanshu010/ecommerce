<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;




class ProductController extends Controller
{
    public function index(){
      
        $products = Product::all(); 
        $categories=Category::orderBy('id',"desc")->get();
        $subcategories=SubCategory::orderBy('id',"desc")->get();
        $products = Product::with('category', 'subcategory')->get();
        return view('admin.products.index',compact('categories','subcategories','products'));
    }

    public function create(){
        $product = new Product();
        $categories = Category::orderBy('name', 'ASC')->get();
        $subcategories = SubCategory::orderBy('name', 'ASC')->get();
        return view('admin.products.create', compact('product', 'categories', 'subcategories'));
    }



    public function store(Request $request){

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', 'string', 'in:active,inactive'],
            'quantity' => ['nullable', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'], 
            'category_id' => ['required', 'exists:categories,id'],
            'sub_category_id' => ['required', 'exists:sub_categories,id'],
        ]);

        $slug = Str::slug($request->input('title'));
        $validated['slug'] = $slug;

    
        if($request->hasFile('images')) {
            $file = $request->file('images');
            $image_name = time().'.'.$request->file('images')->getClientOriginalExtension();
            
                if (!file_exists(public_path('admin/images/product/'))) {
                    mkdir(public_path('admin/images/product/'), 0777, true);
                }

            $file->move(public_path('admin/images/product/'),$image_name);
            $validated['images'] = $image_name;
            
        }
        $product = Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully.');
    }
        
    

    public function edit(Category $records, $id) {

        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $subcategories = SubCategory::orderBy('name')->get();
        
        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', 'string', 'in:active,inactive'],
            'quantity' => ['nullable', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'sub_category_id' => ['required', 'exists:sub_categories,id'],
        ]);
        
        $slug = Str::slug($request->input('title'));

        $validated['slug'] = $slug;


        if($request->hasFile('images')) {
            $file = $request->file('images');
            
            $old_image = $product->image;
            $image_path = public_path('admin/images/product/'.$old_image);
            $image_name = time().'.'.$request->file('images')->extension();
            
            if (!file_exists(public_path('admin/images/product/'))) {
                mkdir(public_path('admin/images/product/'),0777, true);
            }

            if(File::exists($image_path)){
                File::delete($image_path);
            }
            if($file->move(public_path('admin/images/product/'),$image_name)){
                $validated['images'] = $image_name;
            }
        }
       
        $product->update($validated);
      
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        
}



    public function destroy(Request $request, $id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }


    public function showVariantCreateForm($id)
        {
            $product = Product::findOrFail($id);
          return view('admin.products.product_variant',compact('product'));

        }

    public function storeVariant(Request $request, $id)
    {   
 
    $product = Product::find($id);
    $validated = $request->validate([
        'color.*' => 'required',
        'size.*' => 'required',
        'quantity.*' => 'required|integer|min:1',
    ],
    [
        'color.*.required' => 'The color field is required.',
        'size.*.required' => 'The size field is required.',
        'quantity.*.required' => 'The quantity field is required.'
    ]);

    $variants = [];

    foreach ($validated['color'] as $key => $color) {
        $variant = new ProductVariant();
        $variant->product_id = $id;
        $variant->color = $validated['color'][$key];
        $variant->size = $validated['size'][$key];
        $variant->quantity = $validated['quantity'][$key];
        $variants[] = $variant;
    }

   
    $saved = false;

    if ($product && count($variants) > 0) {
        $saved = $product->variants()->saveMany($variants);
    }

    if ($saved) {
        return redirect()->back()->with('success', 'Product variants added successfully.');
    } else {
        
        return redirect()->back()->with('error', 'Failed to add product variants. Please try again.');
    }
    }

}

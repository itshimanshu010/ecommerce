<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use File;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::orderBy('id',"desc")->get();
        return view('admin.categories.index',compact('categories'));
    }

    public function create(){
        $category = new Category;
        return view('admin.categories.create',compact('category'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', 'string', 'in:active,inactive'], 
        ]);

        $category = new Category;

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $old_image = $category->image;
            $image_path = public_path('admin/images/category/'.$old_image);
            $image_name = time().'.'.$request->file('image')->extension();
            
            if (!file_exists(public_path('admin/images/category/'))) {
                mkdir(public_path('admin/images/category/'), 0777, true);
            }

            
            $file->move(public_path('admin/images/category/'),$image_name);
            $validated['image'] = $image_name;
            
        }

       
        
     $category = Category::create($validated);

     $category->save();   
     return redirect()->route('admin.categories.index')->with('success', 'Added successfully');
        
    }

    public function edit(Category $records, $id){
        
        $category = Category::findOrfail($id);
        return view('admin.categories.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        
        $category = Category::findOrfail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', 'string', 'in:active,inactive'], 
        ]);
        
        if($request->hasFile('image')) {
            $file = $request->image;
            $old_image = $category->image;
            $image_path = public_path('admin/images/category/'.$old_image);
            $image_name = time().'.'.$request->file('image')->extension();
            
            if (!file_exists(public_path('admin/images/category/'))) {
                mkdir(public_path('admin/images/category/'), true);
            }

            if(File::exists($image_path)){
                File::delete($image_path);
            }
            if($file->move(public_path('admin/images/category/'),$image_name)){
                $validated['image'] = $image_name;
            }
        }
       
        $category->update($validated);
      
        return redirect()->route('admin.categories.index')->with('success', 'List Updated successfully');
}

    public function destroy($id){
        $category = Category::findOrfail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Deleted successfully');
    }
}

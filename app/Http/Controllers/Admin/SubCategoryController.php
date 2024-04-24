<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\File;


class SubCategoryController extends Controller
{
    public function index(){
        $records=SubCategory::orderBy('id',"desc")->get();
        return view('admin.subcategories.index',compact('records'));
    }

    public function create(){
        $categories = Category::orderBy('name','ASC')->get();
        return view('admin.subcategories.create',compact('categories'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', 'string', 'in:active,inactive'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $subcategory = new SubCategory();

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $old_image = $subcategory->image;
            $image_path = public_path('admin/images/subcategory/'.$old_image);
            $image_name = time().'.'.$request->file('image')->extension();
            
            if (!file_exists(public_path('admin/images/subcategory/'))) {
                mkdir(public_path('admin/images/subcategory/'), 0777, true);
            }

            
            $file->move(public_path('admin/images/subcategory/'),$image_name);
            $validated['image'] = $image_name;
            
        }

       
        
     $subcategory = SubCategory::create($validated);

     $subcategory->save();  
     return redirect()->route('admin.subcategories.index')->with('success', 'Added successfully');
        
    }

    public function edit($id){
        $subcategory = SubCategory::findOrfail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrfail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', 'string', 'in:active,inactive'],
            'category_id' => ['required', 'exists:categories,id'], 
        ]);
        
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $old_image = $subcategory->image;
            $image_path = public_path('admin/images/subcategory/'.$old_image);
            $image_name = time().'.'.$request->file('image')->extension();
            
            if (!file_exists(public_path('admin/images/subcategory/'))) {
                mkdir(public_path('admin/images/subcategory/'), true);
            }

            if(File::exists($image_path)){
                File::delete($image_path);
            }
            if($file->move(public_path('admin/images/subcategory/'),$image_name)){
                $validated['image'] = $image_name;
            }
        }
        
        $subcategory->update($validated);
      
        return redirect()->route('admin.subcategories.index')->with('success', 'List Updated successfully');
}

    public function destroy($id){
        $subcategory = SubCategory::findOrfail($id);
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index')->with('success', 'Deleted successfully');
    }
}

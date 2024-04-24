<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ChangePasswordRequest;
use Illuminate\Validation\Rule;
use Auth;
use Hash;
use File;

class LoginController extends Controller
{
    public function showLoginForm()
    {   
        $admin = new Admin();
        return view('admin.auth.login',compact('admin'));
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required'],
        ]);
    
        if (Auth::guard('admin')->attempt($credentials)) {
           
            return redirect()->route('admin.dashboard.index')->with('success', 'Login successfully');
        } else {
            
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.showLoginForm');
    }

    public function adminPassword()
    {
        $admin = Admin::findOrfail(1);  
      return view('admin.info.changepassword', compact('admin'));
    }

    public function passwordUpdate(ChangePasswordRequest $request, $id)
    {
        $validated = $request->validated();
        $admin = Admin::findOrfail($id);
        
        
        if($request->password){
            $validated['password'] = Hash::make($request->password);
        }

        $admin->fill($validated);
        
        // $user->password = Hash::make($validated['password']);
        $admin->save();
        return redirect()->route('admin.dashboard.index')->with('success', 'Password Updated successfully');
    }

    public function adminProfile(){
        $admin = Admin::findOrfail(1);  
        return view('admin.info.profile-info', compact('admin'));
    }

    public function profileUpdate(Request $request){
       
        $admin = Auth::guard('admin')->user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('admins')->ignore($admin->id)],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', 'string', 'in:active,inactive'], 
        ]);
        
        if($request->hasFile('image')) {
            $file = $request->image;
            $old_image = $admin->image;
            $image_path = public_path('admin/images/profile/'.$old_image);
            $image_name = time().'.'.$request->file('image')->extension();
            
            if (!file_exists(public_path('admin/images/profile'))) {
                mkdir(public_path('admin/images/profile'), true);
            }

            if(File::exists($image_path)){
                File::delete($image_path);
            }
            if($file->move(public_path('admin/images/profile'),$image_name)){
                $validated['image'] = $image_name;
            }
        }
        $admin->update($validated);
      
        return redirect()->route('admin.adminProfile')->with('success', 'Profile Updated successfully');
    } 

    

}

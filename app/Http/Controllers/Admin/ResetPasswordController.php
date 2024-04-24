<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class ResetPasswordController extends Controller
{
    public function adminReset()
    {    
        $admin = new Admin();
        return view('admin.auth.resetpassword',compact('admin'));
    }

    
    

}

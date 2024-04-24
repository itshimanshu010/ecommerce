<?php

namespace App\Http\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;
use Hash;
use Auth;
class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_password' => 'required|current_password:admin|different:password',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages(){
        return [
            'old_password.current_password' => 'The current password field is incorrect.',
        ];
    }
    // public function withValidator($validator){
    //     $validator->after(function($validator){
    //         if (!Hash::check($this->old_password,  Auth::guard('admin')->user()->password) ) {
    //             $validator->errors()->add('old_password', 'The current password field is incorrect.');
    //         }
    //     });
    // }
}

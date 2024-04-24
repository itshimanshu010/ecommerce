@extends('layout.admin.app')
@section('title','Reset Page')
@section('content')

<div class="auth-form-light text-left p-5">
                
               
                <h6 class="font-weight-light">Reset Your Password</h6>
                <div class="font-weight-light   ">
        <p>Forgot your password ? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
    </div>
                <form class="pt-3" method="post" action="{{ route('password.email') }}">
                 @csrf
                <div class="form-group">
                    <input id="email" type="email" name="email" value="{{ old('email',$admin->email) }}" class="form-control" name="email" placeholder="example@email.com">
                            @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                  </div>
                    
                 

                  <div class="mt-3 d-flex justify-content-center align-items-center">
                    <button class="btn btn-block btn-gradient-primary text-center btn-lg font-weight-medium auth-form-btn" type="submit">Email Password Reset Link</button>
                  </div>
                  

                  
                        
                </form>
              </div>
@endsection
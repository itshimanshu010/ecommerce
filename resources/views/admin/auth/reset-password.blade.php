@extends('layout.admin.app')
@section('title','Login Page')
@section('content')

<div class="auth-form-light text-left p-5">
                
               
                <h6 class="font-weight-light">Reset Your Password</h6>
              <form class="pt-3" method="post" action="{{ route('admin.password.store') }}">
              @csrf

              <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group">
                        
                        <input id="email" type="email" value="{{ old('email', $request->email) }}" name="email" class="form-control form-control-lg " placeholder="example@email.com"  >
                        @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                    </div>

                    <div class="row mb-4">
                            <div class="col">
                                
                                <input type="password" class="form-control " type="password"
                            name="password" placeholder="Enter Your Password" style="border-radius: 10px;">
                            @if($errors->has("password"))
                            <span class="error-message">{{ $errors->first('password') }}</span>
                            @endif
                            </div>
                            <div class="col">
                                
                                <input type="password"   name="password_confirmation"  id="password_confirmation" class="form-control" placeholder="Re-enter Your Password" style="border-radius: 10px;">
                                @if($errors->has("password_confirmation"))
                                    <span class="error-message">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-3 d-flex justify-content-center align-items-center">
                    <button class="btn btn-block btn-gradient-primary text-center btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                  </div>
                    

                </form>
            </div>
         

@endsection
   


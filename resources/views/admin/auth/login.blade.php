@extends('layout.admin.app')
@section('title','Login Page')
@section('content')
<div class="auth-form-light text-left p-5">
                
               
                <h6 class="font-weight-light">Admin Login</h6>
                <form class="pt-3" method="post" action="{{ route('admin.adminLogin') }}">
                 @csrf
                <div class="form-group">
                    <input id="email" type="email" name="email" value="{{ old('email',$admin->email) }}"  class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                            @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                  </div>

                  <div class="form-group">
                    <input id="password" name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                    @if($errors->has("password"))
                    <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                  </div>

                  <div class="mt-3 d-flex justify-content-center align-items-center">
                    <button class="btn btn-block btn-gradient-primary text-center btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-center align-items-center">
                    <!-- <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                    </div> -->
                    <a href="{{ route('admin.adminReset') }}" class="auth-link text-black">Forgot password?</a>
                  </div>
                        
                </form>
              </div>
@endsection
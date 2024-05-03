@extends('layout.main')
@section('content')

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center" style="margin-top: 50px;">
          
          <h2 class="text-center">Create Your Account</h2>
          <form method="post" action="{{ route('firebaseRegister') }}">
          @csrf
            <div class="form-group">
              <input id="name" class="form-control" type="text"  name="name" :value="old('name')"   placeholder="Full Name">
              @if($errors->has("name"))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                            @endif
            </div>
            
            <div class="form-group">
              <input  id="email" name="email" :value="old('email')"   type="email" class="form-control"  placeholder="Email">
              @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control"  placeholder="Password">
              @if($errors->has("password"))
                            <span class="error-message">{{ $errors->first('password') }}</span>
                            @endif
            </div>

            <div class="form-group">
              <input name="password_confirmation"  id="password_confirmation"  type="password" class="form-control"  placeholder="Confirm Password">
              @if($errors->has("password"))
                                    <span class="error-message">{{ $errors->first('password') }}</span>
                                @endif
            </div>

            <div class="text-center">
              <button class="btn btn-main text-center">Register</button>
            </div>
          </form>
          <p class="mt-20">Already hava an account ?<a href="{{ route('showUserLoginForm') }}"> Login</a></p>
          <p><a href="{{ route('forgotPassword') }}"> Forgot your password?</a></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 
<div class="mask d-flex align-items-center h-100 ">
    <div class="container" style="color:black;">
      <div class="row d-flex justify-content-center align-items-center h-100"style="margin-top: 50px; margin-bottom:50px;">
        <div class=" col-md-7 col-lg-6 col-xl-6 border border-dark border-3" style="border-radius: 50px; background:#EDF1FF;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Registration</h2>
              <form method="post" action="{{ route('register') }}">
              @csrf

              <div class=" mb-4 form-group">
                            <label for="name" :value="__('Name')">Full Name</label>
                            <input id="name" class="form-control" type="text"  name="name" :value="old('name')" placeholder="John" style="border-radius: 10px;">
                            @if($errors->has("name"))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                            @endif
              </div>
                            
              <div class=" mb-4 form-group">
                  <label for="email" :value="__('Email')">E-mail</label>
                  <input id="email" name="email" :value="old('email')" class="form-control" type="email" placeholder="example@email.com"style="border-radius: 10px;">
                            @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif

                </div>

              <div class="row mb-4">
                            <div class="col">
                                <label id="password" for="password" :value="__('Password')">Password</label>
                                <input type="password" class="form-control" 
                            name="password" placeholder="Enter Your Password" style="border-radius: 10px;">
                            @if($errors->has("password"))
                            <span class="error-message">{{ $errors->first('password') }}</span>
                            @endif
                            </div>
                            <div class="col">
                                <label for="password_confirmation" :value="__('Confirm Password')">Confirm Password</label>
                                <input type="password"   name="password_confirmation"  id="password_confirmation" class="form-control" placeholder="Re-enter Your Password" style="border-radius: 10px;">
                                @if($errors->has("password_confirmation"))
                                    <span class="error-message">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>

                    

                        <div class="card-text  bg-transparent text-center ">
                        <button class="btn btn-lg rounded btn-primary my-3 py-3">Register</button>
                        </div>
</form>
</div>
</div>
</div>
</div>
</div> -->
@endsection
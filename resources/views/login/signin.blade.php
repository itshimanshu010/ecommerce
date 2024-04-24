@extends('layout.main')
@section('content')
{{Auth::user();}}

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center" style="margin-top: 50px;">
        
          <h2 class="text-center">Login</h2>
          <form class="text-left clearfix" method="post" action="{{ route('userLogin') }}">
          @csrf 
          <div class="form-group">
              <input id="email" type="email" name="email" value="{{ old('email',$user->email) }}" type="email" class="form-control"  placeholder="Email">
              @if($errors->has("email"))
                   <span class="error-message">{{ $errors->first('email') }}</span>
              @endif
            </div>

            <div class="form-group">
              <input id="password" name="password" type="password" class="form-control" placeholder="Password">
              @if($errors->has("password"))
                            <span class="error-message">{{ $errors->first('password') }}</span>
              @endif
            </div>
            <div class="text-center">
              <button  class="btn btn-main text-center" >Login</button>
            </div>
          </form>
          <p class="mt-20"><a href="{{ route('forgotPassword') }}"> Forgot password</a></p>
          <p class="mt-20">New in this site ?<a href="{{ route('showRegisterForm') }}"> Create New Account</a></p>
          
        </div>
      </div>
    </div>
  </div>
</section>
<!-- 
<div class="mask d-flex align-items-center h-100 text-body ">
    <div class="container" style="color:black;">
      <div class="row d-flex justify-content-center align-items-center h-100" style="margin-top: 50px; margin-bottom:50px;">
        <div class=" col-md-9 col-lg-7 col-xl-6 border border-dark border-3" style="border-radius: 50px; background:#EDF1FF;" >
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Login</h2>
              <form method="post" action="{{ route('userLogin') }}">
              @csrf
                    <div class=" mb-4 form-group">
                        <label for="email" :value="__('Email')" >E-mail</label>
                        <input id="email" type="email" name="email" value="{{ old('email',$user->email) }}"class="form-control " type="text" placeholder="example@email.com"  style="border-radius: 10px; ">
                        @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                    </div>

                    <div class="mb-4 form-group">
                            <label for="password" :value="__('Password')">Password:</label>
                            <input style="border-radius: 10px;" id="password" name="password" type="password" class="form-control" placeholder="Enter Your Password" >    
                            @if($errors->has("password"))
                            <span class="error-message">{{ $errors->first('password') }}</span>
                            @endif
                    </div>
                    
                    <div  class="card-text bg-transparent text-center ">
                        <button class="btn btn-lg rounded btn-primary my-3 py-3">Login</button>
                    </div>
                    <div class="my-2 d-flex justify-content-center align-items-center">
                    
                    <a href="{{ route('forgotPassword') }}" class="auth-link text-black">Forgot password?</a>
                  </div>

                </form>
            </div>
         </div>
     </div>
  </div>
</div> -->

@endsection
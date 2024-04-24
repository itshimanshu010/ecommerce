@extends('layout.main')
@section('content')

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center" style="margin-top: 50px;">
          
          <h2 class="text-center">Reset Your Password</h2>
          <p>Forgot your password ? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

          <form method="post" action="{{ route('password.email') }}">
          @csrf
            
            
            <div class="form-group">
              <input id="email" type="email" value="{{ old('email',$user->email) }}" name="email"    class="form-control"  placeholder="Email">
              @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
            </div>
           

            <div class="text-center">
              <button class="btn btn-main text-center">Email Password Reset Link</button>
            </div>
          </form>
      
        </div>
      </div>
    </div>
  </div>
</section>



<!-- <div class="mask d-flex align-items-center h-100 text-body ">
    <div class="container" style="color:black;">
      <div class="row d-flex justify-content-center align-items-center h-100" style="margin-top: 50px; margin-bottom:50px;">
        <div class=" col-md-9 col-lg-7 col-xl-6 border border-dark border-3" style="border-radius: 50px; background:#EDF1FF;" >
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Reset Your Password</h2>
              
              <p>Forgot your password ? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
              <form method="post" action="{{ route('password.email') }}">
              @csrf
                    <div class=" mb-4 form-group">
                        <label for="email" :value="__('Email')" >E-mail</label>
                        <input id="email" type="email" value="{{ old('email',$user->email) }}" name="email" class="form-control " type="text" placeholder="example@email.com"  style="border-radius: 10px; ">
                        @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                    </div>

                    

                    <div  class="card-text bg-transparent text-center ">
                        <button class="btn btn-lg rounded-pill btn-primary my-3 py-3">Email Password Reset Link</button>
                    </div>
                    

                </form>
            </div>
         </div>
     </div>
  </div>
</div> -->

@endsection
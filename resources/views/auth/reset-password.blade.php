@extends('layout.main')
@section('content')

<div class="mask d-flex align-items-center h-100 text-body ">
    <div class="container" style="color:black;">
      <div class="row d-flex justify-content-center align-items-center h-100" style="margin-top: 50px; margin-bottom:50px;">
        <div class=" col-md-9 col-lg-7 col-xl-6 border border-dark border-3" style="border-radius: 50px; background:#EDF1FF;" >
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Reset Your Password</h2>
              
              <form method="post" action="{{ route('password.store') }}">
              @csrf

              <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class=" mb-4 form-group">
                        <label for="email" :value="__('Email')" >E-mail</label>
                        <input id="email" type="email" value="{{ old('email', $request->email) }}" name="email" class="form-control " type="text" placeholder="example@email.com"  style="border-radius: 10px; ">
                        @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                    </div>

                    <div class="row mb-4">
                            <div class="col">
                                <label id="password" for="password" :value="__('Password')">Password</label>
                                <input type="password" class="form-control" type="password"
                            name="password" placeholder="Enter Your Password" style="border-radius: 10px;">
                            @if($errors->has("password"))
                            <span class="error-message">{{ $errors->first('password') }}</span>
                            @endif
                            </div>
                            <div class="col">
                                <label for="password_confirmation" :value="__('Confirm Password')">Confirm Password</label>
                                <input type="password"   name="password_confirmation"  id="password_confirmation" class="form-control" placeholder="Re-enter Your Password" style="border-radius: 10px;">
                                @if($errors->has("password"))
                                    <span class="error-message">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                    <div  class="card-text bg-transparent text-center ">
                        <button class="btn btn-lg rounded-pill btn-primary my-3 py-3">Reset Password </button>
                    </div>
                    

                </form>
            </div>
         </div>
     </div>
  </div>
</div>

@endsection
   


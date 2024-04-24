@extends('layout.admin.default')
@section('title','Users')
@section('content')

<div class="content-wrapper">
           
            <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Change Password</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample"  method="post" action="{{ route('admin.passwordUpdate', ['id' => $admin->id]) }}">
                    @csrf
                    @method('PUT') 
                    <div class="form-group col-md-4">
                        <label for="password"  id="password" >Current Password</label>
                        <input type="password" class="form-control"  type="password" name="old_password" placeholder="Enter Current Password">
                        @if($errors->has("old_password"))
                            <span class="error-message">{{ $errors->first('old_password') }}</span>
                            @endif
                      </div>
                      <div class="form-group col-md-4">
                        <label for="password"  id="password">New Pasword</label>
                        <input type="password" class="form-control" type="password" name="password" placeholder="Enter New Password">
                        @if($errors->has("password"))
                                    <span class="error-message"> {{ $errors->first('password') }}</span>
                                @endif
                      </div>
                      
                      <div class="form-group col-md-4">
                        <label for="password_confirmation">Confirm Pasword</label>
                        <input type="password" name="password_confirmation"  id="password_confirmation" class="form-control" placeholder="Confirm Your Password">
                        @if($errors->has("password_confirmation"))
                                    <span class="error-message"> {{ $errors->first('password_confirmation') }}</span>
                                @endif
                      </div>

                      <button type="submit" class="btn btn-gradient-primary me-2">Change</button>
                      <a href="{{ route('admin.dashboard.index') }}" class="btn btn btn-light">Cancel</a>                    </form>
                  </div>
                </div>
              </div>
              
            </div>
</div>
@endsection
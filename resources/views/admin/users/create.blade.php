@extends('layout.admin.default')
@section('title','Create User')
@section('content')
{{-- print_r(old()) --}}
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Create a User </h3>
              <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}" class="btn btn-block btn-lg btn-gradient-primary">Back</a>
              </li>
                
              </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">User Form</h4>
                    <p class="card-description"> </p>
                    <form class="forms-sample" method="post" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="row mb-4">
                      <div class="form-group col-md-4">
                        <label for="name" :value="__('Name')">Full Name</label>
                        <input id="name" class="form-control" type="text"  name="name" value="{{ old('name',$user->name) }}" placeholder="John" >
                        @if($errors->has("name"))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                            @endif
                      </div>

                      <div class="form-group col-md-4">
                        <label for="email" :value="__('Email')">Email address</label>
                        <input id="email" name="email" value="{{ old('email',$user->email) }}" class="form-control" type="email" placeholder="example@email.com">
                        @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                      </div>

                      <div class="form-group col-md-4">
                        <label for="phone" :value="__('Phone')">Mobile Number</label>
                        <input id="phone" name="phone" value="{{ old('phone',$user->phone) }}" class="form-control" type="tel" placeholder="0123456789">
                        
                        @if($errors->has("phone"))
                            <span class="error-message">{{ $errors->first('phone') }}</span>
                            @endif
                      </div>

                      </div>

                      <div class="row mb-4">

                      <div class="form-group col-md-4">
                        <label id="password" for="password" :value="__('Password')">Password</label>
                        <input type="password" class="form-control" type="password" name="password" placeholder="Enter Your Password" >
                            @if($errors->has("password"))
                            <span class="error-message">{{ $errors->first('password') }}</span>
                            @endif
                      </div>
                      
                      <div class="form-group col-md-4">
                        <label for="password_confirmation" :value="__('Confirm Password')">Confirm Password</label>
                        <input type="password"   name="password_confirmation"  id="password_confirmation" class="form-control" placeholder="Re-enter Your Password" >
                        @if($errors->has("password"))
                                    <span class="error-message">{{ $errors->first('password') }}</span>
                                @endif
                      </div>

                      <!-- <div class="form-group col-md-4">
                        
                        <label for="status">Status</label>
                        <select class="form-control form-control-sm" id="status" name="status">
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                      </div> -->

                     

                  </div>
                      
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      
                    </form>
                  </div>
                </div>
              </div>
              
            </div>
          </div>

@endsection
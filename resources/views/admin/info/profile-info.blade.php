@extends('layout.admin.default')
@section('title','Users')
@section('content')

<div class="content-wrapper">
           
            <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Profile-Info Manage</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample"  method="post" action="{{ route('admin.profileUpdate') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')  
                    <div class="form-group">
                        <label for="name" :value="__('Name')">Name</label>
                        <input id="name" class="form-control" type="text"  name="name" value="{{ old('name',$admin->name) }}" placeholder="Name">
                        @if($errors->has("name"))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                            @endif
                      </div>

                      <div class="form-group">
                        <label for="email" :value="__('Email')">Email address</label>
                        <input id="email" name="email" value="{{ old('email',$admin->email) }}" class="form-control" type="email"  placeholder="Email">
                        @if($errors->has("email"))
                            <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                      </div>

                      
                      <div class="row mb-4">

                        <div class="form-group col-md-6 ">
                        <label>Profile Picture</label>
                        
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group  ml-2 ">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                       
                            
                                
                            
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                          <img src="{{ asset('public/admin/images/profile/' . auth()->user()->image) }}" alt="image" width="45px" height="45px" style="border-radius:100%; border-style: solid; border-color:#555;">
                        </div>
                        </div>

                        <div class="form-group col-md-4">
                        
                        <label for="status">Status</label>
                        <select class="form-control form-control-sm" id="status" name="status">
                        <option value="active" {{$admin->status == 'active' ? 'selected' : ''}}>Active</option>
                        <option value="inactive" {{$admin->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                       </select>
                      </div>

                      </div>
                      
                      <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                     
                
                      <a href="{{ route('admin.dashboard.index') }}" class="btn btn btn-light">Cancel</a> 
                
              
                      
                    </form>
                  </div>
                </div>
              </div>
              
            </div>
</div>
@endsection
@extends('layout.admin.default')
@section('title','Edit User')
@section('content')
{{ $errors }} 
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Edit a List </h3>
              <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}" class="btn btn-block btn-lg btn-gradient-primary">Back</a>
              </li>
                
              </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit and Update Category List</h4>
                    <p class="card-description"> </p>
                    <form class="forms-sample" method="post" action="{{ route('admin.categories.update', ['id' => $category->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                      <div class="form-group col-md-4">
                        <label for="name" :value="__('Name')">Name</label>
                        <input id="name" class="form-control" type="text"  name="name" value="{{ old('name',$category->name) }}" placeholder="List Name" >
                        @if($errors->has("name"))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                            @endif
                      </div>

                      <div class="form-group col-md-4">
                      <label>Image</label>
                        
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group  ml-2 ">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                       
                            
                                
                            
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                          <img src="{{ asset('public/admin/images/category/' . $category->image) }}" alt="image" width="45px" height="45px" style="border-radius:100%; border-style: solid; border-color:#555;">

                        </div>
                      </div>

                      <div class="form-group col-md-4">
                        
                        <label for="status">Status</label>
                        <select class="form-control form-control-sm" id="status" name="status">
                        <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                      </div>

                      </div>
                      
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      
                    </form>
                  </div>
                </div>
              </div>
              
            </div>
          </div>

@endsection
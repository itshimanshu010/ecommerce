@extends('layout.admin.default')
@section('title','Create User')
@section('content')
{{-- print_r(old()) --}}
{{ $errors }} 
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Create a Sub Category List </h3>
              <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                
                <li class="breadcrumb-item"><a href="{{ route('admin.subcategories.index') }}" class="btn btn-block btn-lg btn-gradient-primary">Back</a>
              </li>
                
              </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Sub - Category Form</h4>
                    <p class="card-description"> </p>
                    <form class="forms-sample" method="post" action="{{ route('admin.subcategories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                      <div class="form-group col-md-6">
                        <label for="name" :value="__('Name')">Name</label>
                        <input id="name" class="form-control" type="text"  name="name" value="" placeholder="List Name" >
                        @if($errors->has("name"))
                            <span class="error-message">{{ $errors->first('name') }}</span>
                            @endif
                      </div>

                      <div class="form-group col-md-6">
                      <label>Image</label>
                        
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group  ml-2 ">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                       
                            
                                
                            
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>

                      

                      </div>

                      <div class="row mb-4">
                      <div class="form-group col-md-6">
                        
                        <label for="category">Category ID</label>
                        <select class="form-control form-control-sm" id="category" name="category_id">
                        @if($categories->isNotEmpty())
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>

                        @endforeach
                        @endif
                        </select>
                      </div>

                      <div class="form-group col-md-4">
                        
                        <label for="status">Status</label>
                        <select class="form-control form-control-sm" id="status" name="status">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
@extends('layout.admin.default')
@section('title','Create Product')
@section('content')
{{-- print_r(old()) --}}


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Create Product</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}" class="btn btn-block btn-lg btn-gradient-primary">Back</a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Form</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample" method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf
    <div class="row mb-4">
        <div class="form-group col-md-6">
            <label for="title" :value="__('Title')">Title</label>
            <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="Product Title">
            @error('title')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-6">
                                <label for="price">Price</label>
                                <input id="price" class="form-control" type="text" name="price" value="{{ old('price') }}" placeholder="Product Price">
                                @if($errors->has("price"))
                                <span class="error-message">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                           
                        </div>
                        <div class="row mb-4">
                            <div class="form-group col-md-6">
                                <label for="category_id">Category</label>
                                <select class="form-control form-control-sm" id="category_id" name="category_id">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has("category_id"))
                                <span class="error-message">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sub_category_id">Subcategory</label>
                                <select class="form-control form-control-sm" id="sub_category_id" name="sub_category_id">
                                    @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ old('sub_category_id') == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has("sub_category_id"))
                                <span class="error-message">{{ $errors->first('sub_category_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                           
                           

                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select class="form-control form-control-sm" id="status" name="status">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @if($errors->has("status"))
                                <span class="error-message">{{ $errors->first('status') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="images">Image</label>
                                <input type="file" name="images" class="file-upload-default">
                                <div class="input-group ml-2">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                @if($errors->has("images"))
                                <span class="error-message">{{ $errors->first('images') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            
                            
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

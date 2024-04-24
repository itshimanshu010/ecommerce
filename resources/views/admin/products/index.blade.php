@extends('layout.admin.default')
@section('title','Products')
@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Products </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.products.create') }}" class="btn btn-block btn-lg btn-gradient-primary">+ Add New Product</a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Products Table</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                                <td>{{ $product->sub_category_id ? $product->sub_category_id : 'N/A' }}</td>
                                 <td>
                                <img src="{{ asset('public/admin/images/product/' . $product->images) }}" alt="{{ $product->name }}" width="100">
                                </td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    @if($product->status == 'active')
                                    <label class="badge badge-success">Active</label>
                                    @else
                                    <label class="badge badge-danger">Inactive</label>
                                    @endif
                                </td>
                                <td><a href="{{ route('admin.products.variants',$product->id) }}">Add Variant</a>|<a href="{{ route('admin.products.destroy',$product->id) }}">Delete </a>|<a href="{{ route('admin.products.edit',$product->id) }}"> Edit</a></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

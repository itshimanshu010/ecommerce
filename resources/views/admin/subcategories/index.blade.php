@extends('layout.admin.default')
@section('title','Sub-Categories')
@section('content')

<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Sub - Categories </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                
                  <li class="breadcrumb-item"><a href="{{ route('admin.subcategories.create') }}" class="btn btn-block btn-lg btn-gradient-primary">+ Add New List</a>
                </li>
                  
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Sub - Categories Table</h4>
                 
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Category ID</th>
                          <th>Image</th>
                          <th>Created</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($records as $td)
                       <tr>
                           
                           <td>{{$td->name}}</td>
                           <td>{{$td->category_id}}</td>
                           <td> @if($td->image)
                <img src="{{ asset('public/admin/images/subcategory/' . $td->image) }}" alt="Category Image" width="100">
            @else
                N/A
            @endif</td>
                           <td>{{$td->created_at}}</td>
                           <td>
                              @if($td->status == 'active')
                              <label class="badge badge-success">Active</label>
                              @else
                              <label class="badge badge-danger">Inactive</label>
                              @endif
                            </td>
                           <td><a href="{{ route('admin.subcategories.destroy',$td->id) }}">Delete </a>|<a href="{{ route('admin.subcategories.edit',$td->id) }}"> Edit</a></td>
                           
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
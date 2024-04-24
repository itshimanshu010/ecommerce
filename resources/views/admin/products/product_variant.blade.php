@extends('layout.admin.default')
@section('title', 'Add Product Variant')
@section('content')
{{ $errors->has('color.0') }}
<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title">Add Product Variant</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}" class="btn btn-block btn-lg btn-gradient-primary">Back to Products</a></li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Product Variant Form</h4>
					<form class="forms-sample" method="post"  action="{{ route('admin.products.storevariant',$product->id) }}" enctype="multipart/form-data">
						@csrf
						<div class="variant_box variant_css">
							

							@if(old('color'))
							@php
							$colors = old('color');
							$size = old('size');
							$qty = old('quantity');
							@endphp
							@foreach($colors as $key => $value)
							<div class="row mb-4 variant_0">
								<div class="form-group col-md-3">
									<label for="color">Color</label>
									<input id="color" class="form-control boxcolor" type="color" name="color[]" value="{{ $value }}" placeholder="Color">
                                    @if($errors->has("color.$key") )
									<span class="error-message">{{ $errors->first("color.$key") }}</span>
									@endif
								</div>
								<div class="form-group col-md-3">
									<label for="size">Size</label>
									<input id="size" class="form-control" type="text" name="size[]" value="{{ $size[$key]; }}" placeholder="Size">
									@if($errors->has("size.$key") )
									<span class="error-message">{{ $errors->first("size.$key") }}</span>
									@endif
								</div>
								<div class="form-group col-md-3">
									<label for="quantity">Quantity</label>
									<input id="quantity" class="form-control" type="text" name="quantity[]" value="{{ $qty[$key] }}" placeholder="Quantity">
									@if($errors->has("quantity.$key") )
									<span class="error-message">{{ $errors->first("quantity.$key") }}</span>
									@endif
								</div>
                                <div class="form-group col-md-3">
                                <!-- <a href="javascript:void(0)" class="remove_variant" data-id="0">Remove Variant</a> -->
								</div>
							</div>
							@endforeach
							@else
                            <div class="row mb-4 variant_0">
								<div class="form-group col-md-3">
									<label for="color">Color</label>
									<input id="color" class="form-control boxcolor" type="color" name="color[]" value="" placeholder="Color">

									@error('color')
									<span class="error-message">{{ $message }}</span>
									@enderror
								</div>
								<div class="form-group col-md-3">
									<label for="size">Size</label>
									<input id="size" class="form-control" type="text" name="size[]" value="{{ old('size.0', '') }}" placeholder="Size">
									@error('size')
									<span class="error-message">{{ $message }}</span>
									@enderror
								</div>
								<div class="form-group col-md-3">
									<label for="quantity">Quantity</label>
									<input id="quantity" class="form-control" type="text" name="quantity[]" value="{{ old('quantity.0','') }}" placeholder="Quantity">
									@error('quantity')
									<span class="error-message">{{ $message }}</span>
									@enderror
								</div>
                                <div class="form-group col-md-3">
                                <!-- <a href="javascript:void(0)" class="remove_variant" data-id="0">Remove Variant</a> -->
								</div>
							</div>
							@endif
                            
						</div>
						<button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
						<a href="javascript:void(0)" class="btn btn-gradient-primary me-2 add_variant" data-id="1">Add Variant</a>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
    $(document).ready(function(){
        $('body').on('click','.add_variant',function(){
            var data_id = $(this).attr('data-id');
            var content = `<div class="row mb-4 variant_${data_id}">
								<div class="form-group col-md-3">
									<label for="color">Color</label>
									<input id="color" class="form-control boxcolor" type="color" name="color[]" value="" placeholder="Color">
									@error('color')
									<span class="error-message">{{ $message }}</span>
									@enderror
								</div>
								<div class="form-group col-md-3">
									<label for="size">Size</label>
									<input id="size" class="form-control" type="text" name="size[]" value="" placeholder="Size">
									@error('size')
									<span class="error-message">{{ $message }}</span>
									@enderror
								</div>
								<div class="form-group col-md-3">
									<label for="quantity">Quantity</label>
									<input id="quantity" class="form-control" type="text" name="quantity[]" value="" placeholder="Quantity">
									@error('quantity')
									<span class="error-message">{{ $message }}</span>
									@enderror
								</div>
                                <div class="form-group col-md-3">
                                <a href="javascript:void(0)" class="remove_variant" data-id="${data_id}">Remove Variant</a>
								</div>
							</div>`;
            $('.variant_box').append(content);
            $(this).attr('data-id',(parseInt(data_id)+1));
        });

        $('body').on('click','.remove_variant',function(){
            var data_id = $(this).attr('data-id');
            
            $('.variant_'+data_id).remove();
        });
    })
</script>

@endsection
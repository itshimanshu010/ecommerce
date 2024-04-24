@extends('layout.main')
@section('content')
{{-- auth()->user()--}}

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Shop</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">shop</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="products section">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="widget">
					<h4 class="widget-title">Short By</h4>
					<form method="post" action="#">
                        <select class="form-control">
                            <option>Man</option>
                            <option>Women</option>
                            <option>Accessories</option>
                            <option>Shoes</option>
                        </select>
                    </form>
	            </div>
				<div class="widget product-category">
					<h4 class="widget-title">Categories</h4>
					<div class="panel-group commonAccordion" id="accordion" role="tablist" aria-multiselectable="true">
					  	<div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingOne">
						      	<h4 class="panel-title">
						        	<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          	Shoes
						        	</a>
						      	</h4>
						    </div>
					    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<ul>
									<li><a href="#!">Brand & Twist</a></li>
									<li><a href="#!">Shoe Color</a></li>
									<li><a href="#!">Shoe Color</a></li>
								</ul>
							</div>
					    </div>
					  </div>
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="headingTwo">
					      <h4 class="panel-title">
					        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					         	Duty Wear
					        </a>
					      </h4>
					    </div>
					    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					    	<div class="panel-body">
					     		<ul>
									<li><a href="#!">Brand & Twist</a></li>
									<li><a href="#!">Shoe Color</a></li>
									<li><a href="#!">Shoe Color</a></li>
								</ul>
					    	</div>
					    </div>
					  </div>
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="headingThree">
					      <h4 class="panel-title">
					        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					          	WorkOut Shoes
					        </a>
					      </h4>
					    </div>
					    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
					    	<div class="panel-body">
					      		<ul>
									<li><a href="#!">Brand & Twist</a></li>
									<li><a href="#!">Shoe Color</a></li>
									<li><a href="#!">Gladian Shoes</a></li>
									<li><a href="#!">Swis Shoes</a></li>
								</ul>
					    	</div>
					    </div>
					  </div>
					</div>
					
				</div>
			</div>
			<div class="col-md-9">
				<div class="row">
					
				@foreach($products as $product)
                    <div class="col-md-4">
                        <div class="product-item">
                            <div class="product-thumb">
                                
                              
                                <span class="bage">Sale</span>
                                
                                <img class="img-responsive product_images" src="{{ asset('public/admin/images/product/' . $product->images) }}" alt="product-img" />
                                <div class="preview-meta">
                                    <ul>
                                        <li>
                                          
										<a href="javascript:void(0)" class="open-modal" data-id="{{ $product->id }}">
                                                <i class="tf-ion-ios-search-strong"></i>
										</a>
                                        </li>
                                        <li>
                                            
                                            <a href=""><i class="tf-ion-ios-heart"></i></a>
                                        </li>
										<li>
                           				 <a href="javascript:void(0)" class="add-to-cart" data-id="{{ $product->id }}">
                                		<i class="tf-ion-android-cart"></i> 
                           				 </a>
                        					</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                            
                                <h4><a href="{{  route('singleProduct', ['id' => $product->id]) }}">{{ $product->title }}</a></h4>
                                <p class="price">₹{{ $product->price }}</p>
                            </div>
                        </div>
                    </div>


					
                    @endforeach

					




				</div>
						
			</div>
		
		</div>
	</div>
</section>

@foreach($products as $product)
<div class="modal product-modal fade" id="product-modal-{{ $product->id }}">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<i class="tf-ion-close"></i>
	</button>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-8 col-sm-6 col-xs-12">
						<div class="modal-image">
							
							<img class="img-responsive" src="{{ asset('public/admin/images/product/' . $product->images) }}" alt="product-img" />
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="product-short-details">
							<h2 class="product-title">{{ $product->title }}</h2>
							<p class="product-price">₹{{ $product->price }}</p>
							<p class="product-short-description">
								
							</p>
							<a href="cart.html" class="btn btn-main">Add To Cart</a>
							<a href="{{ route('singleProduct', ['id' => $product->id]) }}" class="btn btn-transparent">View Product Details</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach






@endsection
@extends('layout.main')
@section('content')
{{-- auth()->user()--}}

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Checkout</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">checkout</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="page-wrapper">
   <div class="checkout shopping">
      <div class="container">
       <form class="checkout-form" id="checkout-form" action="{{ route('place-order') }}" method="POST">
         @csrf
         <div class="row">
            <div class="col-md-8">
               <div class="block billing-details">
                  
                     <h4 class="widget-title">Billing Details</h4>
                     <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" placeholder="">
                     </div>
                     <div class="form-group">
                        <label for="user_address">Address</label>
                        <input type="text" class="form-control" id="user_address" placeholder="">
                     </div>
                     <div class="checkout-country-code clearfix">
                        <div class="form-group">
                           <label for="user_post_code">Zip Code</label>
                           <input type="text" class="form-control" id="user_post_code" name="zipcode" value="">
                        </div>
                        <div class="form-group" >
                           <label for="user_city">City</label>
                           <input type="text" class="form-control" id="user_city" name="city" value="">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="user_country">Country</label>
                        <input type="text" class="form-control" id="user_country" placeholder="">
                     </div>
               </div>


               <div class="block payment-method">
                  <h4 class="widget-title">Payment Method</h4>
                  <p>Credit Cart Details (Secure payment)</p>
                  <div class="checkout-product-details">
                     <div class="payment">
                        <div class="card-details">
                           {{-- <form  class="checkout-form"> --}}
                              <div class="form-group">
                                 <label for="card-number">Card Number <span class="required">*</span></label>
                                 <input  id="card-number" class="form-control"   type="tel" placeholder="•••• •••• •••• ••••">
                              </div>
                              <div class="form-group half-width padding-right">
                                 <label for="card-expiry">Expiry (MM/YY) <span class="required">*</span></label>
                                 <input id="card-expiry" class="form-control" type="tel" placeholder="MM / YY">
                              </div>
                              <div class="form-group half-width padding-left">
                                 <label for="card-cvc">Card Code <span class="required">*</span></label>
                                 <input id="card-cvc" class="form-control"  type="tel" maxlength="4" placeholder="CVC" >
                              </div>
                             
                              <button type="submit" class="btn btn-main mt-20">Place Order</button>
                              {{-- <a href="confirmation.html" class="btn btn-main mt-20">Place Order</a > --}}
                           {{-- </form> --}}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="product-checkout-details">
                  <input type="hidden" name="cart_items" value="{{ json_encode($cartItems) }}">
                  <div class="block">
                     <h4 class="widget-title">Order Summary</h4>
                     @foreach($cartItems as $item)
                     <div class="media product-card" id="product-card-{{ $item->id }}">
                        <a class="pull-left" href="#!">
                        <img width="10px" class="media-object" src="{{ $item->image }}" alt="Image" />
                        </a>
                        <div class="media-body">
                           <h4 class="media-heading"><a href="#!">{{ $item->title }}</a></h4>
                           <p class="price">{{ $item->quantity }} x ₹ {{ $item->unit_price }}</p>
                           <!-- Add a remove button or link -->
                           <span class="remove remove-checkout" data-id="{{ $item->id }}">Remove</span>
                        </div>
                     </div>
                     @endforeach
                     <div class="discount-code">
                        <p>Have a discount ? <a data-toggle="modal" data-target="#coupon-modal" href="#!">enter it here</a></p>
                     </div>
                     <ul class="summary-prices">
                        <li>
                           <span>Subtotal:</span>
                           <span id="subtotalPlaceholder">calculating..</span>
                        </li>
                        <li>
                           <span>Shipping:</span>
                           <span id="shippingPlaceholder">calculating..</span>
                        </li>
                     </ul>
                     <div class="summary-total">
                        <span>Total</span>
                        <span id="totalPlaceholder">calculating..</span>
                     </div>
                     <div class="verified-icon">
                        <img src="{{ asset('public/frontend/images/shop/verified.png') }}">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </form>
      </div>
   </div>
</div>
   <!-- Modal -->
   <div class="modal fade" id="coupon-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-body">
               <form>
                  <div class="form-group">
                     <input class="form-control" type="text" placeholder="Enter Coupon Code">
                  </div>
                  <button type="submit" class="btn btn-main">Apply Coupon</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   

   @endsection
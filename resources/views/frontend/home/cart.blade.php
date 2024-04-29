@extends('layout.main')
@section('content')
{{-- auth()->user()--}}

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Cart</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">cart</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>



<div class="page-wrapper">
  <div class="cart shopping">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-md-offset-2">
          <div class="block">
            <div class="product-list">
              <form method="post">
                <table class="table">
                  <thead>
                    <tr>
                      <th class=""></th>
                      <th class="">Item Name</th>
                      <th class="">Unit Price</th>
                      <th class="">Quantity</th>
                      <th class="">Total Price</th>
                      <th class="">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cartItems as $item)
                    <tr id="product-row-{{ $item->id }}" class="">
                      <td>
                        <input type="checkbox" name="selectedItems[]" value="{{ $item->id }}" checked data-item-id="{{ $item->id }}">
                    </td>

                        <td class="">
                            <div class="product-info">
                                <img width="80px" src="{{  $item->image }}" alt="{{ $item->title }}" />
                                <a href="#!">{{ $item->title }}</a>
                            </div>
                        </td>

                        <td class="">
                          <div id="unit-price-{{ $item->id }}">₹ {{ $item->unit_price }}</div>
                      </td>
                        
                        <td class="quantityslider">
                            <div class="product-quantity-slider ">
                              <input id="product-quantity-{{ $item->id }}" class="quantityslider" type="number" value="{{ $item->quantity }}" min="1" name="product-quantity" onchange="updateTotalPrice({{ $item->id }})">
                            </div>
                        </td>

                        <td class="">
                          <div id="total-price-{{ $item->id }}">₹ {{ $item->total }}</div>
                      </td>

                        <td class="">
                            <a class="product-remove" href="{{ route('removeCartItem', $item->id) }}" data-id="{{ $item->id }}">Remove</a>
                        </td>

                        
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <a href="{{ route('checkoutCart') }}" class="btn btn-main pull-right">Proceed to Checkout</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
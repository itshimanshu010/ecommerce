<!DOCTYPE html>



<html lang="en">
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>E-commerce</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Constra HTML Template v1.0">
  
  <!-- theme meta -->
  <meta name="theme-name" content="aviato" />
  
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/frontend/images/favicon.png') }}"/>
  
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="{{ asset('public/frontend/plugins/themefisher-font/style.css') }}">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="{{ asset('public/frontend/plugins/bootstrap/css/bootstrap.min.css') }}">
  
  <!-- Animate css -->
  <link rel="stylesheet" href="{{ asset('public/frontend/plugins/animate/animate.css') }}">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="{{ asset('public/frontend/plugins/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('public/frontend/plugins/slick/slick-theme.css') }}">
  
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('public/frontend/css/developer.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/css/toastr.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{ asset('public/admin/js/toastr.js') }}"></script>



</head>

<body id="body">


@include('layout.header')
@yield('content')
@include('layout.footer')
@include('admin.elements.flash')




<script>

    toastr.options = {
        "closeButton": true,
        "positionClass": "toast-top-right",
        "timeOut": 3000
    };
    
    $(document).ready(function(){
        $('.open-modal').click(function(){
            var productId = $(this).data('id');
            $('#product-modal-' + productId).modal('show');
        });
        
    });

    $(document).ready(function() {
         $('input[type="checkbox"]').change(function() {
             var itemId = $(this).val();
             var isChecked = $(this).is(':checked');
             updateChecked(itemId, isChecked);
         });

        function updateChecked(itemId, isChecked) {
            var checkedValue = isChecked ? 1 : 0; // Convert isChecked to 1 if true, 0 if false
            $.ajax({
                type: 'POST',
                url: '{{ route("updateChecked") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    itemId: itemId,
                    isChecked: checkedValue // Send checkedValue to the server
                },
                success: function(response) {
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });


    $(document).ready(function(){
        $('.add-to-cart').click(function(e){
            e.preventDefault();
            var productId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '{{ route("cart.add") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    console.log(response);
                    updateMiniModalCart();
                    toastr.success(response.message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).on('click', '.remove-checkout', function(e) {
             e.preventDefault();
             var itemId = $(this).data('id'); 
             $.ajax({
                 type: 'POST',
                 url: '{{ route("updateChecked") }}',
                 data: {
                     _token: '{{ csrf_token() }}',
                     itemId: itemId,
                     isChecked: 0 // Set isChecked to 0 to indicate unchecked
                 },
                 success: function(response) {
                    $('#product-card-' + itemId).remove();
                    updateCheckoutSummary();
                     toastr.success('Item removed from checkout');
                     var totalCharge = parseFloat($('#totalPlaceholder').text().replace('₹ ', ''));
                    
                     if ($('.product-card').length === 0) {
                        window.location.href = '{{ route("cart") }}';
                    }
                 },
                 error: function(xhr, status, error) {
                     console.error(xhr.responseText);
                 }
            });
        });
        

        $(document).on('click', '.remove-cart', function(e) {
            e.preventDefault();
            var itemId = $(this).data('id'); 
            $.ajax({
                type: 'GET', 
                url: '{{ route("basket.remove") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    basket_id: itemId
                },
                success: function(response) {                   
                    updateMiniModalCart();
                   
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        

        function updateMiniModalCart() {
            $.ajax({
                type: 'GET',
                url: '{{ route("show-cart") }}',
                success: function(response) {
                    var cartItems = response.cartItems;
                    var cartHtml = '';
                    var totalPrice = 0; // Initialize total price

                    // Iterate through the cart items and generate HTML for each item
                    cartItems.forEach(function(item) {
                        cartHtml += '<div class="media ">';
                        cartHtml += '<a class="pull-left" href="#!">';
                        cartHtml += '<img class="media-object" src="'+item.image+'" alt="image" />';
                        cartHtml += '</a>';
                        cartHtml += '<div class="media-body">';
                        cartHtml += '<h4 class="media-heading"><a href="#!">' + item.title + '</a></h4>';
                        cartHtml += '<div class="cart-price">';
                        cartHtml += '<span>' + item.quantity + ' x</span>';
                        cartHtml += '<span>' + item.unit_price + '</span>';
                        cartHtml += '</div>';
                        cartHtml += '<h5><strong>₹ ' + item.total + '</strong></h5>';
                        cartHtml += '</div>';
                        cartHtml += '<a href="" class="remove remove-cart"  data-id="' + item.id + '"><i class="tf-ion-close"></i></a>';
                        cartHtml += '</div><!-- / Cart Item -->';

                        // Add item's total price to the total
                        totalPrice += parseFloat(item.total);
                    });

                    // Add cart summary and buttons
                    cartHtml += '<div class="cart-summary">';
                    cartHtml += '<span>Total</span>';
                    cartHtml += '<span class="total-price">₹ ' + totalPrice.toFixed(2) + '</span>'; // Display total price
                    cartHtml += '</div>';
                    cartHtml += '<ul class="text-center cart-buttons">';
                    cartHtml += '<li><a href="{{ route('cart') }}" class="btn btn-small">View Cart</a></li>';
                    cartHtml += '<li><a href="" class="btn btn-small btn-solid-border">Checkout</a></li>';
                    cartHtml += '</ul>';

                    // Update the HTML content
                    $('#mini-cart-items').html(cartHtml);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        $(document).on('click', '.product-remove', function(e) {
            e.preventDefault();
            var itemId = $(this).data('id'); 
            var $row = $(this).closest('tr');
            $.ajax({
                type: 'DELETE', 
                url: '{{ route("removeCartItem") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: itemId
                },
                success: function(response) {
                    
                    $row.remove();
                    updateMiniModalCart();
                    if ($('tbody tr').length === 0) {
                window.location.href = '{{ route("shopPage") }}';
            }
                    toastr.success('Item removed from cart');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }); 
        

        updateMiniModalCart();
        
        
    });

    function updateCheckoutSummary() {
     
    $.ajax({
        type: 'GET',
        url: '{{ route("updateCheckoutSummary") }}',
        success: function(response) {
            console.log('Received response:', response);
            $('#subtotalPlaceholder').text('₹ ' + response.subtotal.toFixed(2));
            $('#shippingPlaceholder').text('₹ ' + response.shipping.toFixed(2));
            $('#totalPlaceholder').text('₹ ' + response.total.toFixed(2));
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
    }

   
    $(document).ready(function() {
        updateCheckoutSummary();

        $('#checkout-btn').click(function() {
            // Check if any checkboxes are checked
            var selectedItems = $('input[type="checkbox"]:checked').length;
            if (selectedItems === 0) {
                toastr.error('Please select at least one item to proceed to checkout.');
                return false;
            }
        });

        
    });

</script>  

<script>
    function updateTotalPrice(itemId) {
        var quantity = $('#product-quantity-' + itemId).val(); // Get the new quantity
        var unitPrice = parseFloat($('#unit-price-' + itemId).text().replace('₹ ', '')); // Get the unit price
        var totalPrice = quantity * unitPrice; // Calculate the total price
        $('#total-price-' + itemId).text('₹ ' + totalPrice.toFixed(2)); // Update the total price displayed in the table
    }
</script>
    



    <!-- Main jQuery -->
    <script src="{{ asset('public/frontend/plugins/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.1 -->
    <script src="{{ asset('public/frontend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap Touchpin -->
    <script src="{{ asset('public/frontend/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <!-- Instagram Feed Js -->
    <script src="{{ asset('public/frontend/plugins/instafeed/instafeed.min.js') }}"></script>
    <!-- Video Lightbox Plugin -->
    <script src="{{ asset('public/frontend/plugins/ekko-lightbox/dist/ekko-lightbox.min.js') }}"></script>
    <!-- Count Down Js -->
    <script src="{{ asset('public/frontend/plugins/syo-timer/build/jquery.syotimer.min.js') }}"></script>

    <!-- slick Carousel -->
    <script src="{{ asset('public/frontend/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/slick/slick-animation.min.js') }}"></script>

    <!-- Google Mapl -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/plugins/google-map/gmap.js') }}"></script>

    <!-- Main Js File -->
    <script src="{{ asset('public/frontend/js/script.js') }}"></script>
</body>
</html>
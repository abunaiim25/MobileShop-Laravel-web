@extends('layouts.front')

@section('title')
    My Cart
@endsection


@section('content')

    <div class="py-3 mb-4 ">
        <div class="container">
            <div class="mb-0 h6">
                <a href="{{ url('/') }}">
                    Home
                </a>/

                <a href="{{ url('cart') }}">
                    Cart
                </a>


            </div>
        </div>
    </div>


    <div class="container mb-5">
        
        <div class="card shadow product_data">

            @if ($cartItems->count() > 0)

                <div class="card-body p-5">
                    @php $total = 0; @endphp
                    <!--total taka-->
                    
                    @foreach ($cartItems as $item)
                        <div class="row p-2  product_data">

                            <div class="col-md-2 col-4  my-auto">
                                <img src="{{ asset('assets/uploads/products/' . $item->products->image) }}" hight="50px"
                                    width="60px" alt="Image here">
                            </div>

                            <div class="col-md-3  col-4  my-auto">
                                <h6> {{ $item->products->name }} </h6>
                            </div>

                            <div class="col-md-2  col-4  my-auto">
                                <h6> {{ $item->products->selling_price }} TK </h6>
                            </div>

                            <div class="col-md-3   col-6  my-auto">

                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">


                                @if ($item->products->qty >= $item->prod_qty)

                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3" style="width:130px">
                                        <button class="input-group-text decrement-btn  changeQuantity ">-</button>
                                        <input type="text" name="quantity " value="{{ $item->prod_qty }}"
                                            class="form-control qty-input text-center">
                                        <button class="input-group-text increment-btn  changeQuantity ">+</button>
                                    </div>

                                    @php $total += $item->products->selling_price * $item->prod_qty ; @endphp
                                @else
                                    <h6 class="my-auto ">Out of Stock</h6>
                                @endif

                            </div>

                            <div class="col-md-2  col-6  my-auto">
                                <button class="btn btn-danger delete-cart-item btn-sm"> <i class="fa fa-trash"></i>
                                    Remove</button>
                            </div>

                        </div>
                        
                    @endforeach
                    
                </div>


                <div class="card-footer">
                    <h6 >Total Price : {{ $total }} TK</h6>

                    <a href="{{ url('checkout') }}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
                </div>

            @else
                <div class="card-body text-center p-5 mt-5">
                    <h2>Your <i class="fa fa-shopping-cart"></i> Cart is empty</h2>
                    <a href="{{ url('category') }}" class="btn btn-outline-primary float-end">Continue Shopping</a>
                </div>
            @endif

        </div>
    </div>

@endsection



<!--Jquery-->

@section('scripts')

    <script>
        $(document).ready(function() {


            loadcart();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function loadcart() {
                $.ajax({
                    method: "GET",
                    url: "/load-cart-count",
                    success: function(response) {
                        $('.cart-count').html('');
                        $('.cart-count').html(response.count);
                        //consol.log(response.count)
                    }
                });
            }



            //increment-btn
            $('.increment-btn').click(function(e) {
                e.preventDefault();

                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value < 10) {
                    value++;

                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });


            //decrement-btn
            $('.decrement-btn').click(function(e) {
                e.preventDefault();


                var dec_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(dec_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;

                    $(this).closest('.product_data').find('.qty-input').val(value);

                }
            });







            //delete-cart-item
            $('.delete-cart-item').click(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var prod_id = $(this).closest('.product_data').find('.prod_id').val();

                $.ajax({
                    method: "POST",
                    url: "delete-cart-item",
                    data: {
                        'prod_id': prod_id,
                    },
                    success: function(response) {
                        window.location.reload();
                        swal("", response.status, "success");
                    }
                });
            });


            //changeQuantity
            $('.changeQuantity').click(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                var qty = $(this).closest('.product_data').find('.qty-input').val();
                data = {
                    'prod_id': prod_id,
                    'prod_qty': qty,
                }

                $.ajax({
                    method: "POST",
                    url: "update-cart",
                    data: data,
                    success: function(response) {
                        window.location.reload();
                    }
                });


            });

        });
    </script>

@endsection

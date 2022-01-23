@extends('layouts.front')

@section('title')
    Wishlist
@endsection


@section('content')

    <div class="py-3 mb-4 ">
        <div class="container">
            <div class="mb-0 h6">
                <a href="{{ url('/') }}">
                    Home
                </a>/

                <a href="{{ url('wishlist') }}">
                    Wishlist
                </a>
            </div>
        </div>
    </div>


    <div class="container mb-5 ">
        <div class="card shadow product_data">

            <div class="card-body p-5 ">

                @if ($wishlist->count() > 0)

                    @foreach ($wishlist as $item)
                        <div class="row p-2 product_data ">

                            <div class="col-lg-2   my-auto">
                                <img src="{{ asset('assets/uploads/products/' . $item->products->image) }}" hight="50px"
                                    width="60px" alt="Image here">
                            </div>

                            <div class="col-lg-2  my-auto">
                                <h6> {{ $item->products->name }} </h6>
                            </div>

                            <div class="col-lg-2  my-auto">
                                <h6> {{ $item->products->selling_price }} TK </h6>
                            </div>

                            <div class="col-lg-2    my-auto">
                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                @if ($item->products->qty >= $item->prod_qty)

                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3" style="width:130px">
                                        <button class="input-group-text decrement-btn   ">-</button>
                                        <input type="text" name="quantity " value="{{ $item->prod_qty }}"
                                            class="form-control qty-input text-center">
                                        <button class="input-group-text increment-btn   ">+</button>
                                    </div>

                                @else
                                    <h6 class="my-auto ">Out of Stock</h6>
                                @endif
                            </div>

                            <div class="col-lg-2   my-auto">
                                <button class="btn btn-success btn-sm addToCartBtn"> <i class="fa fa-shopping-cart"></i>
                                    Add to Cart</button>
                            </div>

                            <div class="col-lg-2 col-3   my-auto">
                                <button class="btn btn-danger btn-sm remove-wishlist-item"> <i class="fa fa-trash"></i>
                                    Remove</button>
                            </div>

                        </div>

                    @endforeach

                @else
                    <h2 class="text-center p-5">There are no product in your <i class="fa fa-heart"></i> wishlist
                    </h2>
                    <a href="{{ url('category') }}" class="btn btn-outline-primary float-end">Continue Shopping</a>
                @endif

            </div>
        </div>
    </div>

@endsection




<!--Javascript-->

@section('scripts')

    <script>
        $(document).ready(function() {


            //wishlist count
            loadwishlist();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loadwishlist() {
                $.ajax({
                    method: "GET",
                    url: "/load-wishlist-count",
                    success: function(response) {
                        $('.wishlist-count').html('');
                        $('.wishlist-count').html(response.count);
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


            //addToCartBtn
            $('.addToCartBtn').click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                var product_qty = $(this).closest('.product_data').find('.qty-input').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/add-to-cart",
                    data: {
                        'product_id': product_id,
                        'product_qty': product_qty,
                    },
                    success: function(response) {

                        swal(response.status);
                    }
                });

            });


            //addToWishlist
            $('.addToWishlist').click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/add-to-wishlist",
                    data: {
                        'product_id': product_id,

                    },
                    success: function(response) {
                        swal(response.status);
                        loadwishlist();
                    }
                });

            });


            //delete-wishlist-item
            $('.remove-wishlist-item').click(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var prod_id = $(this).closest('.product_data').find('.prod_id').val();

                $.ajax({
                    method: "POST",
                    url: "delete-wishlist-item",
                    data: {
                        'prod_id': prod_id,
                    },
                    success: function(response) {
                        window.location.reload();
                        swal("", response.status, "success");
                    }
                });
            });


        });
    </script>

@endsection

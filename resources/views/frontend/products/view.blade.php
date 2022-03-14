@extends('layouts.front')

@section('title', $products->name)


@section('content')

    <!--Rate Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ url('/add-rating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $products->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rate {{ $products->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                @if ($user_rating)

                                    @for ($i = 1; $i <= $user_rating->stars_rated; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked
                                            id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                    @for ($j = $user_rating->stars_rated + 1; $j <= 5; $j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating"
                                            id="rating{{ $j }}">
                                        <label for="rating{{ $j }}" class="fa fa-star"></label>
                                    @endfor

                                @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <div class="py-3 mb-4 ">
        <div class="container">
            <div class="mb-0 h6">
                <a href="{{ url('/') }}">
                    Home
                </a>/
                <a href="{{ url('category') }}">
                    Category
                </a>/

                <a href="{{ url('view-category/' . $products->category->slug) }}">
                    {{ $products->category->name }}
                </a>/

                <a href="{{ url('category/' . $products->category->slug . '/' . $products->slug) }}">
                    {{ $products->name }}
                </a>

            </div>
        </div>
    </div>


    <div class="container pb-5">
        <div class="card border-0 shadow  product_data">

            <div class="card-body ">
                <div class="row">

                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/uploads/products/' . $products->image) }}" class="w-100"
                            alt="">
                    </div>

                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $products->name }}

                            @if ($products->trending == '1')
                                <label style="font-size:16px;" class="float-end badge bg-danger trending_tag"
                                    for="">Trending</label>
                            @endif
                        </h2>

                        <hr>
                        <label class="me-3" for="">Orginal Price : <s>TK
                                {{ $products->original_price }}</s></label>
                        <label class="fw-bold" for="">Selling Price : TK {{ $products->selling_price }}</label>


                        <!--ratings-->
                        @php $ratenum = number_format($rating_value)  @endphp
                        <div class="rating">
                            @for ($i = 1; $i <= $ratenum; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for ($j = $ratenum + 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>
                                @if ($ratings->count() > 0)
                                    {{ $ratings->count() }} Ratings
                                @else
                                    No Ratings
                                @endif
                            </span>
                        </div>



                        <p class="mt-3">
                            {!! $products->small_description !!}
                        </p>

                        <hr>
                        
                        @if ($products->qty > 0)
                            <label class="badge bg-success" for="">{{$products->qty}} In stock</label>
                        @else
                            <label class="badge bg-danger" for="">Out of stock</label>
                        @endif

                        <div class="row mt-2">
                            <div class="col-md-2">

                                <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                <label for="Quantity">Quantity</label>

                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity " value="1" class="form-control qty-input">
                                    <button class="input-group-text increment-btn">+</button>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-10">

                            <br>
                            @if ($products->qty > 0)
                                <button type="button" class="btn btn-primary me-3  addToCartBtn  float-start">Add to Cart <i
                                        class="fa fa-shopping-cart"></i></button>
                            @endif

                            <button type="button" class="btn btn-success me-3  addToWishlist  float-start">Add to Wishlist
                                <i class="fa fa-heart"></i></button>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <p class="mt-3">
                    <h4>Description</h4>
                    {!! $products->description !!}
                    </p>
                </div>
                <hr>
            </div>


            <div class="row  pb-5 px-3">
                <div class="col-md-12">
                    <!--Rate Button trigger modal -->
                    <button type="button" class="btn btn-outline-dark mb-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="fa fa-star checked"></i> Rate this product
                    </button>

                    <a href="{{ url('add-review/' . $products->slug . '/userreview') }}" type="button"
                        class="btn btn-outline-warning mb-2">
                        </i> Write a review
                    </a>
                </div>

            </div>
        </div>


        
        <div class="col-md-12 mt-4 p-3">
            @foreach ($reviews as $item)
                <div class="user-review">

                    <label for="">
                        {{$item->user->name}}
                    </label>
                    

                    @if ($item->user_id == Auth::id())
                        <a href="{{ url('edit-review/' . $products->slug . '/userreview') }}"
                            class="float-end bg-success badge text-white">Edit </a>
                    @endif
                    <br>



                    <small>Reviewed on {{ $item->created_at->format('d M Y') }}</small>
                    <p>
                        {{ $item->user_review }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

@endsection



<!--Javascript-->

@section('scripts')

    <script>
        $(document).ready(function() {


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
                    }
                });

            });


        });
    </script>

@endsection

@extends('layouts.front')

@section('title')
    Checkout
@endsection


@section('content')

    <div class="py-3 mb-4 ">
        <div class="container">
            <div class="mb-0 h6">
                <a href="{{ url('/') }}">
                    Home
                </a>/

                <a href="{{ url('checkout') }}">
                    Checkout
                </a>


            </div>
        </div>
    </div>


    <div class="container mb-5">

        <form action=" {{ url('place-order') }} " method="POST">

            {{ csrf_field() }}

            <div class="row">

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">

                            <h6>Basic Details</h6>
                            <hr>

                            <div class="row checkout-form">

                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <!-- value="{{ Auth::user()->name }}"---for placeholder auto fill-->
                                    <input type="text" required class="form-control firstname"
                                        value="{{ Auth::user()->name }}" name="fname" placeholder="Enter First Name">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" required class="form-control lastname"
                                        value="{{ Auth::user()->lname }}" name="lname" placeholder="Enter Last Name">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" required class="form-control email"
                                        value="{{ Auth::user()->email }}" name="email" placeholder="Enter Email">
                                    <span id="email_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" required class="form-control phone"
                                        value="{{ Auth::user()->phone }}" name="phone" placeholder="Enter Phone Number">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Address 1</label>
                                    <input type="text" required class="form-control address1"
                                        value="{{ Auth::user()->address1 }}" name="address1"
                                        placeholder="Enter Address 1">
                                    <span id="address1_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Address 2</label>
                                    <input type="text" required class="form-control address2"
                                        value="{{ Auth::user()->address2 }}" name="address2"
                                        placeholder="Enter Address 2">
                                    <span id="address2_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" required class="form-control city"
                                        value="{{ Auth::user()->city }}" name="city" placeholder="Enter City">
                                    <span id="city_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">State</label>
                                    <input type="text" required class="form-control state"
                                        value="{{ Auth::user()->state }}" name="state" placeholder="Enter Status">
                                    <span id="state_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" required class="form-control country"
                                        value="{{ Auth::user()->country }}" name="country" placeholder="Enter Country">
                                    <span id="country_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Pin Code</label>
                                    <input type="text" required class="form-control pincode"
                                        value="{{ Auth::user()->pincode }}" name="pincode" placeholder="Enter Pin Code">
                                    <span id="pincode_error" class="text-danger"></span>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>


                <div class="col-md-5">
                    <div class="card">

                        @if ($cartitems->count() > 0)

                            <div class="card-body">

                                <h6>Order Details</h6>
                                <hr>

                                <table class="table table-striped table-bordered">

                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach ($cartitems as $item)

                                            @php $total += $item->products->selling_price * $item->prod_qty ; @endphp

                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->prod_qty }}</td>
                                                <td>{{ $item->products->selling_price }}</td>
                                            </tr>

                                        @endforeach
                                    </tbody>

                                </table>
                                <h6>Total Price : {{ $total }} TK</h6>
                                <hr>


                                <button type="submit" class="btn btn-success w-100">Place Order | COD</button>
<!--
                                <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Pay with
                                    Razorpay</button>
                                -->

                                <a href="{{ url('example2') }}" type="submit" class="btn btn-primary w-100 mt-3 text-white">Payment with SSLCommerz</a>
                            </div>

                        @else
                            <div class="card-body ">

                                <h6>Order Details</h6>
                                <hr>

                                <h5>No Products in <i class="fa fa-shopping-cart"></i> Cart</h5>
                                <a href="{{ url('category') }}" class="btn btn-outline-primary float-end">Continue
                                    Shopping</a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </form>

    </div>

@endsection



<!--Javascript-->

@section('scripts')

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        $(document).ready(function() {


            //razorpay_btn
            $('.razorpay_btn').click(function(e) {
                e.preventDefault();


                var firstname = $('.firstname').val();
                var lastname = $('.lastname').val();
                var email = $('.email').val();
                var phone = $('.phone').val();
                var address1 = $('.address1').val();
                var address2 = $('.address2').val();
                var city = $('.city').val();
                var state = $('.state').val();
                var country = $('.country').val();
                var pincode = $('.pincode').val();


                if (!firstname) {
                    fname_error = "First name is required";
                    $('#fname_error').html('');
                    $('#fname_error').html(fname_error);
                } else {
                    fname_error = "";
                    $('#fname_error').html('');
                }

                if (!lastname) {
                    lname_error = "First name is required";
                    $('#lname_error').html('');
                    $('#lname_error').html(lname_error);
                } else {
                    lname_error = "";
                    $('#lname_error').html('');
                }

                if (!email) {
                    email_error = "First name is required";
                    $('#email_error').html('');
                    $('#email_error').html(email_error);
                } else {
                    fname_error = "";
                    $('#email_error').html('');
                }

                if (!phone) {
                    phone_error = "First name is required";
                    $('#phone_error').html('');
                    $('#phone_error').html(phone_error);
                } else {
                    phone_error = "";
                    $('#phone_error').html('');
                }

                if (!address1) {
                    address1_error = "First name is required";
                    $('#address1_error').html('');
                    $('#address1_error').html(address1_error);
                } else {
                    address1_error = "";
                    $('#address1_error').html('');
                }

                if (!address2) {
                    address2_error = "First name is required";
                    $('#address2_error').html('');
                    $('#address2_error').html(address2_error);
                } else {
                    address2_error = "";
                    $('#address2_error').html('');
                }

                if (!city) {
                    city_error = "First name is required";
                    $('#city_error').html('');
                    $('#city_error').html(city_error);
                } else {
                    city_error = "";
                    $('#city_error').html('');
                }

                if (!state) {
                    state_error = "First name is required";
                    $('#state_error').html('');
                    $('#state_error').html(state_error);
                } else {
                    state_error = "";
                    $('#state_error').html('');
                }

                if (!country) {
                    country_error = "First name is required";
                    $('#country_error').html('');
                    $('#country_error').html(country_error);
                } else {
                    country_error = "";
                    $('#country_error').html('');
                }

                if (!pincode) {
                    pincode_error = "First name is required";
                    $('#pincode_error').html('');
                    $('#pincode_error').html(pincode_error);
                } else {
                    pincode_error = "";
                    $('#pincode_error').html('');
                }


                if (fname_error != '' || lname_error != '' || email_error != '' || phone_error != '' ||
                    address1_error != '' ||
                    address2_error != '' || city_error != '' || state_error != '' || country_error != '' ||
                    pincode_error != '') {
                    return false;
                } else {

                    var data = {
                        'firstname': firstname,
                        'lastname': lastname,
                        'email': email,
                        'phone': phone,
                        'address1': address1,
                        'address2': address2,
                        'city': city,
                        'state': state,
                        'country': country,
                        'pincode': pincode
                    }

                    $.ajax({
                        method: "POST",
                        url: "/proceed-to-pay",
                        data: data,
                        success: function(response) {
                            alert(response.total_price);

                   

                        }

                    });

                }

            });



        });
    </script>

@endsection

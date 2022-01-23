@extends('layouts.front')

@section('title')
Order View
@endsection


@section('content')

<div class="py-3 mb-4 ">
    <div class="container">
        <div class="mb-0 h6">
            <a href="{{ url('/') }}">
                Home
            </a>/

            <a href="{{ url('my-orders') }}">
                My Orders
            </a>/

            <a href="{{ url('view-order/'.$orders->id) }}">
                Orders view
            </a>
           


        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header text-color bg-light">
                    <h4 >Orders view
                        <a href="{{ url('my-orders') }}" class="btn color text-white float-end">Back</a>
                    </h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 order_details">

                        <h4>Shopping Details</h4>
                        <hr>

                            <label for="">First Name</label>
                            <div class="border ">{{ $orders->fname }}</div>

                            <label for="">Last Name</label>
                            <div class="border ">{{ $orders->lname }}</div>

                            <label for="">Email</label>
                            <div class="border ">{{ $orders->email }}</div>

                            <label for="">Contact No.</label>
                            <div class="border ">{{ $orders->phone }}</div>

                            <label for="">Shopping Address</label>
                            <div class="border ">
                                {{ $orders->address1 }},<br>
                                {{ $orders->address2 }},<br>
                                {{ $orders->city }},<br>
                                {{ $orders->state }},
                                {{ $orders->country }},
                            </div>

                            <label for="">Zip Code</label>
                            <div class="border ">{{ $orders->pincode }}</div>
                        </div>


                        <div class="col-md-6 ">

                        <h4>Order Details</h4>
                        <hr>

                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($orders->orderitems as $item)
                                    <tr>
                                        <td>{{ $item->products->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <img src="{{ asset('assets/uploads/products/'.$item->products->image) }}"
                                                width="50px" alt="Product Image">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            <h5 class="px-2">Grand Total: {{ $orders->total_price }} TK</h5>

                        </div>

                    </div>
                </div>
            </div>

        </div>


    </div>

</div>


@endsection
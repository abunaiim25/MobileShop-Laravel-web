@extends('layouts.front')

@section('title')
    Payment View
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

                <a href="{{ url('view-order-payment/'.$payment->id) }}">
                    Payment View
                </a>



            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header text-color bg-light">
                        <h4>Orders view
                            <a href="{{ url('my-orders') }}" class="btn color text-white float-end">Back</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order_details">

                                <h4>Shopping Details</h4>
                                <hr>

                                <label for="">Name</label>
                                <div class="border ">{{ $payment->name }}</div>

                                <label for="">Email</label>
                                <div class="border ">{{ $payment->email }}</div>

                                <label for="">Contact No.</label>
                                <div class="border ">{{ $payment->phone }}</div>

                                <label for="">Amount</label>
                                <div class="border ">{{ $payment->amount }}</div>

                                <label for="">Currency</label>
                                <div class="border ">{{ $payment->currency }}</div>

                                <label for="">Status</label>
                                <div class="border ">{{ $payment->status }}</div>

                                <label for="">Transaction Id</label>
                                <div class="border ">{{ $payment->transaction_id }}</div>

                                <label for="">Address</label>
                                <div class="border ">{{ $payment->address }}</div>

                               
                            </div>


                           
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>


@endsection

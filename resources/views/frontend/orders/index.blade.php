@extends('layouts.front')

@section('title')
My Orders
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
            </a>


        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header text-color bg-light">
                    <h5>Hand Cash</h5>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Tracking Number</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                            <td>{{ $item->created_at }}</td>
                                <td>{{ $item->tracking_no }}</td>
                                <td>{{ $item->total_price }}</td>
                                <td>{{ $item->status == '0' ? 'pending' : 'completed' }}</td>
                                <td>
                                    <a href="{{ url('view-order/'.$item->id) }}"
                                        class="btn color text-white">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>



                <div class="card-header text-color bg-light">
                    <h5>Online Payment</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Tracking Number</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($payments as $item)
                            <tr>
                            <td>{{ $item->created_at }}</td>
                                <td>{{ $item->transaction_id }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->status == '0' ? 'pending' : 'completed' }}</td>
                                <td>
                                    <a href="{{ url('view-order-payment/'.$item->id) }}"
                                        class="btn color text-white">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>


        </div>
    </div>
</div>


@endsection
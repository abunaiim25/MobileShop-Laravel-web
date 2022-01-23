@extends('layouts.admin')

@section('title')
    Admin User Details
@endsection

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4>User Details
                            <a href="{{ url('users') }}" class="btn btn-primary btn-sm float-right">Back</a>
                        </h4>
                        <hr>
                    </div>

                    <div class="card-body">

                        <div class="row">


                            <div class="col-md-4 mt-3">
                                <label for="">Name</label>
                                <div class="p-2 border">{{ $orders->fname }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">Email</label>
                                <div class="p-2 border">{{ $orders->email }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">Phone Number</label>
                                <div class="p-2 border">{{ $orders->phone }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">Address 1</label>
                                <div class="p-2 border">{{ $orders->address1 }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">Address 2</label>
                                <div class="p-2 border">{{ $orders->address2 }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">City</label>
                                <div class="p-2 border">{{ $orders->city }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">State</label>
                                <div class="p-2 border">{{ $orders->state }}</div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">Country</label>
                                <div class="p-2 border">{{ $orders->country }}</div>
                            </div>



                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection

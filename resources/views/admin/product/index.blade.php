<!--Admin Category-->
@extends('layouts.admin')

@section('title')
    Admin Products
@endsection

@section('content')
    <div class="card">

        <div class="card-header">
            <h4>Product</h4>
            <hr>
        </div>

        <div class="scrollmenu">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <!--class="table-bordered"-->

                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Selling Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        <!--get item from phpmyadmin-->
                        @foreach ($products as $item)
                            <!--$category from CategoryController-->
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->selling_price }}</td>

                                <td>
                                    <img src="{{ asset('assets/uploads/products/' . $item->image) }}" class="cut-image"
                                        alt="Image here">
                                    <!--class="cut-image"---custom.css-->
                                </td>

                                <td>
                                    <!--<button class="btn btn-primary">Edit</button>-->
                                    <a href="{{ url('edit-product/' . $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ url('delete-product/' . $item->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
@endsection

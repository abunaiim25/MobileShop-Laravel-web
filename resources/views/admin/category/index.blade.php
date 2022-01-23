<!--Admin Category-->
@extends('layouts.admin')


@section('title')
    Admin Categorys
@endsection

@section('content')
    <div class="card">

        <div class="card-header">
            <h4>Category</h4>
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
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        <!--get item from phpmyadmin-->
                        @foreach ($category as $item)
                            <!--$category from CategoryController-->
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>

                                <td>
                                    <img src="{{ asset('assets/uploads/category/' . $item->image) }}" class="cut-image"
                                        alt="Image here">
                                    <!--class="cut-image"---custom.css-->
                                </td>

                                <td>
                                    <!--<button class="btn btn-primary">Edit</button>-->
                                    <a href="{{ url('edit-category/' . $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ url('delete-category/' . $item->id) }}"
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

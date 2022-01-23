@extends('layouts.admin')

@section('title')
    Admin Registered users
@endsection




@section('content')
    <div class="card">

        <div class="card-header">
            <h4>Registered users</h4>
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
                            <th>Role</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Joined</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        <!--get item from phpmyadmin    ---$item->name . ' ' . $item->lname-->
                        @foreach ($users as $item)
                            <!--$category from CategoryController-->
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->role_as == '0' ? 'User' : 'Admin' }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td></td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ url('view-user/' . $item->id) }}" class="btn btn-primary btn-sm">View</a>
                                </td>
                                
                                
                          
                                
                            


                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
@endsection

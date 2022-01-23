@extends('layouts.front')

@section('title')
    {{ $category->name }}
@endsection


@section('content')

    <div class="py-3 mb-4   ">
        <div class="container">
            <div class="mb-0 h6">
                <a href="{{ url('/') }}">
                    Home
                </a>/
                <a href="{{ url('category') }}">
                    Category
                </a>



            </div>
        </div>
    </div>


    <div class="">
        <div class="container mb-5">
            <div class="row">
                <h2 class="pb-3">{{ $category->name }}</h2>

                @foreach ($products as $prod)
                    <div class=" col-md-4  col-lg-3  mb-3">
                        <div class="card border-0 shadow p-3">

                            <a href="{{ url('category/' . $category->slug . '/' . $prod->slug) }}">
                                <img class="rounded mx-auto d-block "
                                    src="{{ asset('assets/uploads/products/' . $prod->image) }}"
                                    style="width: 150px; height: 185px;" alt=" Product Image">

                                <div class="card-body p-3">
                                    <h5>{{ $prod->name }}</h5>
                                    <small><span class="float-start">{{ $prod->selling_price }}TK</span></small>
                                    <small><span class="float-end">
                                            <s>{{ $prod->original_price }}TK</s></span></small>
                                </div>
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

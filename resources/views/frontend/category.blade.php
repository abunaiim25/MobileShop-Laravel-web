@extends('layouts.front')

@section('title')
Category
@endsection


@section('content')

<div class="py-3 mb-4 ">
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

        <h2>All Categories</h2>

            <div class="owl-carousel owl-theme">

                @foreach($category as $cate)
                <div class=" item mb-4 p-2">
                    <div class="card border-0 shadow">

                        <a href=" {{ url('view-category/'.$cate->slug) }} ">
                        <img class="rounded mx-auto d-block mt-3"
                            src="{{ asset('assets/uploads/category/'.$cate->image) }}"
                            style="width: 150px; height: 185px;" alt=" Category Image">

                        <div class="card-body">
                            <h5>{{ $cate->name }}</h5>
                            <p>
                                {{ $cate->description }}
                            </p>
                        </div>
                        </a>


                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    @endsection



    @section('scripts')
    <script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
    </script>
    @endsection
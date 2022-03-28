@extends('layouts.front')

@section('title')
    Welcome to Mobile Shop
@endsection


@section('content')
    @include('layouts.inc.frontslider')

    <div class="py-5">
        <div class="container">

            {{-- languages --}}

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="flag-icon flag-icon-{{ Config::get('languages')[App::getLocale()]['flag-icon'] }}"></span>
                    {{ Config::get('languages')[App::getLocale()]['display'] }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span
                                    class="flag-icon flag-icon-{{ $language['flag-icon'] }}"></span>
                                {{ $language['display'] }}</a>
                        @endif
                    @endforeach
                </div>
            </li>


            <div class="row">
                <h2>Featured Products</h2>

                <div class="owl-carousel owl-theme">
                    @foreach ($featured_products as $prod)
                        <div class=" item mb-4 p-2">
                            <div class="card border-0 shadow p-3">

                                <a href="{{ url('category/' . $prod->category->slug . '/' . $prod->slug) }}">
                                    <img class="rounded mx-auto d-block mt-3"
                                        src="{{ asset('assets/uploads/products/' . $prod->image) }}"
                                        style="width: 150px; height: 185px;" alt=" Product Image">

                                    <div class="card-body">
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






        <div class="py-5">
            <div class="container">
                <div class="row">
                    <h2>Trending Category</h2>

                    <div class="owl-carousel owl-theme">
                        @foreach ($trending_category as $category)
                            <div class=" item mb-4 p-2">

                                <a href="{{ url('view-category/' . $category->slug) }}">
                                    <div class="card border-0 shadow p-3">

                                        <img class="rounded mx-auto d-block mt-3"
                                            src="{{ asset('assets/uploads/category/' . $category->image) }}"
                                            style="width: 150px; height: 185px;" alt=" Category Image">

                                        <div class="card-body">
                                            <h5>{{ $category->name }}</h5>
                                            <p>
                                                {{ $category->description }}
                                            </p>
                                        </div>

                                    </div>
                                </a>

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

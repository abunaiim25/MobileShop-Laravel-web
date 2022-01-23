<nav class="navbar navbar-expand-lg navbar-light color">

    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Mobile Shop</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item p-1 {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link " aria-current="page" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item p-1 {{ Request::is('category') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('category') }}">Category</a>
                </li>

                <li class="nav-item p-1 {{ Request::is('cart') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('cart') }}">Cart
                        <span class="badge badge-pill bg-primary cart-count">0</span>
                    </a>
                </li>

                <li class="nav-item p-1 {{ Request::is('wishlist') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('wishlist') }}">Wishlist
                        <span class="badge badge-pill bg-success wishlist-count">0</span>
                    </a>
                </li>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto ">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item p-1">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item p-1">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif



                    @else
                        <!--dropdown add-->
                        <li class="nav-item dropdown p-1 ">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu color" aria-labelledby="navbarDropdown">
                                <li class="nav-item  {{ Request::is('#') ? 'active' : '' }}">
                                    <a class="dropdown-item nav-link" href="#">
                                        My Profile
                                    </a>
                                </li>

                                <li class="nav-item  {{ Request::is('my-orders') ? 'active' : '' }}">
                                    <a class="dropdown-item nav-link" href="{{ url('my-orders') }}">
                                        My Orders
                                    </a>
                                </li>

                                <li class="nav-item  {{ Request::is('logout') ? 'active' : '' }}">
                                    <a class="dropdown-item nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>

                                </li>

                            </ul>
                        </li>
                    @endguest





                </ul>
        </div>
    </div>
</nav>



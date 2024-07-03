<aside class="wrap-sidebar js-sidebar">
    <div class="s-full js-hide-sidebar"></div>

    <div class="sidebar flex-col-l p-t-22 p-b-25">
        <div class="flex-r w-full p-b-30 p-r-27">
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
            <ul class="sidebar-link w-full navbar-nav ms-auto">
                @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
                {{-- <li class="p-b-13 ">
                    @if (Route::has('login'))
                        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                            @auth
                                <a href="{{ url('/') }}"
                                    class="font-semibold text-dark hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ Auth::user()->name }}</a>
                            @else
                                <div class="d-flex">
                                    <a href="{{ route('login') }}"
                                        class="font-semibold text-white ">
                                        <button
                                            class=" flex-c-m stext-101 cl0 size-102 bg-dark bor1 p-lr-15 trans-04">
                                            Login
                                        </button>
                                    </a>
                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                                class="ml-4 font-semibold  ">
                                            <button
                                                class=" text-dark flex-c-m stext-101 cl0 size-102 bg-white bor1  p-lr-15 trans-04">
                                                Register
                                            </button>
                                        </a>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    @endif
                </li> --}}


                <li class="p-b-13">
                    <a href="{{ route('home') }}" class="stext-102 cl2 hov-cl1 trans-04">
                        Home
                    </a>
                </li>

                {{-- <li class="p-b-13">
                    <a href="{{ asset('themes/client/#') }}" class="stext-102 cl2 hov-cl1 trans-04">
                        My Wishlist
                    </a>
                </li> --}}



                <li class="p-b-13">
                    <a href="{{ asset('themes/client/#') }}" class="stext-102 cl2 hov-cl1 trans-04">
                        Help & FAQs
                    </a>
                </li>
            </ul>

            <div class="sidebar-gallery w-full p-tb-30">
                <span class="mtext-101 cl5">
                    @ CozaStore
                </span>

                <div class="flex-w flex-sb p-t-36 gallery-lb">
                    <!-- item gallery sidebar -->
                    <div class="wrap-item-gallery m-b-10">
                        <a class="item-gallery bg-img1" href="{{ asset('themes/client/images/gallery-01.jpg') }}"
                            data-lightbox="gallery"
                            style="background-image: url({{ asset('themes/client/images/gallery-01.jpg') }});"></a>
                    </div>

                    <!-- item gallery sidebar -->
                    <div class="wrap-item-gallery m-b-10">
                        <a class="item-gallery bg-img1" href="{{ asset('themes/client/images/gallery-02.jpg') }}"
                            data-lightbox="gallery"
                            style="background-image: url({{ asset('themes/client/images/gallery-02.jpg') }});"></a>
                    </div>

                    <!-- item gallery sidebar -->
                    <div class="wrap-item-gallery m-b-10">
                        <a class="item-gallery bg-img1" href="{{ asset('themes/client/images/gallery-03.jpg') }}"
                            data-lightbox="gallery"
                            style="background-image: url({{ asset('themes/client/images/gallery-03.jpg') }});"></a>
                    </div>

                    <!-- item gallery sidebar -->
                    <div class="wrap-item-gallery m-b-10">
                        <a class="item-gallery bg-img1" href="{{ asset('themes/client/images/gallery-04.jpg') }}"
                            data-lightbox="gallery"
                            style="background-image: url({{ asset('themes/client/images/gallery-04.jpg') }});"></a>
                    </div>

                    <!-- item gallery sidebar -->
                    <div class="wrap-item-gallery m-b-10">
                        <a class="item-gallery bg-img1" href="{{ asset('themes/client/images/gallery-05.jpg') }}"
                            data-lightbox="gallery"
                            style="background-image: url({{ asset('themes/client/images/gallery-05.jpg') }});"></a>
                    </div>

                    <!-- item gallery sidebar -->
                    <div class="wrap-item-gallery m-b-10">
                        <a class="item-gallery bg-img1" href="{{ asset('themes/client/images/gallery-06.jpg') }}"
                            data-lightbox="gallery"
                            style="background-image: url({{ asset('themes/client/images/gallery-06.jpg') }});"></a>
                    </div>

                    <!-- item gallery sidebar -->
                    <div class="wrap-item-gallery m-b-10">
                        <a class="item-gallery bg-img1" href="{{ asset('themes/client/images/gallery-07.jpg') }}"
                            data-lightbox="gallery"
                            style="background-image: url({{ asset('themes/client/images/gallery-07.jpg') }});"></a>
                    </div>

                    <!-- item gallery sidebar -->
                    <div class="wrap-item-gallery m-b-10">
                        <a class="item-gallery bg-img1" href="{{ asset('themes/client/images/gallery-08.jpg') }}"
                            data-lightbox="gallery"
                            style="background-image: url({{ asset('themes/client/images/gallery-08.jpg') }});"></a>
                    </div>

                    <!-- item gallery sidebar -->
                    <div class="wrap-item-gallery m-b-10">
                        <a class="item-gallery bg-img1" href="{{ asset('themes/client/images/gallery-09.jpg') }}"
                            data-lightbox="gallery"
                            style="background-image: url({{ asset('themes/client/images/gallery-09.jpg') }});"></a>
                    </div>
                </div>
            </div>

            <div class="sidebar-gallery w-full">
                <span class="mtext-101 cl5">
                    About Us
                </span>

                <p class="stext-108 cl6 p-t-27">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur maximus vulputate hendrerit.
                    Praesent faucibus erat vitae rutrum gravida. Vestibulum tempus mi enim, in molestie sem
                    fermentum quis.
                </p>
            </div>
        </div>
    </div>
</aside>
<div>
    <header class="header-v3">
        <!-- Header desktop -->
        <div class="container-menu-desktop trans-03">
            <div class="wrap-menu-desktop">
                <nav  {{ Request::path() =='/'?'':'style=background-color:#222222!important;' }} id="nav" class="limiter-menu-desktop p-l-45">

                    <!-- Logo desktop -->
                    <a href="#" class="logo">
                        <img src="{{asset('front')}}/images/icons/logo-02.png" alt="IMG-LOGO">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li>
                                <a href="{{ url('/') }}">{{ __('front.Home') }}</a>

                            </li>

                            <li>
                                <a href="{{ url('/shop/all') }}">{{ __('front.Shop') }}</a>
                            </li>



    {{--
                            <li>
                                <a href="about.html">{{ __('front.About') }}</a>
                            </li> --}}

                            <li>
                           <a href=""  data-toggle="modal" data-target="#contact">{{ __('front.Contact') }}</a>
                            </li>
                            @auth
                               <li>
                           <a href="{{route('front.orders.index')}}" >{{ __('front.yourOrders') }}</a>
                            </li>
                            <form id="logout-form" action="{{ route('user-logout') }}" method="post">
                                @csrf
                            </form>
                            <li>

                                    <a href="#" onclick="document.getElementById('logout-form').submit();">{{ __('front.logout') }}</a>

                            </li>
                            @else
                            <li>
                                <a href=""  data-toggle="modal" data-target="#exampleModalCenter">{{ __('front.login_register') }}</a>
                            </li>
                            @endauth
                            <li>
                                @if (App::getLocale() == 'en')
                                    <a href="{{ route('lang','ar') }}">عربي</a>
                                @else
                                    <a href="{{ route('lang','en') }}">English</a>

                                @endif

                            </li>
                        </ul>

                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m h-full">
                        <div class="flex-c-m h-full p-r-25 bor6">
                            <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="{{ $count }}">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        </div>


                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html"><img src="{{asset('front')}}/images/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
                <div class="flex-c-m h-full p-r-5">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="2">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="main-menu-m">
                <li>
                    <a href="{{ url('/') }}">{{ __('front.Home') }}</a>

                </li>

                <li>
                    <a href="{{ url('/shop/all') }}">{{ __('front.Shop') }}</a>
                </li>



                <li>
                    <a href="blog.html">{{ __('front.Blog') }}</a>
                </li>

                <li>
                    <a href="about.html">{{ __('front.About') }}</a>
                </li>

                <li>
                    <a href="contact.html">{{ __('front.Contact') }}</a>
                </li>
                <li>
                    @if (App::getLocale() == 'en')
                        <a href="{{ route('lang','ar') }}">عربي</a>
                    @else
                        <a href="{{ route('lang','en') }}">English</a>

                    @endif

                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <button class="flex-c-m btn-hide-modal-search trans-04">
                <i class="zmdi zmdi-close"></i>
            </button>

            <form class="container-search-header">
                <div class="wrap-search-header">
                    <input class="plh0" type="text" name="search" placeholder="{{ __('front.Search') }}">

                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </header>

    <div  class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div style="margin-top: 100px;" class="modal-content">
            <livewire:user-auth>
          </div>
        </div>
      </div>

      <!-- Modal -->
    <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div style="    margin-top: 116px;      " class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="post" action="{{ route('contact.store') }}">
                        @csrf
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            {{ __('front.SendMessage') }}
                        </h4>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="{{ __('front.enter_email') }}">
                            <img class="how-pos4 pointer-none" src="{{ asset('front/images/icons/icon-email.png') }}" alt="ICON">
                        </div>
                        <div class="bor8 m-b-30">
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" placeholder="{{ __('front.name') }}">
                        </div>
                        <div class="bor8 m-b-30">
                            <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="message" placeholder="{{ __('front.how_can_we_help_you') }}"></textarea>
                        </div>

                        <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            {{ __('front.send') }}
                        </button>
                    </form>
                </div>

            </div>

          </div>
        </div>
      </div>



    </div>

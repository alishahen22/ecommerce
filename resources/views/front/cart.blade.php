@extends('front.layouts.master')
@section('title' , __('cart'))
@section('style')

@endsection


@section('content')

<form action="{{ route('addQuentityToCart') }}" id="quantity" class="bg0 p-t-75 p-b-85">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        @if (session()->has('success'))
                            <div class="alert alert-success text-center">
                                {{ session()->get('success') }}
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger text-center">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">#</th>
                                <th class="column-1">{{ __('front.image') }}</th>
                                <th class="column-2">{{ __('front.name') }}</th>
                                <th class="column-3">{{ __('front.price') }}</th>
                                <th class="column-4">{{ __('front.qauantity') }}</th>
                                <th class="column-5">{{ __('front.size') }}</th>
                                <th class="column-6">{{ __('front.total') }}</th>
                            </tr>
                            @php
                               $total = 0
                            @endphp

                            @forelse ($carts as$cart )
                            @php $total += $cart->product->price * $cart->quantity @endphp
                            <tr class="table_row">
                                    <td class="column-1">
                                        <a  class="btn btn-danger" href="{{ route("deleteFromCart" , $cart->id) }}" >X</a>
                                    </td>

                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src=" {{asset('storage/'. $cart->product->main_image)}}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2">{{ $cart->product->title }}</td>
                                <td class="column-3">$ {{ $cart->product->price }}</td>
                                <td class="column-4">

                                    <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity[{{ $cart->id}}]" value="{{ $cart->quantity }}">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="column-5">{{$cart->size}}</td>
                                <td class="column-6">${{$cart->product->price * $cart->quantity}}</td>
                            </tr>
                            @empty

                                <tr >
                                    <td colspan="6">
                                    <h4 class="text-center">No Products In Cart</h4>
                                </td>
                                </tr>

                            @endforelse



                        </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">

                        </div>

                        <button form="quantity" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                            {{ __('front.update_cart') }}
                        </button>
                    </div>
                </div>
            </form>

            </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">

                        <form action="{{ url('checkout') }}" method="POST">
                            @csrf
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">

                            <h4 class="mtext-109 cl2 p-b-30">
                               {{ __('front.cart_total') }}
                            </h4>

                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        {{ __('front.subtotal')  }}:
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        ${{ $total  }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                <div class="size-208 w-full-ssm">
                                    <span class="stext-110 cl2">
                                        {{ __('front.shipping') }}:
                                    </span>
                                </div>

                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    <p class="stext-111 cl6 p-t-2">
                                        {{ __('front.shippingMsg') }}
                                    </p>

                                    <div class="p-t-15">

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" value="{{ Auth::user()->name ?? '' }}" placeholder="{{ __('front.full_name') }}">
                                        </div>
                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"  value="{{ Auth::user()->email??'' }}" name="email" placeholder="{{ __('front.email') }}">
                                        </div>
                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"  value="{{ Auth::user()->phone??'' }}" name="phone" placeholder="{{ __('front.phone') }}">
                                        </div>
                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="full_address[]" placeholder="{{ __('front.country') }}">
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="full_address[]" placeholder="{{ __('front.state') }}">
                                        </div>

                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="full_address[]" placeholder="{{ __('front.city') }}">
                                        </div>
                                        <input type="hidden" name="total" value="{{ $total }}">

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                {{ __('front.total') }}:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                ${{ $total  }}
                            </span>
                        </div>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                      {{ __('front.checkout') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>



@endsection

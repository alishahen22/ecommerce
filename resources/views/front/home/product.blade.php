@livewireStyles()
<section class="bg0 p-t-23 p-b-130" id="products">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">

                {{ __('front.ProductOverview') }}
            </h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <a href="{{ filterByLinkQuery(url(request()->path()),'category','products'  ) }}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5{{! request()->category||request()->category=='products'?' how-active1':'' }}" data-filter="*">
                    {{ __('front.All') }} {{ __('front.Products') }}
                </a>
                @foreach ($categories as $category )
                <a href="{{ filterByLinkQuery(url(request()->path()),'category', $category->title_en ) }}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ request()->category == $category->title_en ?' how-active1':'' }} " data-filter="*">
                    {{ $category->title }}
                </a>
                @endforeach

            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>

                     {{ __('front.Filter') }}

                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    {{ __('front.Search') }}
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="{{ __('Search') }}">
                </div>
            </div>

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">

                            {{ __('front.Sortby') }}
                        </div>

                        <ul>

                            <li class="p-b-6">
                                <a href="{{ filterByLinkQuery(url(request()->path()),'sort', 'newness' ) }}" class="filter-link stext-106 trans-04 {{ request()->sort == 'newness'?'filter-link-active':"" }}">

                                    {{ __('front.Newness') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ filterByLinkQuery(url(request()->path()),'sort', 'low_high' ) }}" class="filter-link stext-106 trans-04 {{ request()->sort == 'low_high'?'filter-link-active':"" }}">
                                    {{ __('front.Price') }}:   {{ __('front.LowtoHigh') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ filterByLinkQuery(url(request()->path()),'sort', 'high_low' ) }}" class="filter-link stext-106 trans-04 {{ request()->sort == 'high_low'?'filter-link-active':"" }}">
                                    {{ __('front.Price') }}:  {{ __('front.HightoLow') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-col2 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                           {{ __('front.Price') }}
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="{{ filterByLinkQuery(url(request()->path()),'price', 'all' ) }}" class="filter-link stext-106 trans-04 {{!request()->price ||request()->price == 'high_low'?'filter-link-active':"" }} ">
                                    {{ __('front.All') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ filterByLinkQuery(url(request()->path()),'price', '0-50' ) }}" class="filter-link stext-106 trans-04  {{ request()->price == '0-50'?'filter-link-active':"" }}">
                                    $0.00 - $50.00
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ filterByLinkQuery(url(request()->path()),'price', '50-100' ) }}" class="filter-link stext-106 trans-04  {{ request()->price == '50-100'?'filter-link-active':"" }}">
                                    $50.00 - $100.00
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ filterByLinkQuery(url(request()->path()),'price', '100-150' ) }}" class="filter-link stext-106 trans-04  {{ request()->price == '100-150'?'filter-link-active':"" }}">
                                    $100.00 - $150.00
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ filterByLinkQuery(url(request()->path()),'price', '150-200' ) }}" class="filter-link stext-106 trans-04  {{ request()->price == '150-200'?'filter-link-active':"" }}">
                                    $150.00 - $200.00
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ filterByLinkQuery(url(request()->path()),'price', '200' ) }}" class="filter-link stext-106 trans-04 {{ request()->price == '200'?'filter-link-active':"" }}">
                                    $200.00+
                                </a>
                            </li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>

            <livewire:shop-page :products='$products'/>


                {{-- <div >
                    <div class="row isotope-grid">
                        @foreach ($products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0 ">
                                    <img src="{{asset('storage/'. $product->main_image)}}" alt="IMG-PRODUCT">

                                    <button  class=" block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 "  data-toggle="modal" data-target="#modal{{ $product->id }}" >
                                       {{__('front.QuickView')}}
                                    </button>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{$product->title}}
                                        </a>

                                        <span class="stext-105 cl3">
                                            ${{$product->price}}
                                        </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                            <img class="icon-heart1 dis-block trans-04" src="{{asset('front')}}/images/icons/icon-heart-01.png" alt="ICON">
                                            <img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{asset('front')}}/images/icons/icon-heart-02.png" alt="ICON">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <!-- Modal -->
                <div class="modal fade" id="modal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div style="margin-top: 100px" class="col mx-auto modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="container">
                        <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">

                            <div class="row">

                                <div class="col-md-6 col-lg-7 p-b-30">
                             <img style="width : 100%"  class="d-block w-100" src="{{ asset('storage/'.$product->main_image) }}" alt="First slide">

                                </div>

                                <div class="col-md-6 col-lg-5 p-b-30">
                                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                          {{ $product->title }}
                                        </h4>

                                        <span class="mtext-106 cl2">
                                            ${{ $product->price }}
                                        </span>

                                        <p class="stext-102 cl3 p-t-23">
                                            {{ $product->description }}
                                        </p>
                                        <p class="stext-102 cl3 p-t-23">
                                            {{ $product->color }}
                                        </p>
                                        <!--  -->
                                            <form wire:submit.prevent='save' >

                                        <div class="p-t-33">
                                            @if(count($product->sizes)!=0)
                                            <div class="flex-w flex-r-m p-b-10">
                                                <div class="size-203 flex-c-m respon6">
                                                    Size
                                                </div>


                                                <div class="size-204 respon6-next">
                                                    <div class="rs1-select2 bor8 bg0">
                                                        <select class="js-select2" name="size">
                                                            <option>Choose an option</option>
                                                                @foreach ($product->sizes as $size)
                                                                <option>{{ $size->size_en }}</option>
                                                                @endforeach
                                                        </select>
                                                        <div class="dropDownSelect2"></div>
                                                    </div>
                                                </div>

                                            </div>
                                            @endif
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="flex-w flex-r-m p-b-10">

                                                <div class="size-204 flex-w flex-m respon6-next">
                                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                                        </div>

                                                        <input  class="mtext-104 cl3 txt-center num-product" type="number" name="quentity" value="1">

                                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                                        </div>
                                                    </div>

                                                    <button wire:model='save'  class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                                        Add to cart
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>

                                        <!--  -->
                                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                            <div class="flex-m bor9 p-r-10 m-r-11">
                                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                                                    <i class="zmdi zmdi-favorite"></i>
                                                </a>
                                            </div>

                                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>

                                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>

                                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                  </div>
                </div>
                </div>

                        @endforeach
                    </div> --}}




                </div>



        <!-- Pagination -->
        {{-- <div class="flex-c-m flex-w w-full p-t-38">
            @if ($products->onFirstPage())
                <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
                    1
                </a>
            @else
                <a href="{{ $products->previousPageUrl()."#products" }}" class="flex-c-m how-pagination1 trans-04 m-all-7">
                    {{ $products->currentPage() - 1 }}
                </a>
            @endif

            @if ($products->hasMorePages())
                <a  href="{{ $products->nextPageUrl()."#products"}}" class="flex-c-m how-pagination1 trans-04 m-all-7">
                    {{ $products->currentPage() + 1 }}
                </a>
            @endif
        </div> --}}

    </div>


</section>

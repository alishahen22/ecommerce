<div >
    <div class="text-center">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="row isotope-grid">

        @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
            <!-- Block2 -->
            <div class="block2" style="max-width: 200px">
                <div class="block2-pic hov-img0 ">
                    {{-- <img src="{{asset('front')}}/{{asset('front')}}/images/product-01.jpg" alt="IMG-PRODUCT"> --}}
                    <img src="{{asset('storage/'. $product->main_image)}}" alt="IMG-PRODUCT">

                    <button wire:click="openModel({{$product->id}})"  class=" block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 "  data-toggle="modal" data-target="#modal" >
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
        @endforeach
          <!-- Modal -->
          @if ($count==1)

          <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
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
                         <img style="max-width : 200px "  class="d-block w-100 mx-auto" src="{{ asset('storage/'.$prod->main_image) }}" alt="First slide">

                            </div>

                            <div class="col-md-6 col-lg-5 p-b-30">
                                <div class="p-r-50 p-t-5 p-lr-0-lg">
                                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                      {{ $prod->title }}
                                    </h4>

                                    <span class="mtext-106 cl2">
                                        ${{ $prod->price }}
                                    </span>

                                    <p class="stext-102 cl3 p-t-23">
                                        {{ $prod->description }}
                                    </p>
                                    <p class="stext-102 cl3 p-t-23">
                                         {{__('front.color')}} :
                                        <svg style="color: {{ $prod->color }}" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                            <circle cx="8" cy="8" r="8"/>
                                          </svg>
                                    </p>
                                    <!--  -->
                                        <form wire:submit.prevent='save' >

                                    <div class="p-t-33">

                                        <div class="flex-w flex-r-m p-b-10">
                                            <div class="size-203 flex-c-m respon6">
                                                {{__('front.size')}}
                                            </div>



                                            <div class="size-204 respon6-next">
                                                <div class="rs1-select2 bor8 bg0">

                                                    <select wire:model='size' class="form-control" class="js-select2" name="size">
                                                            @foreach ($prod->quentity as $quentity)
                                                            @if ($quentity->quentity != 0)

                                                            <option value="{{ $quentity->size->size_en??'لا يوجد مقاس' }}">{{ $quentity->size->size_ar ?? "لا يوجد مقاس "}}</option>

                                                            @endif
                                                            @endforeach
                                                    </select>
                                                    <div class="dropDownSelect2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input wire:model='product_id' type="hidden" name="product_id" value="{{ $prod->id }}">
                                        <div class="flex-w flex-r-m p-b-10">

                                            <div class="size-204 flex-w flex-m respon6-next">


                                                <button wire:model='save'  class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                                    {{__('front.addtocart')}}
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

            @endif


    </div>



    {{-- {{ $products->links() }} --}}

</div>
<script>
    window.addEventListener('closemodal', event => {
        $('#modal').modal('hide');
    })
    </script>

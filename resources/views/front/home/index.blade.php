<!DOCTYPE html>
<html  >
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    @media (min-width: 700px) {
      .modal-dialog {
        min-width: 800px;
      }
    }
  </style>
    @include('front.layouts.style')
<!--===============================================================================================-->

</head>
<body class="animsition">
    @if (session()->has('success'))
    <script>
       alert("{{ session()->get('success') }}" );
    </script>
  @endif
	<!-- Header -->
    @include('front.layouts.header')


	<!-- Sidebar -->
    @include('front.layouts.sidebar')


	<!-- Cart -->
    @include('front.layouts.cart')


    @include('front.home.slider')
	<!-- Slider -->



	<!-- Banner -->
	<div class="sec-banner bg0 p-t-95 p-b-55">
		<div class="container">
			<div class="row">

                @foreach ($categories as $category)
                <div class="col-md-6 col-lg-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{ asset('storage/'.$category->logo) }}" alt="IMG-BANNER">

						<a href="{{route('shop.category',['category'=>$category->title_en ]) }}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
                                    {{ $category->title}}
								</span>

								<span class="block1-info stext-102 trans-04">								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
                                    {{ __('front.ShopNow')  }}
								</div>
							</div>
						</a>
					</div>
				</div>
                @endforeach



			</div>
		</div>
	</div>


	<!-- Product -->
    @include('front.home.product')

	<!-- Footer -->
    @include('front.layouts.footer')

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Modal1 -->


@include('front.layouts.script')

</body>
</html>

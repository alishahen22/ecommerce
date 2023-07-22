<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    @media (min-width: 700px) {
      .modal-dialog {
        min-width: 800px;
      }
    }
  </style>
  @yield('style')
    @include('front.layouts.style')
<!--===============================================================================================-->

</head>
<body class="animsition">

	<!-- Header -->
    @include('front.layouts.header')


	<!-- Sidebar -->
    @include('front.layouts.sidebar')


	<!-- Cart -->
    @include('front.layouts.cart')


	<!-- Slider -->



	<!-- Product -->
    <div class="m-5">
    @yield('content')
</div>
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

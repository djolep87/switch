<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{asset('assets/plugins/OwlCarousel/css/owl.carousel.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/nouislider/nouislider.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
	<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
	<title>@yield('title')</title>


	<script src="http://unpkg.com/turbolinks"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	

</head>
<body>
    <div class="wrapper">
        <div class="header-wrapper">
			<div class="header-content pb-3 pb-md-0">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-4 col-md-auto">
							<div class="d-flex align-items-center">
								<div class="mobile-toggle-menu d-lg-none px-lg-2" data-trigger="#navbar_main">
									<i class='bx bx-menu'></i>
								</div>
								<div class="logo d-none d-lg-flex">
									<a href="/">
										<img src="/assets/images/trangefrangelogo.png" class="logo-icon" alt="" />
									</a>
								</div>
							</div>
						</div>
						<div class="col col-md order-4 order-md-2">
							<div class="input-group flex-nowrap px-xl-4">
								<form class="input-group w-100 my-2 my-lg-0" type="get" action="{{url('/search')}}" >
									<input type="search" name="query" class="form-control inline mt-sm-2" placeholder="Pretrazi proizvode">
									<button class="btn btn-inline my-2 my-sm-0" type="submit"><i class='bx bx-search'></i></button>
								</form>
							</div>
						</div>
						<div class="col-4 col-md-auto order-3 d-none d-xl-flex align-items-center">
							<div class="fs-1 text-white"><i class='bx bx-headphone'></i>
							</div>
							{{-- <div class="ms-2">
								<p class="mb-0 font-13">CALL US NOW</p>
								<h5 class="mb-0">+011 5827918</h5>
							</div> --}}
						</div>
						@if (Auth::check())
							<div class="col-4 col-md-auto order-2 order-md-4">
								<div class="top-cart-icons float-end">
									<nav class="navbar navbar-expand">
										<ul class="navbar-nav ms-auto">
											<li class="nav-item"><a href="account-dashboard.html" class="nav-link cart-link"><i class='bx bx-user'></i></a>
											</li>
											<li class="nav-item">
												<a href="/wishlist" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link">
													<span class="alert-count">{{$wishlists->count()}}</span>
													<i class='bx bx-star'></i>
												</a>
										
												{{-- <a href="/wishlist" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link">
													<span class="alert-count"></span>
													<i class='bx bx-heart'></i>
												</a>--}}					
											</li>
											
										</ul>
									</nav>
								</div>
							</div>
						@endif
					</div>
					<!--end row-->
				</div>
			</div>
			<div class="primary-menu border-top">
				<div class="d-flex justify-content-center">
					<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
						<div class="offcanvas-header">
							<button class="btn-close float-end"></button>
							<h5 class="py-2">Navigation</h5>
						</div>
						<ul class="navbar-nav">
							<li class="nav-item active"> <a class="nav-link" href="/">Početna</a></li>
							
							<li class="nav-item"> <a class="nav-link" href="about-us.html">O nama </a> 
							</li>
							
							<li class="nav-item"> <a class="nav-link" href="blog.html">Blog </a> 
							</li>

							<li class="nav-item"> <a class="nav-link" href="contact-us.html">Kontakt </a> 
							</li>
							
							<li class="nav-item dropdown">	<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">Moj Nalog  <i class='bx bx-chevron-down'></i></a>
								<ul class="dropdown-menu">
                                    @guest
                                        @if (Route::has('login'))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Ulogujte se') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li>
                                                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Registrujte se') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li>
                                            <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" >
                                                {{ Auth::user()->firstName }} <i class='bx bx-chevron-right'></i>
                                            </a>

                                            <ul class="submenu dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Izlogujte se') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                                        <li><a class="dropdown-item" href="/offers">Ponude</a></li>
                                        <li><a class="dropdown-item" href="/wishlist">Oglasi koje pratim</a></li>
                                        {{-- <li><a class="dropdown-item" href="account-orders.html">Orders</a></li> --}}
                                        {{-- <li><a class="dropdown-item" href="account-payment-methods.html">Payment Methods</a></li> --}}
                                        {{-- <li><a class="dropdown-item" href="account-user-details.html">User Details</a></li> --}}
                                    @endguest
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
        <main class="">
            @yield('content')
        </main>


        {{-- <footer class="sticky-footer">
			<section class="py-4 border-top bg-light">
				<div class="container">
					<div class="row row-cols-1 row-cols-md-2 align-items-center">
						<div class="col">
							<p class="mb-0">Copyright © {{ date('Y') }}. All right reserved.</p>
						</div>
					</div>
				</div>
			</section>
		</footer> --}}
		<!--end footer section-->

		
		
		<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>  
		<script>
			var editor = new FroalaEditor('#example');		
			  </script>	
    <!-- Bootstrap JS -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('assets/plugins/OwlCarousel/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js')}}"></script>
	<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{asset('assets/plugins/nouislider/nouislider.min.js')}}"></script>
	<script src="{{asset('assets/js/price-slider.js')}}"></script>
	<script src="{{asset('assets/js/product-gallery.js')}}"></script>
	<!--app JS-->
	<script src="{{asset('assets/js/app.js')}}"></script>
</body>
</html>
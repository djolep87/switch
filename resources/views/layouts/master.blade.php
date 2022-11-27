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
	<title>@yield('title')</title>

</head>
<body>
    <div class="wrapper">
        <div class="header-wrapper">
			<div class="header-content pb-3 pb-md-0">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-4 col-md-auto">
							<div class="d-flex align-items-center">
								<div class="mobile-toggle-menu d-lg-none px-lg-2" data-trigger="#navbar_main"><i class='bx bx-menu'></i>
								</div>
								<div class="logo d-none d-lg-flex">
									<a href="/home">
										<img src="/assets/images/Switch.png" class="logo-icon" alt="" />
									</a>
								</div>
							</div>
						</div>
						<div class="col col-md order-4 order-md-2">
							<div class="input-group flex-nowrap px-xl-4">
								<input type="text" class="form-control w-100" placeholder="Pretrazi proizvode"><span class="input-group-text cursor-pointer bg-transparent"><i class='bx bx-search'></i></span>
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
						<div class="col-4 col-md-auto order-2 order-md-4">
							<div class="top-cart-icons float-end">
								<nav class="navbar navbar-expand">
									<ul class="navbar-nav ms-auto">
										<li class="nav-item"><a href="account-dashboard.html" class="nav-link cart-link"><i class='bx bx-user'></i></a>
										</li>
										<li class="nav-item"><a href="wishlist.html" class="nav-link cart-link"><i class='bx bx-heart'></i></a>
										</li>
										<li class="nav-item dropdown dropdown-large">
											<a href="#" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link" data-bs-toggle="dropdown">	<span class="alert-count">8</span>
												<i class='bx bx-shopping-bag'></i>
											</a>
											<div class="dropdown-menu dropdown-menu-end">
												<a href="javascript:;">
													<div class="cart-header">
														<p class="cart-header-title mb-0">8 ITEMS</p>
														<p class="cart-header-clear ms-auto mb-0">VIEW CART</p>
													</div>
												</a>
												<div class="cart-list">
													<a class="dropdown-item" href="javascript:;">
														<div class="d-flex align-items-center">
															<div class="flex-grow-1">
																<h6 class="cart-product-title">Men White T-Shirt</h6>
																<p class="cart-product-price">1 X $29.00</p>
															</div>
															<div class="position-relative">
																<div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
																</div>
																<div class="cart-product">
																	{{-- <img src="assets/images/products/01.png" class="" alt="product image"> --}}
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item" href="javascript:;">
														<div class="d-flex align-items-center">
															<div class="flex-grow-1">
																<h6 class="cart-product-title">Puma Sports Shoes</h6>
																<p class="cart-product-price">1 X $29.00</p>
															</div>
															<div class="position-relative">
																<div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
																</div>
																<div class="cart-product">
																	{{-- <img src="assets/images/products/05.png" class="" alt="product image"> --}}
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item" href="javascript:;">
														<div class="d-flex align-items-center">
															<div class="flex-grow-1">
																<h6 class="cart-product-title">Women Red Sneakers</h6>
																<p class="cart-product-price">1 X $29.00</p>
															</div>
															<div class="position-relative">
																<div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
																</div>
																<div class="cart-product">
																	{{-- <img src="assets/images/products/17.png" class="" alt="product image"> --}}
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item" href="javascript:;">
														<div class="d-flex align-items-center">
															<div class="flex-grow-1">
																<h6 class="cart-product-title">Black Headphone</h6>
																<p class="cart-product-price">1 X $29.00</p>
															</div>
															<div class="position-relative">
																<div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
																</div>
																<div class="cart-product">
																	{{-- <img src="assets/images/products/10.png" class="" alt="product image"> --}}
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item" href="javascript:;">
														<div class="d-flex align-items-center">
															<div class="flex-grow-1">
																<h6 class="cart-product-title">Blue Girl Shoes</h6>
																<p class="cart-product-price">1 X $29.00</p>
															</div>
															<div class="position-relative">
																<div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
																</div>
																<div class="cart-product">
																	{{-- <img src="assets/images/products/08.png" class="" alt="product image"> --}}
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item" href="javascript:;">
														<div class="d-flex align-items-center">
															<div class="flex-grow-1">
																<h6 class="cart-product-title">Men Leather Belt</h6>
																<p class="cart-product-price">1 X $29.00</p>
															</div>
															<div class="position-relative">
																<div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
																</div>
																<div class="cart-product">
																	{{-- <img src="assets/images/products/18.png" class="" alt="product image"> --}}
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item" href="javascript:;">
														<div class="d-flex align-items-center">
															<div class="flex-grow-1">
																<h6 class="cart-product-title">Men Yellow T-Shirt</h6>
																<p class="cart-product-price">1 X $29.00</p>
															</div>
															<div class="position-relative">
																<div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
																</div>
																<div class="cart-product">
																	{{-- <img src="assets/images/products/04.png" class="" alt="product image"> --}}
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item" href="javascript:;">
														<div class="d-flex align-items-center">
															<div class="flex-grow-1">
																<h6 class="cart-product-title">Pool Charir</h6>
																<p class="cart-product-price">1 X $29.00</p>
															</div>
															<div class="position-relative">
																<div class="cart-product-cancel position-absolute"><i class='bx bx-x'></i>
																</div>
																<div class="cart-product">
																	{{-- <img src="assets/images/products/16.png" class="" alt="product image"> --}}
																</div>
															</div>
														</div>
													</a>
												</div>
												<a href="javascript:;">
													<div class="text-center cart-footer d-flex align-items-center">
														<h5 class="mb-0">TOTAL</h5>
														<h5 class="mb-0 ms-auto">$189.00</h5>
													</div>
												</a>
												<div class="d-grid p-3 border-top">	<a href="javascript:;" class="btn btn-dark btn-ecomm">CHECKOUT</a>
												</div>
											</div>
										</li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
			<div class="primary-menu border-top">
				<div class="container">
					<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
						<div class="offcanvas-header">
							<button class="btn-close float-end"></button>
							<h5 class="py-2">Navigation</h5>
						</div>
						<ul class="navbar-nav">
							<li class="nav-item active"> <a class="nav-link" href="/">Home </a> 
							</li>
							<li class="nav-item dropdown">	<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">Categories <i class='bx bx-chevron-down'></i></a>
								<div class="dropdown-menu dropdown-large-menu">
									<div class="row">
										<div class="col-md-4">
											<h6 class="large-menu-title">Fashion</h6>
											<ul class="">
												<li><a href="#">Casual T-Shirts</a>
												</li>
												<li><a href="#">Formal Shirts</a>
												</li>
												<li><a href="#">Jackets</a>
												</li>
												<li><a href="#">Jeans</a>
												</li>
												<li><a href="#">Dresses</a>
												</li>
												<li><a href="#">Sneakers</a>
												</li>
												<li><a href="#">Belts</a>
												</li>
												<li><a href="#">Sports Shoes</a>
												</li>
											</ul>
										</div>
										<!-- end col-3 -->
										<div class="col-md-4">
											<h6 class="large-menu-title">Electronics</h6>
											<ul class="">
												<li><a href="#">Mobiles</a>
												</li>
												<li><a href="#">Laptops</a>
												</li>
												<li><a href="#">Macbook</a>
												</li>
												<li><a href="#">Televisions</a>
												</li>
												<li><a href="#">Lighting</a>
												</li>
												<li><a href="#">Smart Watch</a>
												</li>
												<li><a href="#">Galaxy Phones</a>
												</li>
												<li><a href="#">PC Monitors</a>
												</li>
											</ul>
										</div>
										<!-- end col-3 -->
										<div class="col-md-4">
											<div class="pramotion-banner1">
												{{-- <img src="assets/images/gallery/menu-img.jpg" class="img-fluid" alt="" /> --}}
											</div>
										</div>
										<!-- end col-3 -->
									</div>
									<!-- end row -->
								</div>
								<!-- dropdown-large.// -->
							</li>
							<li class="nav-item dropdown">	<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">Shop  <i class='bx bx-chevron-down'></i></a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret" href="#">Shop Layouts <i class='bx bx-chevron-right float-end'></i></a>
										<ul class="submenu dropdown-menu">
											<li><a class="dropdown-item" href="shop-grid-left-sidebar.html">Shop Grid - Left Sidebar</a>
											</li>
											<li><a class="dropdown-item" href="shop-grid-right-sidebar.html">Shop Grid - Right Sidebar</a>
											</li>
											<li><a class="dropdown-item" href="shop-list-left-sidebar.html">Shop List - Left Sidebar</a>
											</li>
											<li><a class="dropdown-item" href="shop-list-right-sidebar.html">Shop List - Right Sidebar</a>
											</li>
											<li><a class="dropdown-item" href="shop-grid-filter-on-top.html">Shop Grid - Top Filter</a>
											</li>
											<li><a class="dropdown-item" href="shop-list-filter-on-top.html">Shop List - Top Filter</a>
											</li>
										</ul>
									</li>
									<li><a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret" href="#">Shop Pages <i class='bx bx-chevron-right float-end'></i></a>
										<ul class="submenu dropdown-menu">
											<li><a class="dropdown-item" href="shop-cart.html">Shop Cart</a>
											</li>
											<li><a class="dropdown-item" href="shop-categories.html">Shop Categories</a>
											</li>
											<li><a class="dropdown-item" href="checkout-details.html">Checkout Details</a>
											</li>
											<li><a class="dropdown-item" href="checkout-shipping.html">Checkout Shipping</a>
											</li>
											<li><a class="dropdown-item" href="checkout-payment.html">Checkout Payment</a>
											</li>
											<li><a class="dropdown-item" href="checkout-review.html">Checkout Review</a>
											</li>
											<li><a class="dropdown-item" href="checkout-complete.html">Checkout Complete</a>
											</li>
											<li><a class="dropdown-item" href="order-tracking.html">Order Tracking</a>
											</li>
											<li><a class="dropdown-item" href="product-comparison.html">Product Comparison</a>
											</li>
										</ul>
									</li>
									<li><a class="dropdown-item" href="about-us.html">About Us</a>
									</li>
									<li><a class="dropdown-item" href="contact-us.html">Contact Us</a>
									</li>
									<li><a class="dropdown-item" href="authentication-signin.html">Sign In</a>
									</li>
									<li><a class="dropdown-item" href="authentication-signup.html">Sign Up</a>
									</li>
									<li><a class="dropdown-item" href="authentication-forgot-password.html">Forgot Password</a>
									</li>
								</ul>
							</li>
							<li class="nav-item"> <a class="nav-link" href="blog.html">Blog </a> 
							</li>
							<li class="nav-item"> <a class="nav-link" href="about-us.html">About Us </a> 
							</li>
							<li class="nav-item"> <a class="nav-link" href="contact-us.html">Contact Us </a> 
							</li>
							<li class="nav-item"> <a class="nav-link" href="shop-categories.html">Our Store</a> 
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
                                        <li><a class="dropdown-item" href="/dashboard">Dashboard</a>
                                        </li>
                                        <li><a class="dropdown-item" href="account-downloads.html">Downloads</a>
                                        </li>
                                        <li><a class="dropdown-item" href="account-orders.html">Orders</a>
                                        </li>
                                        <li><a class="dropdown-item" href="account-payment-methods.html">Payment Methods</a>
                                        </li>
                                        <li><a class="dropdown-item" href="account-user-details.html">User Details</a>
                                        </li>
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
							<p class="mb-0">Copyright © 2021. All right reserved.</p>
						</div>
					</div>
				</div>
			</section>
		</footer> --}}
		<!--end footer section-->


    
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
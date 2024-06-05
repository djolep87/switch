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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
	
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


	
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	{{-- <script src="http://unpkg.com/turbolinks"></script> --}}

</head>
<body>
    <div class="wrapper">
		<div class="discount-alert d-blok d-lg-none">
			<div class="alert alert-dismissible fade show shadow-none rounded-0 mb-0 border-bottom">
				<div class="d-lg-flex align-items-center gap-2 justify-content-center">
					<a class="text-decoration-none" href="/"><p class="text-center float-center"> <strong>TF</strong></p></a>
					
				  
				</div>
				
			</div>
		</div>
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
										<img src="/assets/images/logo.png" class="logo-icon" alt="" />
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
													@if ($wishlists->count())
														<span class="alert-count">{{$wishlists->count()}}</span>														
													@endif
													<i class='bx bx-star'></i>
												</a>
										
												{{-- <a href="/wishlist" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link">
													<span class="alert-count"></span>
													<i class='bx bx-heart'></i>
												</a>--}}					
											</li>
											{{-- <li class="nav-item dropdown">	
											<a class="nav-link cart-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
												@if (auth()->user()->unreadNotifications->count())
													<span class="alert-count">{{auth()->user()->unreadNotifications->count()}}</span>
												@endif
												<i class='bx bx-bell'></i>
											</a>
												<a href="" class="nav-link cart-link"><i class="bx bx-bell"></i></a>
												<ul class="dropdown-menu">
													<li><a class="dropdown-item" style="color: blue" href="{{route('markAsRead')}}">Mark all as read </a></li>
													@foreach (auth()->user()->unreadNotifications as $notification)
														<li style="background-color:lightgray;">
															<a href="{{route('markAsRead')}}" class="dropdown-item">{{$notification->data['data']}}</a>
														</li>														
													@endforeach

													@foreach (auth()->user()->readNotifications as $notification)
														<li>
															<a href="/offers" class="dropdown-item">{{$notification->data['data']}}</a>
														</li>														
													@endforeach
												</ul>
												
											</li> --}}

											<li class="nav-item dropdown">	
												<a class="nav-link cart-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
													@if (auth()->user()->unreadNotifications->count())
														<span class="alert-count">{{ auth()->user()->unreadNotifications->count() }}</span>
													@endif
													<i class='bx bx-bell'></i>
												</a>
												<ul class="dropdown-menu">
													{{-- <li><a class="dropdown-item" style="color: blue" href="{{ route('markAllAsRead') }}">Mark all as read </a></li> --}}
													@foreach (auth()->user()->unreadNotifications as $notification)
														<li style="background-color:lightgray;">
															<a href="{{ route('markAsRead', ['notificationId' => $notification->id]) }}" class="dropdown-item"><i class="bx bx-bell"></i>    {{ $notification->data['data'] }}</a>
														</li>														
													@endforeach
											
													@foreach (auth()->user()->readNotifications as $notification)
														<li>
															<a href="/offers" class="dropdown-item"><i class="bx bx-bell"></i>    {{ $notification->data['data'] }}</a>
														</li>														
													@endforeach
												</ul>
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
							
							<li class="nav-item"> <a class="nav-link" href="/about">O nama </a> 
							</li>
							
							<li class="nav-item"> <a class="nav-link" href="/blog">Blog </a> 
							</li>

							<li class="nav-item"> <a class="nav-link" href="/contact">Kontakt </a> 
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

		<footer>
			<section class="py-4 border-top bg-light">
				<div class="container">
					<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
						<div class="col">
							<div class="footer-section1 mb-3">
								<h6 class="mb-3 text-uppercase">Kontakt Informacija</h6>
								<div class="address mb-3">
									<p class="mb-0 text-uppercase">Adresa</p>
									<p class="mb-0 font-12">Svetolika Rankovića 4</p>
								</div>
								<div class="phone mb-3">
									<p class="mb-0 text-uppercase">Telefon</p>
									{{-- <p class="mb-0 font-13">Toll Free (123) 472-796</p> --}}
									<p class="mb-0 font-13">Mobile : (+381) 69 47 44 929</p>
								</div>
								<div class="email mb-3">
									<p class="mb-0 text-uppercase">Email</p>
									<p class="mb-0 font-13">info@trangefrange.com</p>
								</div>
								{{-- <div class="working-days mb-3">
									<p class="mb-0 text-uppercase">Radno vreme</p>
									<p class="mb-0 font-13">Pon - Pet / 9:00 AM - 6:30 PM</p>
								</div> --}}
							</div>
						</div>
						<div class="col">
							<div class="footer-section2 mb-3">
								<h6 class="mb-3 text-uppercase">Shop Categories</h6>
								<ul class="list-unstyled">
									<li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Jeans</a>
									</li>
									<li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> T-Shirts</a>
									</li>
									<li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Sports</a>
									</li>
									<li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Shirts & Tops</a>
									</li>
									<li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Clogs & Mules</a>
									</li>
									<li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Sunglasses</a>
									</li>
									<li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Bags & Wallets</a>
									</li>
									<li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Sneakers & Athletic</a>
									</li>
									<li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Electronis</a>
									</li>
									<li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i> Furniture</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col">
							<div class="footer-section3 mb-3">
								<h6 class="mb-3 text-uppercase">Popular Tags</h6>
								<div class="tags-box"> <a href="javascript:;" class="tag-link">Cloths</a>
									<a href="javascript:;" class="tag-link">Electronis</a>
									<a href="javascript:;" class="tag-link">Furniture</a>
									<a href="javascript:;" class="tag-link">Sports</a>
									<a href="javascript:;" class="tag-link">Men Wear</a>
									<a href="javascript:;" class="tag-link">Women Wear</a>
									<a href="javascript:;" class="tag-link">Laptops</a>
									<a href="javascript:;" class="tag-link">Formal Shirts</a>
									<a href="javascript:;" class="tag-link">Topwear</a>
									<a href="javascript:;" class="tag-link">Headphones</a>
									<a href="javascript:;" class="tag-link">Bottom Wear</a>
									<a href="javascript:;" class="tag-link">Bags</a>
									<a href="javascript:;" class="tag-link">Sofa</a>
									<a href="javascript:;" class="tag-link">Shoes</a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="footer-section4 mb-3">
								<h6 class="mb-3 text-uppercase">Stay informed</h6>
								<div class="subscribe">
									<input type="text" class="form-control radius-30" placeholder="Enter Your Email" />
									<div class="mt-2 d-grid">	<a href="javascript:;" class="btn btn-dark btn-ecomm radius-30">Subscribe</a>
									</div>
									<p class="mt-2 mb-0 font-13">Subscribe to our newsletter to receive early discount offers, updates and new products info.</p>
								</div>
								<div class="download-app mt-3">
									<h6 class="mb-3 text-uppercase">Download our app</h6>
									<div class="d-flex align-items-center gap-2">
										<a href="javascript:;">
											<img src="assets/images/icons/apple-store.png" class="" width="160" alt="" />
										</a>
										<a href="javascript:;">
											<img src="assets/images/icons/play-store.png" class="" width="160" alt="" />
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
					<hr/>
					<div class="row row-cols-1 row-cols-md-2 align-items-center">
						<div class="col">
							<p class="mb-0">Copyright © 2021. All right reserved.</p>
						</div>
						<div class="col text-end">
							<div class="payment-icon">
								<div class="row row-cols-auto g-2 justify-content-end">
									<div class="col">
										<img src="assets/images/icons/visa.png" alt="" />
									</div>
									<div class="col">
										<img src="assets/images/icons/paypal.png" alt="" />
									</div>
									<div class="col">
										<img src="assets/images/icons/mastercard.png" alt="" />
									</div>
									<div class="col">
										<img src="assets/images/icons/american-express.png" alt="" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
				</div>
			</section>
		</footer>
		<!--end footer section-->

		<script>
			document.getElementById("deleteButton").onclick = function(event) {
				event.preventDefault(); // sprečava podrazumevano ponašanje linka
				document.getElementById("frmDelete").submit();
			};
		</script>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>	



			<script type='text/javascript'>
					$('.like-button').click(function() {
					var likedUserId = $(this).data('user-id');
					var likeCount = $(this).data('like-count');
					$('.dislike-button').prop('disabled', true);
					$('.like-button').prop('disabled', true);
					$('.like-count').html('Loading...');
					$.ajax({
						method: 'POST',
						url: '{{ route("like") }}',
						data: {
							liked_user_id: likedUserId,
							_token: '{{ csrf_token() }}'
						},
						success: function(html) {
							$('.like-count').html(html.liked);
							$('.dislike-count').html(html.disliked);
							// Handle success response
							// location.reload();
						},
						error: function(xhr) {
							$('.like-count').html(likeCount);
							
						}
					});
					$('.dislike-button').prop('disabled', false);
					$('.like-button').prop('disabled', false);
				});
			</script>
			<script type='text/javascript'>
				$('.dislike-button').click(function() {
					var likedUserId = $(this).data('user-id');
					$('.dislike-button').prop('disabled', true);
					$('.like-button').prop('disabled', true);
					var dislikeCount = $(this).data('dislike-count');
					// $('.dislike-count').html('Loading...');
			
					$.ajax({
						method: 'POST',
						url: '{{ route("dislike") }}',
						data: {
							liked_user_id: likedUserId,
							_token: '{{ csrf_token() }}'
						},
						success: function(html) {
							console.log(html);
							$('.like-count').html(html.liked);
							$('.dislike-count').html(html.disliked);
							// Handle success response
							// location.reload();
						},
						error: function(xhr) {
							// Handle error response
							console.log(xhr.responseText);
						}
					});
					$('.dislike-button').prop('disabled', false);
					$('.like-button').prop('disabled', false);
				});
			</script>
			
			<script>
				const checkbox = document.getElementById("flexSwitchCheckChecked");
			
			checkbox.addEventListener("click", function() {
			  if (checkbox.checked) {
				checkbox.value = "1"; // Checked state
			  } else {
				checkbox.value = "0"; // Unchecked state
			  }
			});
			</script>

			<script>
				document.getElementById("btnDelete").onclick = function(event) {
					event.preventDefault();
					document.getElementById("frmDelete").submit();
				}

			</script>

<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>  
<script>
			var editor = new FroalaEditor('#example');		
			  </script>	
    <!-- Bootstrap JS -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	
	{{-- <script src="{{asset('assets/js/jquery.min.js')}}"></script> --}}
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
	@include('sweetalert::alert')
</body>
</html>
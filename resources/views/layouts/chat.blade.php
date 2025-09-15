<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Naša misija je da povežemo ljude širom zemlje kako bi zajedno stvarali održiviji svet. Trange Frange je online platforma koja vam omogućava da delite stvari koje vam više nisu potrebne i pronađete ono što vam treba, umesto da ih bacate. Verujemo da svaki predmet zaslužuje drugu šansu, a naša zajednica pomaže da se stvori novi život za vaše resurse.')">

    <link rel="icon" href="/assets/images/logo.svg" type="" />

    <!--plugins-->

    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/OwlCarousel/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<!-- loader-->
	<link href="{{ asset('/assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('/assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
	<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />

<!-- Animacije (Animate.css) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<title>@yield('title')</title>

	<style>
		.disabled-exchange {
			position: relative;
		}
		
		.disabled-exchange .opacity-50 {
			opacity: 0.5 !important;
			pointer-events: none;
		}
		
		.disabled-exchange .product-card {
			background-color: #f8f9fa;
			border: 2px dashed #6c757d;
		}
		
		.disabled-exchange .alert-warning {
			background-color: #fff3cd;
			border-color: #ffeaa7;
			color: #856404;
		}
		
		.disabled-exchange .alert-info {
			background-color: #d1ecf1;
			border-color: #bee5eb;
			color: #0c5460;
		}
	</style>
	
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="wrapper">
        <div class="header-wrapper ">
			<div class="header-content pb-3 pb-md-0 split-bg-warning">
				<div class="container ">
					<div class="row align-items-center">
						<div class="col-4 col-md-auto">
							<div class="d-flex align-items-center">
								<div class="mobile-toggle-menu d-lg-none d-flex px-lg-2" data-trigger="#navbar_main"><i class='bx bx-menu'></i>
									
								</div>
								<div class="logo-icon-mini d-lg-none d-lg-flex m-2">
									<a href="/">
										<img src="/assets/images/logo.svg" class="logo-icon-mini" alt="" />
									</a>
								</div>	
								<div class="logo d-none d-lg-flex">
									<a href="/">
										<img src="/assets/images/logo.svg" class="logo-icon" alt="" />
									</a>
								</div>
							</div>
						</div>
						<div class="col col-md search-max">
							<div class="input-group flex-nowrap px-xl-4">
								<form class="input-group w-100 my-2 my-lg-0" type="get" action="{{ url('/search') }}" >
									<input type="search" name="query" class="form-control inline mt-sm-2" placeholder="Pretrazi proizvode">
									<button class="btn btn-inline my-2 my-sm-0" type="submit"><i class='bx bx-search'></i></button>
								</form>
							</div>
						</div>
						<div class="d-flex col-auto ms-auto">
							@if (Auth::check())
								<div class="top-cart-icons float-end">
									<nav class="navbar navbar-expand">
										<ul class="navbar-nav ms-auto">
											<li class="nav-item"><a href="/dashboard" class="nav-link cart-link"><i class='bx bx-user'></i></a>
											</li>
											<li class="nav-item">
												<a href="/wishlist" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link">
													<!-- Prikazuje broj samo ako je wishlist != 0 -->
													<span class="alert-count" id="wishlist-count" style="display: {{ $wishlists->count() > 0 ?: 'none' }};">
														{{ $wishlists->count() }}
													</span>
													<i class="bx bx-heart"></i>
												</a>				
											</li>
											@auth
											<li class="nav-item">
												<a href="/messages" class="nav-link position-relative cart-link">
													@if (auth()->user()->unreadConversationsCount() > 0)
														<span class="alert-count">{{ auth()->user()->unreadConversationsCount() }}</span>
													@endif
													<i class="bx bx-message"></i>
												</a>
											</li>
											@endauth
											<li class="nav-item dropdown dropdown-large">
												<a href="#" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link" data-bs-toggle="dropdown">	
													@if (auth()->user()->unreadNotifications->count())
														<span class="alert-count">{{ auth()->user()->unreadNotifications->count() }}</span>
													@endif
													<i class='bx bx-bell'></i>
												</a>
												<div class="dropdown-menu dropdown-menu-end">
													<a href="javascript:;">
														<div class="cart-header">
															<i class='bx bx-bell' style="margin-right: 5px;"></i>   <p class="cart-header-title mb-0">Obaveštenja</p>
														
														</div>
													</a>
													@foreach (auth()->user()->unreadNotifications as $notification)
                                                        <div class="" style="background-color:lightgray;">
                                                            <a class="dropdown-item" href="{{ route('markAsRead', ['notificationId' => $notification->id]) }}">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-grow-1">
                                                                        <h6 class="cart-product-title">{{ $notification->data['data'] }}</h6>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div> 
                                                    @endforeach
												</div>
											</li>
										</ul>
									</nav>
								</div>
							@else
							<a class="btn
									btt-info" href="/login"><img style="width: 32px" src="/assets/images/login.svg" alt=""> Prijavi se</a>
							@endif
    					</div>
    				</div>
					<div class="search-min col col-md order-4 order-md-2 mb-2">
						<div class="input-group flex-nowrap px-xl-4">
							<form class="input-group w-100 my-2 my-lg-0" type="get" action="{{ url('/search') }}">
								<input type="search" name="query" class="form-control inline mt-sm-2"
									placeholder="Pretrazi proizvode">
								<button class="btn btn-inline my-2 my-sm-0" type="submit"><i class='bx bx-search'></i></button>
							</form>
						</div>
					</div>
					<!--end row-->
    			</div>
    		</div>
			<div class="primary-menu border-top">
				<div class="d-flex justify-content-center">
					<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
						<div class="offcanvas-header">
							<button class="btn-close float-end"></button>
							<h5 class="py-2"></h5>
						</div>
						<ul class="navbar-nav">
							<li class="nav-item active"> <a class="nav-link" href="/">Početna</a></li>
							<li class="nav-item"> <a class="nav-link" href="/about">O nama </a></li>
							<li class="nav-item"> <a class="nav-link" href="/kakoradi">Vodič</a> </li>
							<li class="nav-item"> <a class="nav-link" href="/blog">Blog </a> </li>
							<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
									href="#" data-bs-toggle="dropdown">Moj Nalog <i class='bx bx-chevron-down'></i></a>
								<ul class="dropdown-menu">
									@guest
										@if (Route::has('login'))
											<li>
												<a class="dropdown-item" href="{{ route('login') }}">{{ __('Ulogujte se') }}</a>
											</li>
										@endif

										@if (Route::has('register'))
											<li>
												<a class="dropdown-item"
													href="{{ route('register') }}">{{ __('Registrujte se') }}</a>
											</li>
										@endif
									@else
										<li>
											<a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret" href="#"
												data-bs-toggle="dropdown">
												{{ Auth::user()->firstName }} <i class='bx bx-chevron-right'></i>
											</a>
                                            <ul class="submenu dropdown-menu">
                                                <a class="dropdown-item" href="/admin/dashboard">Admin Dashboard</a>
                                            </ul>

											<ul class="submenu dropdown-menu">
                                                @if(Auth::user()->is_admin)
                                            	    <a class="dropdown-item" href="/admin/dashboard"> Admin Dashboard</a>
                                                @endif
												<a class="dropdown-item" href="{{ route('logout') }}"
													onclick="event.preventDefault();
																									document.getElementById('logout-form').submit();">
													{{ __('Izlogujte se') }}
												</a>

												<form id="logout-form" action="{{ route('logout') }}" method="POST"
													class="d-none">
													@csrf
												</form>
											</ul>
										</li>
										<li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
										<li><a class="dropdown-item" href="/messages">Poruke</a></li>
										<li><a class="dropdown-item" href="/offers">Ponude</a></li>
										<li><a class="dropdown-item" href="/sendOffers">Moji zahtevi</a></li>
										<li><a class="dropdown-item" href="/wishlist">Oglasi koje pratim</a></li>
									@endguest
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
    	</div>
    </div>
    <main class="">
        @yield('content')
    </main>

    <!-- Essential Scripts for Chat -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000"
        };
    </script>

    @yield('scripts')
    </body>
</html>

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
    {{-- <link href="{{asset('/assets/css/bootstrap.min')}}" rel="stylesheet"> --}}
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
		
		/* Fix mobile dropdown visibility */
		@media (max-width: 991.98px) {
			.submenu.dropdown-menu {
				position: static !important;
				transform: none !important;
				width: 100% !important;
				box-shadow: none !important;
				border: none !important;
				background-color: #f8f9fa !important;
				margin-top: 0.5rem;
				padding-left: 1rem;
			}
			
			.submenu.dropdown-menu .dropdown-item {
				padding: 0.5rem 1rem;
				border-bottom: 1px solid #e9ecef;
			}
			
			.submenu.dropdown-menu .dropdown-item:last-child {
				border-bottom: none;
			}
			
			.submenu.dropdown-menu .dropdown-item:hover {
				background-color: #e9ecef;
			}
		}
		
		/* Ensure dropdown is visible on all screen sizes */
		.dropdown-menu.show {
			display: block !important;
		}
		
		.submenu.dropdown-menu.show {
			display: block !important;
		}
	</style>
	
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	{{-- <script src="http://unpkg.com/turbolinks"></script> --}}

</head>
<body>
    <div class="wrapper">
		{{-- <div class="discount-alert d-blok d-lg-none">
			<div class="alert alert-dismissible fade show shadow-none rounded-0 mb-0 border-bottom">
				<div class="d-lg-flex align-items-center gap-2 justify-content-center">
					<a style="width: 32px;" class="text-decoration-none" href="/"><p class="text-center float-center"> <img src="/assets/images/logo2.png"  alt="" /></p></a>
					
					
					<a href="/" class="text-center" ><p>Trange Frange</p></a>
				  
				</div>
				
			</div>
		</div> --}}
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
													
													{{-- @foreach (auth()->user()->readNotifications as $notification)
														<div class="">
															<a class="dropdown-item" href="/offers">
																<div class="d-flex align-items-center">
																	<div class="flex-grow-1">
																		<h6 class="cart-product-title">{{ $notification->data['data'] }}</h6>
																		
																	</div>
																</div>
															</a>
														</div>													
													@endforeach --}}
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
                            {{-- <div class="address mb-3">
									<p class="mb-0 text-uppercase">Adresa</p>
									<p class="mb-0 font-12">Svetolika Rankovića 4</p>
								</div>
								<div class="phone mb-3">
									<p class="mb-0 text-uppercase">Telefon</p>
									<p class="mb-0 font-13">Toll Free (123) 472-796</p>
									
								</div> --}}
                            <div class="email mb-3">
                                <p class="mb-0 text-uppercase">Email</p>
                                {{-- <p class="mb-0 font-13">info@trange-frange.rs</p> --}}
                                <a href="mailto:info@trange-frange.rs">info@trange-frange.rs</a><br>
                                <a href="mailto:info@trange-frange.rs">support@trange-frange.rs</a>
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-section2 mb-3">
                            <h6 class="mb-3 text-uppercase">Korisno</h6>
                            <ul class="list-unstyled">
                                <li class="mb-1"><a href="/"><i class='bx bx-chevron-right'></i>Početna</a></li>
                                <li class="mb-1"><a href="/about"><i class='bx bx-chevron-right'></i>O nama</a></li>
                                <li class="mb-1"><a href="/kakoradi"><i class='bx bx-chevron-right'></i>Kako radi</a></li>
                                <li class="mb-1"><a href="/postavioglas"><i class='bx bx-chevron-right'></i>Kako postaviti oglas</a></li>
                                <li class="mb-1"><a href="/razmena"><i class='bx bx-chevron-right'></i>Uputstvo za razmenu</a></li>
                                <li class="mb-1"><a href="/messages"><i class='bx bx-chevron-right'></i>Poruke</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-section2 mb-3">
                            <h6 class="mb-3 text-uppercase">Uslovi i pravila</h6>
                            <ul class="list-unstyled">

                                <li class="mb-1"><a href="/uslovi"><i class='bx bx-chevron-right'></i>Uslovi korišćenja</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-section2 mb-3">
                            <h6 class="mb-3 text-uppercase">Društvene mreže</h6>
                            <ul class="list-unstyled">

                                <a href="https://www.instagram.com/trange.frange.rs/"> <img src="/assets/images/icons/instagram.svg" > </a>
                                <a href="/uslovi"> <img src="/assets/images/icons/facebook.svg" > </a>
                                
                                
                            </ul>
                        </div>
                    </div>
                    {{-- <div class="col">
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
						</div> --}}
                </div>
                <!--end row-->
                <hr />
                <div class="row row-cols-1 row-cols-md-2 align-items-center">
                    <div class="col">
                        <p class="mb-0">Copyright © 2022. All right reserved.</p>
                    </div>
                    {{-- <div class="col text-end">
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
						</div> --}}
                </div>
                <!--end row-->
            </div>
        </section>
    </footer>
    <!--end footer section-->




<script>
    async function confirmDelete(event, productId) {
        // Preveniranje klasičnog ponašanja linka
        event.preventDefault();

        // Prikazivanje SweetAlert 2 dijaloga
        const result = await Swal.fire({
            title: 'Da li ste sigurni?',
            text: "Ova radnja će trajno obrisati oglas!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Da, obriši!',
            cancelButtonText: 'Ne, otkaži!',
            reverseButtons: true
        });

        // Ako korisnik potvrdi brisanje, šaljemo formu
        if (result.isConfirmed) {
            document.getElementById('frmDelete-' + productId).submit();
        } else {
            // Ako korisnik otkaže, prikazujemo obaveštenje da je operacija otkazana
            Swal.fire(
                'Otkazano',
                'Oglas nije obrisan.',
                'info'
            );
        }
    }
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButton = document.getElementById("deleteButton");
            var deleteForm = document.getElementById("frmDelete");

            if (deleteButton && deleteForm) {
                deleteButton.onclick = function(event) {
                    event.preventDefault(); // Prevents default link behavior
                    deleteForm.submit();
                };
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.deleteButton');

            deleteButtons.forEach(function(deleteButton) {
                deleteButton.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevents default link behavior
                    var itemId = this.getAttribute('data-id'); // Get the ID from data attribute
                    var deleteForm = document.getElementById('formDelete-' +
                        itemId); // Find the corresponding form

                    if (deleteForm) {
                        deleteForm.submit(); // Submit the form
                    }
                });
            });
        });
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
                url: '{{ route('like') }}',
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
                url: '{{ route('dislike') }}',
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
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById("flexSwitchCheckChecked");

            if (checkbox) {
                checkbox.addEventListener("click", function() {
                    if (checkbox.checked) {
                        checkbox.value = "1"; // Checked state
                    } else {
                        checkbox.value = "0"; // Unchecked state
                    }
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButton = document.getElementById("btnDelete");
            var deleteForm = document.getElementById("frmDelete");

            if (deleteButton && deleteForm) {
                deleteButton.onclick = function(event) {
                    event.preventDefault(); // Prevents default link behavior
                    deleteForm.submit();
                };
            }
        });
    </script>

    <script>
        document.querySelectorAll('.deleteButton').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const productId = this.getAttribute('data-id');
                document.getElementById('frmDelete-' + productId).submit();
            });
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editorInstance = editor;
                editor.ui.view.editable.element.style.height = '250px';
                editor.editing.view.change(writer => {
                    writer.setStyle('min-height', '250px', editor.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function(e) {
            e.preventDefault();
            var passwordInput = document.getElementById('inputChoosePassword');
            var passwordIcon = document.getElementById('toggleIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bx-hide');
                passwordIcon.classList.add('bx-show');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bx-show');
                passwordIcon.classList.add('bx-hide');
            }
        });
    </script>

    <script>
        document.getElementById('togglePassword1').addEventListener('click', function(e) {
            e.preventDefault();
            var passwordInput = document.getElementById('inputChoosePassword1');
            var passwordIcon = document.getElementById('toggleIcon1');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bx-hide');
                passwordIcon.classList.add('bx-show');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bx-show');
                passwordIcon.classList.add('bx-hide');
            }
        });

        document.getElementById('togglePassword2').addEventListener('click', function(e) {
            e.preventDefault();
            var passwordInput = document.getElementById('inputConfirmPassword');
            var passwordIcon = document.getElementById('toggleIcon2');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bx-hide');
                passwordIcon.classList.add('bx-show');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bx-show');
                passwordIcon.classList.add('bx-hide');
            }
        });
    </script>

    {{-- <script>
		$(document).ready(function() {
			// Handle click event on each wishlist icon
			$('.product-wishlist').on('click', function(e) {
				e.preventDefault();
				
				// Get the product ID from the data attribute
				let productId = $(this).data('product-id');
				let icon = $('#wishlist-icon-' + productId);
		
				$.ajax({
					url: '/add/to-wishlist/' + productId, // This route should handle both add and remove actions
					method: 'GET',
					success: function(response) {
						// Toggle the icon class based on current state
						if (icon.hasClass('bx-heart')) {
							icon.removeClass('bx-heart').addClass('bxs-heart'); // Filled heart icon for added
						} else {
							icon.removeClass('bxs-heart').addClass('bx-heart'); // Outline heart icon for removed
						}
					},
					error: function(xhr) {
						console.log('Error:', xhr.responseText);
					}
				});
			});
		});
	</script> --}}


    <script>
        $(document).ready(function() {
            // Obrada klika na wishlist ikonu
            $('.product-wishlist').on('click', function(e) {
                e.preventDefault();

                // Uzmi ID proizvoda iz data atributa
                let productId = $(this).data('product-id');
                let icon = $('#wishlist-icon-' + productId);

                $.ajax({
                    url: '/add/to-wishlist/' +
                        productId, // Ruta za dodavanje/uklanjanje proizvoda iz wishlist-a
                    method: 'GET',
                    success: function(response) {
                        // Toggle ikone: ako je prazno, promeni u popunjeno, i obrnuto
                        if (icon.hasClass('bx-heart')) {
                            icon.removeClass('bx-heart').addClass(
                                'bxs-heart'); // Dodaj u wishlist
                        } else {
                            icon.removeClass('bxs-heart').addClass(
                                'bx-heart'); // Ukloni iz wishlist
                        }

                        // Ažuriraj broj stavki u wishlistu
                        if (response.wishlist_count !== undefined) {
                            // Ažuriraj broj
                            $('#wishlist-count').text(response.wishlist_count);

                            // Prikazivanje/skrivanje broja na osnovu vrednosti
                            if (response.wishlist_count > 0) {
                                $('#wishlist-count').show();
                            } else {
                                $('#wishlist-count').hide();
                            }
                        }

                        // Prikazivanje toast obaveštenja
                        if (response.toast_message) {
                            toastr.success(response.toast_message);
                        }
                    },
                    error: function(xhr) {
                        console.log('Greška:', xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right", // Pozicija obaveštenja
            "timeOut": "5000", // Vreme trajanja obaveštenja
            "extendedTimeOut": "1000"
        };
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0KBNKD08G6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-0KBNKD08G6');
    </script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->

    {{-- <script src="{{asset('assets/js/jquery.min.js')}}"></script> --}}
    <script src="{{ asset('/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/OwlCarousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/plugins/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('/assets/js/price-slider.js') }}"></script>
    <script src="{{ asset('/assets/js/product-gallery.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('/assets/js/app.js') }}"></script>
    @include('sweetalert::alert')
    
    <script>
    // Fix notification dropdown positioning on mobile
    document.addEventListener('DOMContentLoaded', function() {
        const notificationDropdown = document.querySelector('.nav-item.dropdown.dropdown-large');
        
        if (notificationDropdown) {
            const dropdownToggle = notificationDropdown.querySelector('[data-bs-toggle="dropdown"]');
            const dropdownMenu = notificationDropdown.querySelector('.dropdown-menu');
            
            if (dropdownToggle && dropdownMenu) {
                dropdownToggle.addEventListener('click', function(e) {
                    // Small delay to ensure dropdown is shown
                    setTimeout(function() {
                        if (window.innerWidth <= 768) {
                            // Force dropdown to be visible on mobile
                            dropdownMenu.style.position = 'fixed';
                            dropdownMenu.style.top = 'auto';
                            dropdownMenu.style.right = '10px';
                            dropdownMenu.style.zIndex = '99999';
                            dropdownMenu.style.transform = 'none';
                        }
                    }, 10);
                });
                
                // Also handle when dropdown is shown via Bootstrap events
                notificationDropdown.addEventListener('shown.bs.dropdown', function() {
                    if (window.innerWidth <= 768) {
                        dropdownMenu.style.position = 'fixed';
                        dropdownMenu.style.top = 'auto';
                        dropdownMenu.style.right = '10px';
                        dropdownMenu.style.zIndex = '99999';
                        dropdownMenu.style.transform = 'none';
                    }
                });
                
                // Reset positioning when dropdown is hidden
                notificationDropdown.addEventListener('hidden.bs.dropdown', function() {
                    dropdownMenu.style.position = '';
                    dropdownMenu.style.top = '';
                    dropdownMenu.style.right = '';
                    dropdownMenu.style.zIndex = '';
                    dropdownMenu.style.transform = '';
                });
            }
        }
    });
    </script>
    </body>

</html>

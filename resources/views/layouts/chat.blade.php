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
		
		/* ===== MODERN NOTIFICATION SYSTEM ===== */
		
		/* Notification Bell Icon - inherits .cart-link styling to match other header icons */
		
		/* Notification badge uses standard .alert-count styling to match other badges */
		
		/* Notification Dropdown */
		.notification-dropdown {
			width: 380px !important;
			max-width: 90vw;
			border: none;
			box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
			border-radius: 12px;
			padding: 0;
			overflow: hidden;
			background: white;
			animation: slideInDown 0.3s ease;
		}
		
		@keyframes slideInDown {
			from {
				opacity: 0;
				transform: translateY(-10px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
		
		/* Notification Header */
		.notification-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			padding: 16px 20px;
			border-bottom: 1px solid #e9ecef;
		}
		
		.notification-header-icon {
			font-size: 1.2rem;
			margin-right: 8px;
			opacity: 0.9;
		}
		
		.notification-title {
			font-weight: 600;
			font-size: 1.1rem;
		}
		
		.notification-actions .btn {
			border-color: rgba(255, 255, 255, 0.3);
			color: white;
			font-size: 0.8rem;
			padding: 4px 8px;
		}
		
		.notification-actions .btn:hover {
			background-color: rgba(255, 255, 255, 0.2);
			border-color: rgba(255, 255, 255, 0.5);
		}
		
		/* Notification List */
		.notification-list {
			max-height: 400px;
			overflow-y: auto;
			scrollbar-width: thin;
			scrollbar-color: #ddd transparent;
		}
		
		.notification-list::-webkit-scrollbar {
			width: 4px;
		}
		
		.notification-list::-webkit-scrollbar-track {
			background: transparent;
		}
		
		.notification-list::-webkit-scrollbar-thumb {
			background: #ddd;
			border-radius: 2px;
		}
		
		/* Notification Items */
		.notification-item {
			display: block;
			padding: 16px 20px;
			border-bottom: 1px solid #f8f9fa;
			text-decoration: none;
			color: inherit;
			transition: all 0.2s ease;
			position: relative;
			background: white;
		}
		
		.notification-item:hover {
			background: #f8f9fa;
			text-decoration: none;
			color: inherit;
		}
		
		.notification-item.unread {
			background: linear-gradient(90deg, rgba(0, 123, 255, 0.05) 0%, white 100%);
		}
		
		.notification-item-content {
			display: flex;
			align-items: flex-start;
			gap: 12px;
		}
		
		.notification-icon-wrapper {
			flex-shrink: 0;
			width: 40px;
			height: 40px;
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.2rem;
			transition: all 0.2s ease;
		}
		
		.notification-item:hover .notification-icon-wrapper {
			transform: scale(1.1);
		}
		
		.notification-text {
			flex: 1;
			min-width: 0;
		}
		
		.notification-item-title {
			font-weight: 600;
			font-size: 0.95rem;
			color: #2c3e50;
			margin-bottom: 4px;
			line-height: 1.3;
		}
		
		.notification-item-message {
			font-size: 0.85rem;
			color: #6c757d;
			line-height: 1.4;
			margin-bottom: 6px;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
		}
		
		.notification-item-time {
			font-size: 0.75rem;
			color: #adb5bd;
			display: flex;
			align-items: center;
			gap: 4px;
		}
		
		.notification-item-time i {
			font-size: 0.7rem;
		}
		
		.notification-unread-indicator {
			position: absolute;
			right: 12px;
			top: 50%;
			transform: translateY(-50%);
			width: 8px;
			height: 8px;
			background: #007bff;
			border-radius: 50%;
			box-shadow: 0 0 0 2px white;
		}
		
		/* Empty State */
		.notification-empty {
			padding: 40px 20px;
		}
		
		.notification-empty-icon {
			font-size: 3rem;
			color: #dee2e6;
			margin-bottom: 16px;
		}
		
		.notification-empty-text {
			color: #6c757d;
			font-size: 0.9rem;
			margin: 0;
		}
		
		/* Notification Footer */
		.notification-footer {
			padding: 16px 20px;
			background: #f8f9fa;
			border-top: 1px solid #e9ecef;
		}
		
		.notification-footer .btn {
			border-radius: 8px;
			font-weight: 500;
			font-size: 0.9rem;
			padding: 10px;
		}
		
		/* Mobile Responsiveness */
		@media (max-width: 768px) {
			.notification-dropdown {
				width: 320px !important;
				left: auto !important;
				right: 0 !important;
			}
			
			.notification-item {
				padding: 12px 16px;
			}
			
			.notification-icon-wrapper {
				width: 36px;
				height: 36px;
				font-size: 1.1rem;
			}
			
			.notification-item-title {
				font-size: 0.9rem;
			}
			
			.notification-item-message {
				font-size: 0.8rem;
			}
		}
		
		@media (max-width: 480px) {
			.notification-dropdown {
				width: 280px !important;
			}
			
			.notification-header {
				padding: 12px 16px;
			}
			
			.notification-title {
				font-size: 1rem;
			}
			
			.notification-actions .btn {
				font-size: 0.75rem;
				padding: 3px 6px;
			}
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
												<a href="#" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link notification-toggle" data-bs-toggle="dropdown">	
													@if (auth()->user()->unreadNotifications->count())
														<span class="alert-count">{{ auth()->user()->unreadNotifications->count() }}</span>
													@endif
													<i class='bx bx-bell'></i>
												</a>
												<div class="dropdown-menu dropdown-menu-end notification-dropdown">
													<!-- Notification Header -->
													<div class="notification-header">
														<div class="d-flex align-items-center justify-content-between">
															<div class="d-flex align-items-center">
																<i class='bx bx-bell notification-header-icon'></i>
																<h6 class="notification-title mb-0">Obaveštenja</h6>
															</div>
															@if (auth()->user()->unreadNotifications->count() > 0)
																<div class="notification-actions">
																	<button class="btn btn-sm btn-outline-primary mark-all-read" onclick="markAllAsRead()">
																		<i class='bx bx-check'></i> Označi sve
																	</button>
																</div>
															@endif
														</div>
													</div>

													<!-- Notification List -->
													<div class="notification-list">
														@forelse (auth()->user()->unreadNotifications as $notification)
															@php
																$data = $notification->data;
																$icon = $data['icon'] ?? 'bx bx-bell';
																$color = $data['color'] ?? '#6c757d';
																$title = $data['title'] ?? 'Obaveštenje';
																$message = $data['message'] ?? $data['data'] ?? '';
																$timestamp = isset($data['timestamp']) ? \Carbon\Carbon::parse($data['timestamp']) : $notification->created_at;
															@endphp
															<a href="{{ route('markAsRead', ['notificationId' => $notification->id]) }}" class="notification-item unread">
																<div class="notification-item-content">
																	<div class="notification-icon-wrapper" style="background-color: {{ $color }}20; border-left: 3px solid {{ $color }};">
																		<i class="{{ $icon }}" style="color: {{ $color }};"></i>
																	</div>
																	<div class="notification-text">
																		<div class="notification-item-title">{{ $title }}</div>
																		<div class="notification-item-message">{{ $message }}</div>
																		<div class="notification-item-time">
																			<i class='bx bx-time'></i>
																			{{ $timestamp->diffForHumans() }}
																		</div>
																	</div>
																</div>
																<div class="notification-unread-indicator"></div>
															</a>
														@empty
															<div class="notification-empty">
																<div class="text-center py-4">
																	<i class='bx bx-bell-off notification-empty-icon'></i>
																	<p class="notification-empty-text">Nema novih obaveštenja</p>
																</div>
															</div>
														@endforelse
													</div>

													<!-- Notification Footer -->
													@if (auth()->user()->unreadNotifications->count() > 0)
														<div class="notification-footer">
															<a href="/offers" class="btn btn-primary btn-sm w-100">
																<i class='bx bx-list-ul'></i> Pogledaj sva obaveštenja
															</a>
														</div>
													@endif
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

    <script>
    // Enhanced notification system functionality
    document.addEventListener('DOMContentLoaded', function() {
        const notificationDropdown = document.querySelector('.nav-item.dropdown.dropdown-large');
        
        if (notificationDropdown) {
            const dropdownToggle = notificationDropdown.querySelector('[data-bs-toggle="dropdown"]');
            const dropdownMenu = notificationDropdown.querySelector('.dropdown-menu');
            
            if (dropdownToggle && dropdownMenu) {
                // Mobile positioning fix
                dropdownToggle.addEventListener('click', function(e) {
                    setTimeout(function() {
                        if (window.innerWidth <= 768) {
                            dropdownMenu.style.position = 'fixed';
                            dropdownMenu.style.top = 'auto';
                            dropdownMenu.style.right = '10px';
                            dropdownMenu.style.zIndex = '99999';
                            dropdownMenu.style.transform = 'none';
                        }
                    }, 10);
                });
                
                notificationDropdown.addEventListener('shown.bs.dropdown', function() {
                    if (window.innerWidth <= 768) {
                        dropdownMenu.style.position = 'fixed';
                        dropdownMenu.style.top = 'auto';
                        dropdownMenu.style.right = '10px';
                        dropdownMenu.style.zIndex = '99999';
                        dropdownMenu.style.transform = 'none';
                    }
                    
                    // Add animation to notification items
                    const notificationItems = dropdownMenu.querySelectorAll('.notification-item');
                    notificationItems.forEach((item, index) => {
                        item.style.opacity = '0';
                        item.style.transform = 'translateX(-20px)';
                        setTimeout(() => {
                            item.style.transition = 'all 0.3s ease';
                            item.style.opacity = '1';
                            item.style.transform = 'translateX(0)';
                        }, index * 100);
                    });
                });
                
                notificationDropdown.addEventListener('hidden.bs.dropdown', function() {
                    dropdownMenu.style.position = '';
                    dropdownMenu.style.top = '';
                    dropdownMenu.style.right = '';
                    dropdownMenu.style.zIndex = '';
                    dropdownMenu.style.transform = '';
                });
            }
        }
        
        // Add click animations to notification items
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function(e) {
                // Add ripple effect
                const ripple = document.createElement('div');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(0, 123, 255, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.left = e.offsetX + 'px';
                ripple.style.top = e.offsetY + 'px';
                ripple.style.width = ripple.style.height = '20px';
                ripple.style.pointerEvents = 'none';
                
                this.style.position = 'relative';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    });
    
    // Mark all notifications as read
    function markAllAsRead() {
        const markAllBtn = document.querySelector('.mark-all-read');
        if (markAllBtn) {
            markAllBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Obrađujem...';
            markAllBtn.disabled = true;
        }
        
        // Get all unread notification IDs
        const notificationItems = document.querySelectorAll('.notification-item.unread');
        const notificationIds = Array.from(notificationItems).map(item => {
            const href = item.getAttribute('href');
            const match = href.match(/\/notifications\/mark-as-read\/([^\/]+)/);
            return match ? match[1] : null;
        }).filter(id => id !== null);
        
        if (notificationIds.length === 0) {
            if (markAllBtn) {
                markAllBtn.innerHTML = '<i class="bx bx-check"></i> Označi sve';
                markAllBtn.disabled = false;
            }
            return;
        }
        
        // Send AJAX request to mark all as read
        fetch('/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                notification_ids: notificationIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove unread styling and update badge
                notificationItems.forEach(item => {
                    item.classList.remove('unread');
                    const indicator = item.querySelector('.notification-unread-indicator');
                    if (indicator) {
                        indicator.remove();
                    }
                });
                
                // Update badge count
                const badge = document.querySelector('.notification-toggle .alert-count');
                if (badge) {
                    badge.remove();
                }
                
                // Hide mark all button
                const markAllBtn = document.querySelector('.mark-all-read');
                if (markAllBtn) {
                    markAllBtn.style.display = 'none';
                }
                
                // Show success message
                if (typeof toastr !== 'undefined') {
                    toastr.success('Sva obaveštenja su označena kao pročitana');
                }
            }
        })
        .catch(error => {
            console.error('Error marking notifications as read:', error);
            if (markAllBtn) {
                markAllBtn.innerHTML = '<i class="bx bx-check"></i> Označi sve';
                markAllBtn.disabled = false;
            }
        });
    }
    
    // Add ripple animation CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    </script>

    @yield('scripts')
    </body>
</html>

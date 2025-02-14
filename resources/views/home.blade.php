@extends('layouts.master')

@section('title', 'Trange Frange')

@section('content')

    <div class="wrapper">
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--start slider section-->
                <section class="slider-section">
                    <div class="first-slider">
                        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                            <!-- Indikatori -->
                            <ol class="carousel-indicators">
                                @for ($i = 0; $i < 3; $i++)
                                    <li data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"></li>
                                @endfor
                            </ol>
                    
                            <div class="carousel-inner">
                                <!-- Prvi slajd -->
                                <div class="carousel-item active bg-dark-gery">
                                    <div class="row d-flex align-items-center">
                                        <div class="col d-none d-lg-flex justify-content-center">
                                            <div>
                                                <h3 class="fw-light">Nova šansa za vaše stvari!</h3>
                                                <h1>Nova šansa za vaše stvari!</h1>
                                                <p class="pb-3">Swimwear, Tops, Shorts, Sunglasses &amp; much more...</p>
                                                <a class="btn btn-dark btn-ecomm" href="javascript:;">
                                                    Shop Now <i class='bx bx-chevron-right'></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <img src="{{ asset('assets/images/slider/06.jpg') }}" class="img-fluid" alt="Slider Image 1">
                                        </div>
                                    </div>
                                </div>
                    
                                <!-- Drugi slajd -->
                                <div class="carousel-item bg-dark-gery">
                                    <div class="row d-flex align-items-center">
                                        <div class="col d-none d-lg-flex justify-content-center">
                                            <div>
                                                <h3 class="fw-light">Hurry up! Limited time offer.</h3>
                                                <h1>Women Sportswear Sale</h1>
                                                <p class="pb-3">Sneakers, Keds, Sweatshirts, Hoodies &amp; much more...</p>
                                                <a class="btn btn-dark btn-ecomm" href="javascript:;">
                                                    Shop Now <i class='bx bx-chevron-right'></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <img src="{{ asset('assets/images/slider/07.jpg') }}" class="img-fluid" alt="Slider Image 2">
                                        </div>
                                    </div>
                                </div>
                    
                                <!-- Treći slajd -->
                                <div class="carousel-item bg-dark-gery">
                                    <div class="row d-flex align-items-center">
                                        <div class="col d-none d-lg-flex justify-content-center">
                                            <div>
                                                <h2 class="h1">Kako funkcioniše?</h2>
                                                <a class="btn btn-dark btn-ecomm" href="{{ url('/kakoradi') }}">
                                                    Pročitaj više <i class='bx bx-chevron-right'></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <a href="{{ url('/kakoradi') }}">
                                                <img src="{{ asset('assets/images/slider/slider.jpg') }}" class="img-fluid" alt="Slider Image 3">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Navigacija -->
                            <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                </section>
                <!--end slider section-->
                <section class="py-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-xl-3">
                                {{-- <div class="btn-mobile-filter d-xl-none verticaltext"><i class='bx bx-category'></i>      
                            </div> --}}
                            <div class="btn-mobile-filter split-bg-warning d-xl-none verticaltext">
                                <i class='bx bx-category mt-2'></i>
                                <i class='m-2'>Kategorije</i>
                                
                            </div>
                            
                            <div class="filter-sidebar d-none d-xl-flex pb-2">
                                <div class="card rounded-0 w-100">
                                    <button onclick="window.location.href='/products.create'" class="btn split-bg-warning">
                                        Postavite oglas
                                    </button>
                                </div>
                            </div>
                                <div class="filter-sidebar d-none d-xl-flex">
                                    <div class="card rounded-0 w-100">
                                        <div class="card-body">
                                            <div class="align-items-center d-xl-none">
                                                {{-- <h6 class="text-uppercase mb-0">Filter</h6> --}}
                                                <div class="btn-mobile-filter-close btn-close ms-auto cursor-pointer"></div>
                                                
                                                <div class="card rounded-0 w-100 mt-3">
                                                    <button onclick="window.location.href='/products.create'" class="btn split-bg-warning">
                                                        Postavite oglas
                                                    </button>
                                                </div>
                                            </div>
                                            <hr class="d-flex d-xl-none" />
                                            <div class="product-categories">
                                                <h6 class="text-uppercase mb-3">
                                                    <a href="{{ route('home.index') }}">
                                                        Kategorije
                                                        <span class="float-end badge rounded-pill bg-primary"></span>
                                                    </a>
                                                </h6>
                                                <ul class="list-unstyled mb-0 categories-list">
                                                    @foreach ($categories as $category)
                                                        <li>
                                                            <a href="{{ route('home.index', ['category' => $category->name]) }}">
                                                                {{ $category->name }}
                                                                {{-- <span class="float-end badge bg-dark rounded-pill">{{ $category->products->count() }}</span> --}}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-9">
                                <div class="product-wrapper">
                                    @forelse ($products as $key => $product)
                                        @php
                                            $images = $product->images ? explode(',', $product->images) : [];
                                        @endphp
                                        <div class="product-grid">
                                            <div class="card rounded-0 product-card">
                                                <div class="d-flex align-items-center justify-content-end gap-3 position-absolute end-0 top-0 m-3">
                                                    @if (optional(Auth::user())->id == $product->user_id)
                                                        <!-- Sakrij wishlist dugme za vlasnika proizvoda -->
                                                        <div style="display: none;">
                                                            <div class="product-wishlist">
                                                                <i class="hover bx bx-heart"></i>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @php
                                                            $isInWishlist = \App\Models\Wishlist::where('user_id', Auth::id())
                                                                ->where('product_id', $product->productid)
                                                                ->exists();
                                                        @endphp
                                                        <div class="product-wishlist" data-product-id="{{ $product->productid }}" style="cursor: pointer;">
                                                            <i id="wishlist-icon-{{ $product->productid }}" class="bx {{ $isInWishlist ? 'bxs-heart' : 'bx-heart' }}"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row g-0 product-row">
                                                    @if (!empty($images))
                                                        <div class="col-md-4">
                                                            <a href="{{ route('products.show', $product->productid) }}">
                                                                <img src="/storage/Product_images/{{ $images[0] }}" class="img-fluid" alt="Product Image">
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <div class="product-info">
                                                                {{-- <a href="javascript:;">
                                                                        <p class="product-catergory font-13 mb-1">{{$product->categories->name}}</p>
                                                                    </a> --}}
                                                                <a
                                                                    href="{{ route('products.show', $product->productid) }}">
                                                                    <h4 class="product-name mb-2">{{ $product->name }}</h4>
                                                                    <h6>({{ $product->condition }})</h6>
                                                                </a>
                                                                <?php
                                                                // Zameni sve vrste linijskih prekida sa <br> tagovima
                                                                $descriptionWithBr = preg_replace("/\r\n|\r|\n/", ' <br> ', $product->description);
                                                                
                                                                // Anonimna funkcija koja uklanja HTML oznake osim <br>
                                                                $stripTagsExceptBr = function ($text) {
                                                                    return strip_tags($text, '<br>');
                                                                };
                                                                
                                                                // Očisti HTML oznake osim <br>
                                                                $cleanedDescription = $stripTagsExceptBr($descriptionWithBr);
                                                                
                                                                // Funkcija za skraćivanje teksta
                                                                $truncateText = function ($text, $maxLength = 120, $suffix = '...') {
                                                                    if (mb_strlen($text) <= $maxLength) {
                                                                        return $text;
                                                                    }
                                                                
                                                                    // Pronađi poziciju poslednjeg razmaka unutar granice
                                                                    $endPosition = mb_strpos($text, ' ', $maxLength);
                                                                    if ($endPosition === false) {
                                                                        $endPosition = $maxLength;
                                                                    }
                                                                
                                                                    // Skraćenje teksta
                                                                    $truncatedText = mb_substr($text, 0, $endPosition) . $suffix;
                                                                
                                                                    return $truncatedText;
                                                                };
                                                                
                                                                // Skrati očišćeni tekst
                                                                $shortenedDescription = $truncateText($cleanedDescription);
                                                                
                                                                // Zameni linijske prekide sa <br> tagovima u skraćenom tekstu
                                                                $formattedDescription = nl2br($shortenedDescription);
                                                                ?>
                                                                <p class="mb-0 description">{!! $formattedDescription !!}</p>

                                                                <div class="d-flex align-items-center justify-content-between gap-3 m-0">
                                                                    <div>
                                                                        <img width="16px" src="/assets/images/location.svg" alt="">
                                                                        {{ $product->users_city }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center justify-content gap-3 m-0">
                                                                    <div class="product">
                                                                        <img width="16px" src="/assets/images/eye1.svg" alt="">
                                                                        <span>{{ $product->views }}</span>
                                                                    </div>
                                                                
                                                                    <div>
                                                                        <img width="16px" src="/assets/images/avatar.svg" alt="">
                                                                        {{ $product->users_firstname }}
                                                                    </div>
                                                                
                                                                    <div>{{ $product->created_at }}</div>
                                                                </div>


                                                                @if (Auth::check())
                                                                    <div class="product-action mt-2">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="nav-item dropdown" style="width: auto; min-width: 200px;">
                                                                                @if (Auth::user()->id == $product->user_id)
                                                                                    <a href="" style="display: none" class="nav-link dropdown-toggle dropdown-toggle-nocaret btn split-bg-warning" data-bs-toggle="dropdown">
                                                                                        <i class="bx bx-refresh"></i> Zameni
                                                                                    </a>
                                                                                @else
                                                                                    <a href="" class="nav-link dropdown-toggle dropdown-toggle-nocaret btn split-bg-warning" data-bs-toggle="dropdown">
                                                                                        <i class="bx bx-refresh"></i> Zameni
                                                                                    </a>
                                                                                @endif
                                                                                <ul class="dropdown-menu">
                                                                                    <form id="offer" action="/" method="POST" enctype="multipart/form-data">
                                                                                        {{ csrf_field() }}
                                                                                        @csrf
                                                                                        <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                                                                                        <input type="hidden" name="acceptor" value="{{ $product->user_id }}">
                                                                                        <input type="hidden" name="acceptorName" value="{{ $product->firstName }}">
                                                                                        <input type="hidden" name="acceptorNumber" value="{{ $product->user->phone }}">
                                                                                        <input type="hidden" name="product_id" value="{{ $product->productid }}">
                                                                                        
                                                                                        @forelse ($listproducts as $product)
                                                                                            @php
                                                                                                $images = $product->images ? explode(',', $product->images) : [];
                                                                                            @endphp
                                                                                            <div class="m-2">
                                                                                                <div class="form-check form-check-inline">
                                                                                                    <input class="form-check-input d-flex" type="radio" name="sendproduct_id" id="inlineRadio{{ $product->id }}" value="{{ $product->id }}" {{ $product->isDisabledForCurrentExchange ? 'disabled' : '' }}>
                                                                                                    <label class="form-check-label d-flex" for="inlineRadio{{ $product->id }}">
                                                                                                        @if (!empty($images) && isset($images[0]))
                                                                                                            <img src="/storage/Product_images/{{ $images[0] }}" style="width: 30px; height: 30px;" alt="Product Image" class="me-2">
                                                                                                        @else
                                                                                                            <img src="/storage/default-image.png" style="width: 30px; height: 30px;" alt="Default Image" class="me-2">
                                                                                                        @endif
                                                                                                        {{ $product->name }}
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        @empty
                                                                                            <div class="col-xl-12 m-2">
                                                                                                <p>Nemate oglase za zamenu.</p>
                                                                                            </div>
                                                                                        @endforelse

                                                                                        <button class="btn btn-outline-dark btn-ecomm m-4" type="submit">
                                                                                            <i class="bx bx-send"></i> Pošalji
                                                                                        </button>
                                                                                    </form>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    {{-- <p>Ukoliko želite da zamenite proizvod morate imati nalog!</p> --}}
                                                                    {{-- <a class="btn btn-dark btn-ecomm px-4" href="/login">Prijavi se!</a> <a class="btn btn-dark btn-ecomm px-4" href="/register">Registruj se!</a> --}}
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top my-3"></div>
                                    @empty
                                        <div class="alert alert-info text-center" role="alert">
                                            <p>Nema oglasa!</p>
                                        </div>
                                    @endforelse
                                    {{-- {{$products->links('pagination::bootstrap-4')}} --}}
                                    {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}


                                    {{-- <nav class="d-flex justify-content-between" aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="javascript:;"><i class='bx bx-chevron-left'></i> Prev</a>
                                        </li>
                                    </ul>
                                    <ul class="pagination">
                                        <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span>
                                        </li>
                                        <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript:;">2</a>
                                        </li>
                                        <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript:;">3</a>
                                        </li>
                                        <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript:;">4</a>
                                        </li>
                                        <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript:;">5</a>
                                        </li>
                                    </ul>
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="javascript:;" aria-label="Next">Next <i class='bx bx-chevron-right'></i></a>
                                        </li>
                                    </ul>
                                </nav> --}}
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </section>
                <!--end shop area-->
            </div>
        </div>
        <!--end page wrapper -->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top">
            <i class='bx bxs-up-arrow-alt'></i>
        </a>
        <!--End Back To Top Button-->
    </div>


@endsection

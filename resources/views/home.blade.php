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
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active bg-dark-gery">
                                <div class="row d-flex align-items-center">
                                    <div class="col d-none d-lg-flex justify-content-center">
                                        <div class="">
                                            <h3 class="h3 fw-light">Has just arrived!</h3>
                                            <h1 class="h1">Huge Summer Collection</h1>
                                            <p class="pb-3">Swimwear, Tops, Shorts, Sunglasses &amp; much more...</p>
                                            <div class=""> <a class="btn btn-dark btn-ecomm" href="javascript:;">Shop Now <i class='bx bx-chevron-right'></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <img src="assets/images/slider/06.jpg" class="img-fluid" alt="...">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item bg-dark-gery">
                                <div class="row d-flex align-items-center">
                                    <div class="col d-none d-lg-flex justify-content-center">
                                        <div class="">
                                            <h3 class="h3 fw-light">Hurry up! Limited time offer.</h3>
                                            <h1 class="h1">Women Sportswear Sale</h1>
                                            <p class="pb-3">Sneakers, Keds, Sweatshirts, Hoodies &amp; much more...</p>
                                            <div class=""> <a class="btn btn-dark btn-ecomm" href="javascript:;">Shop Now <i class='bx bx-chevron-right'></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <img src="assets/images/slider/07.jpg" class="img-fluid" alt="...">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item bg-dark-gery">
                                <div class="row d-flex align-items-center">
                                    <div class="col d-none d-lg-flex justify-content-center">
                                        <div class="">
                                            <h3 class="h3 fw-light">Complete your look with</h3>
                                            <h1 class="h1">New Men's Accessories</h1>
                                            <p class="pb-3">Hats &amp; Caps, Sunglasses, Bags &amp; much more...</p>
                                            <div class=""> <a class="btn btn-dark btn-ecomm" href="javascript:;">Shop Now <i class='bx bx-chevron-right'></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <img src="assets/images/slider/08.jpg" class="img-fluid" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">	<span class="carousel-control-next-icon" aria-hidden="true"></span>
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
                            <div class="btn-mobile-filter d-xl-none verticaltext"><i class='bx bx-category'>Kategorije</i>     
                            </div>
                            <div class="filter-sidebar d-none d-xl-flex pb-2">
                                <div class="card rounded-0 w-100">
                                    <button onclick="window.location.href='/products.create'" class="btn split-bg-warning">Postavite oglas</button>
                                </div>
                            </div>
                            <div class="filter-sidebar d-none d-xl-flex">
                                <div class="card rounded-0 w-100">
                                    <div class="card-body">
                                        <div class="align-items-center d-xl-none">
                                            {{-- <h6 class="text-uppercase mb-0">Filter</h6> --}}
                                            <div class="btn-mobile-filter-close btn-close ms-auto cursor-pointer"></div><br>
                                            <div class="card rounded-0 w-100">
                                                <button onclick="window.location.href='/products.create'" class="btn split-bg-warning">Postavite oglas</button>
                                            </div>
                                        </div>
                                        <hr class="d-flex d-xl-none" />
                                        <div class="product-categories">
                                            <h6 class="text-uppercase mb-3"><a href="{{route('home.index')}}">Kategorije <span class="float-end badge rounded-pill bg-primary"></span></a></h6>
                                            <ul class="list-unstyled mb-0 categories-list">
                                                @foreach ($categories as $category)
                                                    
                                                    <li>
                                                        <a href="{{route('home.index', ['category' => $category->name])}}">{{$category->name}} 
                                                            {{-- <span class="float-end badge bg-dark rounded-pill">{{$category->products->count()}}</span> --}}
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
                                {{-- <div class="toolbox d-flex align-items-center mb-3 gap-2">
                                    <div class="d-flex flex-wrap flex-grow-1 gap-1">
                                        <div class="d-flex align-items-center flex-nowrap">
                                            <p class="mb-0 font-13 text-nowrap">Sort By:</p>
                                            <select class="form-select ms-3 rounded-0">
                                                <option value="menu_order" selected="selected">Default sorting</option>
                                                <option value="popularity">Sort by popularity</option>
                                                <option value="rating">Sort by average rating</option>
                                                <option value="date">Sort by newness</option>
                                                <option value="price">Sort by price: low to high</option>
                                                <option value="price-desc">Sort by price: high to low</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <div class="d-flex align-items-center flex-nowrap">
                                            <p class="mb-0 font-13 text-nowrap">Show:</p>
                                            <select class="form-select ms-3 rounded-0">
                                                <option>9</option>
                                                <option>12</option>
                                                <option>16</option>
                                                <option>20</option>
                                                <option>50</option>
                                                <option>100</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>	<a href="shop-grid-left-sidebar.html" class="btn btn-white rounded-0"><i class='bx bxs-grid me-0'></i></a>
                                    </div>
                                    <div>	<a href="shop-list-left-sidebar.html" class="btn btn-light rounded-0"><i class='bx bx-list-ul me-0'></i></a>
                                    </div>
                                </div> --}}
                                @forelse ($products as $key => $product)     
                                @php
                                    $images = $product->images ? explode(",", $product->images) : [];
                                @endphp    
                                        <div class="product-grid">
                                            <div class="card rounded-0 product-card">
                                                <div class="d-flex align-items-center justify-content-end gap-3 position-absolute end-0 top-0 m-3">
                                                    <div class="">
                                                        @if (optional(Auth::user())->id == $product->user_id)
                                                            <a style="display: none" href="{{url('add/to-wishlist/'.$product->productid)}}">
                                                                <div class="product-wishlist"> 
                                                                    <i class="hover bx bx-star "></i>
                                                                </div>
                                                            </a>
                                                        @else
                                                        <a href=""><i class="bx bx heart"></i></a>
                                                            <a href="{{url('add/to-wishlist/'.$product->productid)}} ">
                                                                <div class="product-wishlist"> 
                                                                    <i class="hover bx bx-star "></i>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    {{-- <div class="product">
                                                        
                                                        Viđen:
                                                        <Span><b>{{$product->views}}</b></Span>
                                                    </div>
                                                    <div class="">
                                                        @if (optional(Auth::user())->id == $product->user_id)
                                                            <a style="display: none" href="{{url('add/to-wishlist/'.$product->productid)}}">
                                                                <div class="product-wishlist"> 
                                                                    <i class="hover bx bx-star "></i>
                                                                </div>
                                                            </a>
                                                        @else
                                                            <a href="{{url('add/to-wishlist/'.$product->productid)}} ">
                                                                <div class="product-wishlist"> 
                                                                    <i class="hover bx bx-star "></i>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                     <div>{{$product->users_city}}</div> 
                                                     <div>{{$product->users_firstname}}</div>  --}}


                                                </div>
                                                <div class="row g-0">
                                                    @if (!empty($images))
                                                        <div class="col-md-4" >
                                                            <a href="{{route('products.show', $product->productid)}}"><img src="/storage/Product_images/{{$images[0]}}" class="img-fluid" alt="Product Image"></a> 
                                                        </div>                                                        
                                                    @endif
                                                    <div class="col-md-8" >
                                                        <div class="card-body" >
                                                            <div class="product-info">
                                                                {{-- <a href="javascript:;">
                                                                    <p class="product-catergory font-13 mb-1">{{$product->categories->name}}</p>
                                                                </a> --}}
                                                                <a href="{{route('products.show', $product->productid)}}">
                                                                    <h4 class="product-name mb-2">{{$product->name}}</h4>
                                                                    <h6>({{$product->condition}})</h6>
                                                                </a>
                                                                <?php
                                                                // Zameni sve vrste linijskih prekida sa <br> tagovima
                                                                $descriptionWithBr = preg_replace("/\r\n|\r|\n/", " <br> ", $product->description);
                                                                
                                                                // Anonimna funkcija koja uklanja HTML oznake osim <br>
                                                                $stripTagsExceptBr = function($text) {
                                                                    return strip_tags($text, '<br>');
                                                                };
                                                                
                                                                // Očisti HTML oznake osim <br>
                                                                $cleanedDescription = $stripTagsExceptBr($descriptionWithBr);
                                                                
                                                                // Funkcija za skraćivanje teksta
                                                                $truncateText = function($text, $maxLength = 120, $suffix = '...') {
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
                                                                <p class="mb-0">{!! $formattedDescription !!}</p>                                                              
                                                                <div class="d-flex align-items-center justify-content gap-3    m-0">
                                                                    <div class="product">
                                                                        <img width="16px" src="/assets/images/eye.svg" alt="" srcset="">
                                                                        {{-- Viđen: --}}
                                                                        <Span><b>{{$product->views}}</b></Span>
                                                                    </div>
                                                                    
                                                                    <div>
                                                                        <img width="16px" src="/assets/images/location.svg" alt="" srcset="">
                                                                        {{$product->users_city}}
                                                                    </div> 
                                                                    <div>
                                                                        <img width="16px" src="/assets/images/avatar.svg" alt="" srcset="">
                                                                        {{$product->users_firstname}}
                                                                    </div>
                                                                     <div>{{ $product->created_at}}</div>
                                                                </div>
                                                                
                                                                
                                                                @if (Auth::check())   
                                                                    <div class="product-action mt-2">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="nav-item dropdown">
                                                                                @if (Auth::user()->id == $product->user_id)
                                                                                    <a href="" style="display: none" class="nav-link dropdown-toggle dropdown-toggle-nocaret btn split-bg-warning" data-bs-toggle="dropdown"><i class="bx bxs-cart-add"></i>Pošalji zahtev za zamenu</a>
                                                                                @else 
                                                                                    <a href="" class="nav-link dropdown-toggle dropdown-toggle-nocaret btn split-bg-warning" data-bs-toggle="dropdown"><i class="bx bxs-cart-add"></i>Pošalji zahtev za zamenu</a>
                                                                                @endif
                                                                                <ul class="dropdown-menu">
                                                                                    <form id="offer" action="/" method="POST" enctype="multipart/form-data">
                                                                                        {{csrf_field()}}
                                                                                        @csrf
                                                                                        <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">
                                                                                        <input type="hidden" name="acceptor" value="{{$product->user_id}}">
                                                                                        <input type="hidden" name="acceptorName" value="{{$product->firstName}}">
                                                                                        <input type="hidden" name="acceptorNumber" value="{{$product->user->phone}}">
                                                                                        <input type="hidden" name="product_id" value="{{$product->productid}}">
                                                                                        @forelse ($listproducts as $product)  
                                                                                            @php
                                                                                                $images = $product->images ? explode(",", $product->images) : [];
                                                                                            @endphp                                                                                         
                                                                                            <div class="col m-4">
                                                                                                <div class="form-check form-check-inline">
                                                                                                    <input class="form-check-input" type="radio" name="sendproduct_id" id="inlineRadio1"
                                                                                                        value="{{$product->id}}">
                                                                                                    <label class="form-check-label" for="inlineRadio1"><img src="/storage/Product_images/{{ $images[0] }}" style="width: 30px; height: 30px" alt=""> {{ $product->name }}</label>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                        
                                                                                        @empty

                                                                                            <div class="col-xl-12 m-4">
                                                                                                <p>Nemate proizvode za zamenu.</p>
                                                                                            </div>

                                                                                        @endforelse
                                                                                            @if (Auth::user()->id == $product->user_id)
                                                                                                <button class="btn btn-outline-dark btn-ecomm m-4" href="" type="submit">Pošalji</button>                                                                                
                                                                                            @endif
                                                                                    </form>
                                                                                </ul>
                                                                            </div>
                                                                        
                                                                        </div>
                                                                    </div>
                                                                    
                                                                @else
                                                                    <p>Ukoliko želite da zamenite proizvod morate imati nalog!</p>
                                                                    <a class="btn btn-dark btn-ecomm px-4" href="/login">Prijavi se!</a> <a class="btn btn-dark btn-ecomm px-4" href="/register">Registruj se!</a>
                                                                @endif
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top my-3"></div>
                                    @empty
                                        <div><p>Nema proizvoda.</p></div>    
                                @endforelse
                                {{$products->links('pagination::bootstrap-4')}}
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


    <!--start quick view product-->
    <!-- Modal -->
    <div class="modal fade" id="QuickViewProduct">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-xl-down">
            <div class="modal-content rounded-0 border-0">
                <div class="modal-body">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                    <div class="row g-0">
                        <div class="col-12 col-lg-6">
                            <div class="image-zoom-section">
                                <div class="product-gallery owl-carousel owl-theme border mb-3 p-3" data-slider-id="1">
                                    <div class="item">
                                        {{-- <img src="/storage/Product_images/{{ $product->image }}" id="modal-product-image" class="img-fluid" alt=""> --}}
                                    </div>
                                    <div class="item">
                                        <img src="assets/images/product-gallery/02.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="assets/images/product-gallery/03.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="assets/images/product-gallery/04.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                    <button class="owl-thumb-item">
                                        <img src="assets/images/product-gallery/01.png" class="" alt="">
                                    </button>
                                    <button class="owl-thumb-item">
                                        <img src="assets/images/product-gallery/02.png" class="" alt="">
                                    </button>
                                    <button class="owl-thumb-item">
                                        <img src="assets/images/product-gallery/03.png" class="" alt="">
                                    </button>
                                    <button class="owl-thumb-item">
                                        <img src="assets/images/product-gallery/04.png" class="" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="product-info-section p-3">
                                {{-- <h3 class="mt-3 mt-lg-0 mb-0" id="modal-product-name">{{$product->name}}</h3> --}}
                                <div class="mt-3">
                                    <h6>Opis :</h6>
                                    {{-- <p id="id="modal-product-description"" class="mb-0">{{$product->description}}</p> --}}
                                </div>
                               
                                <div class="d-flex gap-2 mt-3">
                                    <a href="javascript:;" class="btn btn-dark btn-ecomm">	<i class="bx bxs-cart-add"></i>Add to Cart</a>	<a href="javascript:;" class="btn btn-light btn-ecomm"><i class="bx bx-heart"></i>Add to Wishlist</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
    
    <!--end quick view product-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
</div>


@endsection

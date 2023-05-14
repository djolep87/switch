@extends('layouts.master')

@section('content')
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start shop area-->
            <section class="py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-xl-3">
                            <div class="btn-mobile-filter d-xl-none"><i class='bx bx-slider-alt'></i>
                            </div>
                            <div class="filter-sidebar d-none d-xl-flex pb-2">
                                <div class="card rounded-0 w-100">
                                    <button onclick="window.location.href='/products.create'" class="btn btn-dark">Postavite oglas<i class='bx bx-plus'></i></button>
                                </div>
                            </div>
                            <div class="filter-sidebar d-none d-xl-flex">
                                <div class="card rounded-0 w-100">
                                    <div class="card-body">
                                        <div class="align-items-center d-flex d-xl-none">
                                            <h6 class="text-uppercase mb-0">Filter</h6>
                                            <div class="btn-mobile-filter-close btn-close ms-auto cursor-pointer"></div>
                                        </div>
                                        <hr class="d-flex d-xl-none" />
                                        <div class="product-categories">
                                            <h6 class="text-uppercase mb-3"><a href="{{route('home.index')}}">Kategorije <span class="float-end badge rounded-pill bg-primary"></span></a></h6>
                                            <ul class="list-unstyled mb-0 categories-list">
                                                @foreach ($categories as $category)
                                                    
                                                    <li><a href="{{route('home.index', ['category' => $category->name])}}">{{$category->name}} <span class="float-end badge bg-primary rounded-pill">{{$category->products->count()}}</span></a></li>

                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-9">
                            <div class="product-wrapper">
                                <div class="toolbox d-flex align-items-center mb-3 gap-2">
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
                                </div>
                                @forelse ($products as $key => $product)                                    
                                        <div class="product-grid">
                                            <div class="card rounded-0 product-card">
                                                <div class="d-flex align-items-center justify-content-end gap-3 position-absolute end-0 top-0 m-3">
                                                    <div class="product">
                                                        {{-- <img src="/assets/images/eye.png" alt="" srcset=""> --}}
                                                        Viđen:
                                                        <Span><b>{{$product->views}}</b></Span>
                                                    </div>
                                                    <div class="">
                                                        @if (optional(Auth::user())->id == $product->user_id)
                                                            <a style="display: none" href="{{url('add/to-wishlist/'.$product->id)}}">
                                                                <div class="product-wishlist"> 
                                                                    <i class="hover bx bx-star "></i>
                                                                </div>
                                                            </a>
                                                        @else
                                                            <a href="{{url('add/to-wishlist/'.$product->id)}} ">
                                                                <div class="product-wishlist"> 
                                                                    <i class="hover bx bx-star "></i>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div>{{$product->user->city}}</div>
                                                    <div>{{$product->user->firstName}}</div>
                                                </div>
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <a href="{{route('products.show', $product->id)}}"><img src="/storage/Product_images/{{ $product->image }}" class="img-fluid" style="width: 300px; height= 200px;"  alt="..."></a> 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <div class="product-info">
                                                                <a href="javascript:;">
                                                                    <p class="product-catergory font-13 mb-1">{{$categoryName}}</p>
                                                                </a>
                                                                <a href="{{route('products.show', $product->id)}}">
                                                                    <h4 class="product-name mb-2">{{$product->name}}</h4>
                                                                    <h6>({{$product->condition}})</h6>  
                                                                </a>
                                                                {{-- <p class="card-text">{!!Str::limit($product->description, 500)!!}</p> --}}
                                                                <p class="card-text">{!!$product->description!!}</p>
                                                                <div class="d-flex align-items-center">
                                                                </div>
                                                                
                                                                @if (Auth::check())   
                                                                    <div class="product-action mt-2">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="nav-item dropdown">
                                                                                @if (Auth::user()->id == $product->user_id)
                                                                                    <p>Moj proizvod!!!</p> 
                                                                                @else 
                                                                                    <a href="" class="nav-link dropdown-toggle dropdown-toggle-nocaret btn btn-outline-dark btn-ecomm" data-bs-toggle="dropdown"><i class="bx bxs-cart-add"></i>Pošalji zahtev za zamenu</a>
                                                                                @endif
                                                                                <ul class="dropdown-menu">
                                                                                    <form id="offer" action="/" method="POST" enctype="multipart/form-data">
                                                                                        {{csrf_field()}}
                                                                                        @csrf
                                                                                        <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">
                                                                                        <input type="hidden" name="acceptor" value="{{$product->user_id}}">
                                                                                        <input type="hidden" name="acceptorName" value="{{$product->user->firstName}}">
                                                                                        <input type="hidden" name="acceptorNumber" value="{{$product->user->phone}}">
                                                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                                        @forelse ($listproducts as $product)                                                                                          
                                                                                            <div class="col m-4">
                                                                                                <div class="form-check form-check-inline dropdown-item">
                                                                                                    <input class="form-check-input" type="radio" name="sendproduct_id" id="inlineRadio1"
                                                                                                        value="{{$product->id}}">
                                                                                                    <label class="form-check-label" for="inlineRadio1"><img src="/storage/Product_images/{{ $product->image }}" style="width: 30px; height: 30px" alt=""> {{   $product->name }}</label>
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
                                {{-- {{$products->links('pagination::bootstrap-4')}} --}}
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

@include('sweetalert::alert')
@endsection
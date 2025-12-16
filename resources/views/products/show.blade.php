@extends('layouts.master')

@section('title', 'Detalji')

@section('content')
<style>
    .product-image-clickable,
    .product-thumb-clickable {
        transition: transform 0.2s ease, opacity 0.2s ease;
    }
    .product-image-clickable:hover,
    .product-thumb-clickable:hover {
        transform: scale(1.05);
        opacity: 0.9;
    }
    /* Modal backdrop / Overlay - potpuno tamna pozadina */
    .modal-backdrop {
        background-color: #000 !important;
        opacity: 0 !important;
        transition: opacity 0.3s ease-in-out !important;
        z-index: 1040 !important;
    }
    
    .modal-backdrop.show {
        opacity: 0.95 !important;
    }
    
    .modal-backdrop.fade {
        opacity: 0 !important;
    }
    
    .modal-backdrop.fade.show {
        opacity: 0.95 !important;
    }
    
    /* Modal overlay - dodatna tamna pozadina */
    #imageModal::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.95);
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }
    
    #imageModal.show::before {
        opacity: 1;
    }
    
    /* Modal content */
    #imageModal {
        z-index: 1055 !important;
    }
    
    #imageModal .modal-content {
        background: transparent;
        border: none;
        box-shadow: none;
    }
    
    #imageModal .modal-dialog {
        margin: 0;
        max-width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    #imageModal .modal-body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 2rem;
        cursor: pointer;
    }
    
    /* Prevent closing when clicking on image */
    #imageModal img {
        cursor: default;
        pointer-events: auto;
    }
    
    #imageModal img {
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.8);
        background: #fff;
        padding: 15px;
        border-radius: 12px;
        max-width: 90vw;
        max-height: 90vh;
        object-fit: contain;
    }
    
    /* Zatamni pozadinu kada je modal otvoren */
    body.modal-open {
        overflow: hidden;
        padding-right: 0 !important;
    }
    
    /* Close button styling */
    #imageModal .btn-close {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        padding: 0.5rem;
        opacity: 0.8;
        transition: all 0.2s ease;
        z-index: 1056;
        position: relative;
    }
    
    #imageModal .btn-close:hover {
        opacity: 1;
        background-color: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }
    
    /* Navigation buttons styling */
    #imageModal .modal-footer button {
        background-color: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        backdrop-filter: blur(10px);
        transition: all 0.2s ease;
    }
    
    #imageModal .modal-footer button:hover {
        background-color: rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
    }
    
    #imageModal .modal-footer span {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }
</style>
    @php
        $images = explode(',', $product->images);
    @endphp
    <div class="page-wrapper">
        <div class="page-content" <!--start product detail-->
            <section class="py-4">
                <div class="container">
                    <div class="product-detail-card">
                        <div class="product-detail-body">
                            <div class="row g-0">
                                <div class="col-12 col-lg-5">
                                    <div class="image-zoom-section">
                                        <div class="product-gallery owl-carousel owl-theme border mb-3 p-3"
                                            data-slider-id="1">
                                            @foreach ($images as $index => $image)
                                                @if ($image)
                                                    <div class="item">
                                                        <img src="/storage/Product_images/{{ $image }}"
                                                            class="product-image-clickable" 
                                                            alt="{{ $product->name }}"
                                                            style="cursor: pointer; width: 100%; height: auto;"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#imageModal"
                                                            data-image-src="/storage/Product_images/{{ $image }}"
                                                            data-image-index="{{ $index }}">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                            @foreach ($images as $index => $image)
                                                @if ($image)
                                                    <button class="owl-thumb-item" type="button">
                                                        <img src="/storage/Product_images/{{ $image }}"
                                                            class="product-thumb-clickable"
                                                            alt="Thumbnail"
                                                            style="cursor: pointer;"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#imageModal"
                                                            data-image-src="/storage/Product_images/{{ $image }}"
                                                            data-image-index="{{ $index }}">
                                                    </button>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="">
                                        <img width="16px" src="/assets/images/location.svg" alt="" srcset="">
                                        {{ $product->user->city }}<br />

                                        <img width="16px" src="/assets/images/avatar.svg" alt="" srcset="">
                                        {{ $product->user->firstName }}<br />
                                        {{-- {{$product->user->phone}} --}}
                                        @if (optional(Auth::user())->id)
                                            @if (Auth::user()->id == $product->user_id)
                                                <div class="">
                                                    <img src="" alt="">
                                                    <button style="transition: none; border: none;" disabled id="btn"
                                                        class="like-button mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold"
                                                        data-user-id="{{ $product->user_id }}"> <img
                                                            src="/assets/images/thumbs-up.svg" alt=""> <span
                                                            id="count"
                                                            class="like-count">{{ $product->user->likes() }}</span></button>
                                                    <button style="transition: none; border: none;" disabled id="btn"
                                                        class="dislike-button mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold"
                                                        data-user-id="{{ $product->user_id }}"><img
                                                            src="/assets/images/thumbs-down.svg" alt=""> <span
                                                            id="count"
                                                            class="like-count">{{ $product->user->dislikes() }}</span></button>
                                                </div>
                                            @else
                                                <div class="">
                                                    <button style="transition: none; border: none;" disabled
                                                        class="like-button mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold"
                                                        data-user-id="{{ $product->user_id }}"> <img
                                                            src="/assets/images/thumbs-up.svg" alt=""> <span
                                                            class="like-count">{{ $product->user->likes() }}</span></button>
                                                    <button style="transition: none; border: none;" disabled
                                                        class="dislike-button mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold"
                                                        data-user-id="{{ $product->user_id }}"><img
                                                            src="/assets/images/thumbs-down.svg" alt=""><span
                                                            class="like-count">{{ $product->user->dislikes() }}</span></button>
                                                </div>
                                                <br>
                                            @endif
                                        @endif
                                        {{-- @if (Auth::check())  
                                        @if (Auth::user()->id == $product->user_id)
                                        <button onclick="myFunction()" disabled class="btn btn-light btn-ecomm">Napiši komentar</button> 
                                        @else 
                                            <button onclick="myFunction()" class="btn btn-light btn-ecomm">Napiši komentar</button> 
                                                <div class="col-lg-12" id="myDIV" style="display: none;">
                                                    <div class="add-review bg-light-1">
                                                        <div class="form-body p-3">
                                                            <h4 class="mb-4">Napišite komentar</h4>
                                                            <form action="/comments.store" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label class="form-label">Vaše ime i prezime</label>
                                                                    <input disabled type="text" class="form-control rounded-0" name="user_id" value="{{Auth()->user()->firstName }}  {{ Auth()->user()->lastName}} ">
                                                                </div>
                                                                <div class="mb-3">                                                      
                                                                        <input type="hidden" name="product_user_id" value="{{ $product->user_id }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tekst komentara</label>
                                                                    <textarea class="form-control rounded-0" name="body" id="example" rows="5">{!! old('body') !!}</textarea>
                                                                </div>
                                                                <div class="d-grid">                                            
                                                                    <input type="submit" class="btn btn-dark btn-ecomm" value="Postavi">
                                                                </div>                                            
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif                                           
                                    @endif                                                                       --}}
                                    </div>
                                    {{-- <div class="image-zoom-section">
                                    <div class="product-gallery owl-carousel owl-theme border mb-3 p-3" data-slider-id="1">
                                        <div class="item">
                                            <img src="/storage/Product_images/{{ $product->image }}" class="img-fluid" alt="">
                                        </div>
                                            @foreach ($images as $image) 
                                                <div class="owl-thumb-item">
                                                    <img src="/storage/Product_images/{{ $image }}" class="" alt="">
                                                </div>
                                            @endforeach
                                        
                                    </div>
                                    <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                        <button class="owl-thumb-item">
                                            <img src="/storage/Product_images/{{ $product->image }}" class="img-fluid" alt="">
                                        </button>
                                        @foreach ($images as $image)
                                            <button class="owl-thumb-item">
                                                <img src="/storage/Product_images/{{ $image }}" class="" alt="">
                                            </button>
                                        @endforeach
                                    </div>                                  
                                </div> --}}
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="product-info-section p-3">
                                        <h6>ID oglasa: {{ $product->id }}</h6>
                                        <div class="product">
                                            <img width="16px" src="/assets/images/eye.svg" alt="" srcset="">
                                            {{-- Viđen: --}}
                                            <Span>{{ $product->views }}</Span>
                                        </div>
                                        <h3 class="mt-3 mt-lg-0 mb-0">{{ $product->name }}</h3>
                                        <h6 class="">({{ $product->condition }})</h6>

                                        <div class="mt-3">
                                            <h6>Opis :</h6>
                                            <p class="mb-0">{!! $product->description !!}</p>
                                        </div>

                                        <div class="">                                          
                                            <div class="col-lg-7">
                                                <div class="p-3 split-bg-warning shadow " style="border-radius: 10px">
                                                    <p class="font-18">Razmenom sa ovim predmetom uštedećeš:</p>
                                                    
                                                    <div class="address mb-2 d-flex justify-content-center row">
                                                        <div class="col ">
                                                            <h6 class="mb-2 col text-uppercase">E energije</h6>
                                                        </div>
                                                        <div class="col">
                                                            <h6 class="mb-2">{{$product->struja}} kw/h</h6>
                                                        </div>
                                                    </div>
                                                    <div class="phone mb-2 d-flex justify-content-center row">
                                                        <div class="col">
                                                            <h6 class="mb-2 col text-uppercase">Vode</h6>
                                                        </div>
                                                        <div class="col">
                                                            <h6 class="mb-2">{{$product->voda}} l</h6>
                                                        </div>
                                                    </div>
                                                    <div class="email mb-2 d-flex justify-content-center row">
                                                        <div class="col">
                                                            <h6 class="mb-2 col text-uppercase">CO2</h6>
                                                        </div>
                                                        <div class="col">
                                                            <h6 class="mb-2">{{$product->co2}} kg CO2</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            @if (optional(Auth::user())->id == $product->user_id)
                                                <!-- Hide the wishlist button for the product owner -->
                                                <div style="display: none;">
                                                    <div class="product-wishlist shadow">
                                                        <i class="hover bx bx-heart"></i>
                                                    </div>
                                                </div>
                                            @else
                                                @php
                                                    $isInWishlist = \App\Models\Wishlist::where('user_id', Auth::id())
                                                        ->where('product_id', $product->id)
                                                        ->exists();
                                                @endphp
                                                <div class="product-wishlist" data-product-id="{{ $product->id }}"
                                                    style="cursor: pointer;">
                                                    <i id="wishlist-icon-{{ $product->id }}"
                                                        class="bx {{ $isInWishlist ? 'bxs-heart' : 'bx-heart' }}"></i>
                                                </div>
                                            @endif
                                        </div>


                                        <div class="d-flex gap-2 mt-3">
                                            @if (Auth::check())
                                                <div class="product-action mt-2">
                                                    <div class="d-flex gap-2">
                                                        <div class="nav-item dropdown">
                                                            @if (Auth::user()->id == $product->user_id)
                                                                <a href="" style="display: none"
                                                                    class="nav-link dropdown-toggle dropdown-toggle-nocaret btn split-bg-warning"
                                                                    data-bs-toggle="dropdown"><i
                                                                        class="bx bxs-cart-add"></i>Pošalji zahtev za
                                                                    zamenu</a>
                                                            @else
                                                                <a href=""
                                                                    class="nav-link dropdown-toggle dropdown-toggle-nocaret btn split-bg-warning shadow"
                                                                    data-bs-toggle="dropdown"><i
                                                                        class="bx bx-refresh"></i>Zameni</a>
                                                            @endif
                                                            <ul class="dropdown-menu">
                                                                <form id="offer" action="/" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    @csrf
                                                                    <input type="hidden" name="user_id"
                                                                        value="{{ Auth()->user()->id }}">
                                                                    @php
                                                                        $currentProductOwnerId = $product->user_id;
                                                                        $currentProductId = $product->id;
                                                                    @endphp
                                                                    <input type="hidden" name="acceptor"
                                                                        value="{{ $product->user_id }}">
                                                                    <input type="hidden" name="acceptorName"
                                                                        value="{{ $product->user->firstName }}">
                                                                    <input type="hidden" name="acceptorNumber"
                                                                        value="{{ $product->user->phone }}">
                                                                    <input type="hidden" name="product_id"
                                                                        value="{{ $product->id }}">
                                                                    @forelse ($listproducts as $product)
                                                                        @php
                                                                            $images = $product->images
                                                                                ? explode(',', $product->images)
                                                                                : [];
                                                                        @endphp
                                                                        <div class="m-2">
                                                                            <div class="form-check form-check-inline">
                                                                                @php
                                                                                    // Check if this specific product is already involved in an offer with the current product owner for the specific product being viewed
                                                                                    $isInvolvedInSwap = false;
                                                                                    if (Auth::check() && $currentProductOwnerId) {
                                                                                        // $currentProductId is already set from the outer loop
                                                                                        
                                                                                        // Check if there's already an offer between current user and product owner involving this specific product AND the current product being viewed
                                                                                        $isInvolvedInSwap = DB::table('offers')
                                                                                            ->where(function ($query) use ($product, $currentProductOwnerId, $currentProductId) {
                                                                                                // Current user is sender, product owner is acceptor
                                                                                                $query->where('user_id', Auth::id())
                                                                                                      ->where('acceptor', $currentProductOwnerId)
                                                                                                      ->where(function ($subQuery) use ($product) {
                                                                                                        $subQuery->where('product_id', $product->id)
                                                                                                                ->orWhere('sendproduct_id', $product->id);
                                                                                                      })
                                                                                                      ->where(function ($subQuery) use ($currentProductId) {
                                                                                                        $subQuery->where('product_id', $currentProductId)
                                                                                                                ->orWhere('sendproduct_id', $currentProductId);
                                                                                                      });
                                                                                            })
                                                                                            ->orWhere(function ($query) use ($product, $currentProductOwnerId, $currentProductId) {
                                                                                                // Product owner is sender, current user is acceptor
                                                                                                $query->where('user_id', $currentProductOwnerId)
                                                                                                      ->where('acceptor', Auth::id())
                                                                                                      ->where(function ($subQuery) use ($product) {
                                                                                                        $subQuery->where('product_id', $product->id)
                                                                                                                ->orWhere('sendproduct_id', $product->id);
                                                                                                      })
                                                                                                      ->where(function ($subQuery) use ($currentProductId) {
                                                                                                        $subQuery->where('product_id', $currentProductId)
                                                                                                                ->orWhere('sendproduct_id', $currentProductId);
                                                                                                      });
                                                                                            })
                                                                                            ->where('accepted', 0)
                                                                                            ->exists();
                                                                                    }
                                                                                @endphp
                                                                                <input class="form-check-input d-flex"
                                                                                    type="radio" name="sendproduct_id"
                                                                                    id="inlineRadio{{ $product->id }}"
                                                                                    value="{{ $product->id }}"
                                                                                    {{ $isInvolvedInSwap ? 'disabled' : '' }} title="{{ $isInvolvedInSwap ? 'Already in swap with this user' : 'Available for swap' }}">
                                                                                <label class="form-check-label d-flex"
                                                                                    for="inlineRadio{{ $product->id }}">
                                                                                    <img src="/storage/Product_images/{{ $images[0] }}"
                                                                                        style="width: 30px; height: 30px;"
                                                                                        alt="" class="me-2">
                                                                                    {{ $product->name }}

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @empty
                                                                        <div class="col-xl-12 m-2">
                                                                            <p>Nemate oglase za zamenu.</p>
                                                                        </div>
                                                                    @endforelse

                                                                    <button class="btn btn-outline-dark btn-ecomm m-4"
                                                                        href="" type="submit"><i
                                                                            class="bx bx-send"></i> Pošalji</button>

                                                                </form>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                            @else
                                                <p>Ukoliko želite da zamenite proizvod morate imati nalog!</p>
                                                {{-- <a class="btn btn-dark btn-ecomm px-4" href="/login">Prijavi se!</a> <a class="btn btn-dark btn-ecomm px-4" href="/register">Registruj se!</a> --}}
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </section>
            <!--end product detail-->
            <!--start product more info-->
            <section class="py-4">
                <div class="container">
                    <div class="product-more-info">
                        <ul class="nav nav-tabs mb-0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#reviews" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title text-uppercase fw-500">Komentari</div>
                                    </div>
                                </a>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#description" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title text-uppercase fw-500">Description</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#more-info" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title text-uppercase fw-500">More Info</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tags" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title text-uppercase fw-500">Tags</div>
                                </div>
                            </a>
                        </li> --}}
                        </ul>
                        <div class="tab-content pt-3">
                            <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                                <div class="row">
                                    <div class="col col-lg-8">
                                        <div class="product-review">
                                            <h5 class="mb-4">Komentari</h5>
                                            <hr>
                                            <div class="review-list">
                                                @foreach ($comments as $kay => $comment)
                                                    <div class="d-flex align-items-start">
                                                        <div class="review-user">
                                                            {{-- <img src="assets/images/avatars/avatar-1.png" width="65" height="65" class="rounded-circle" alt="" /> --}}
                                                        </div>
                                                        <div class="review-content ms-3">

                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="mb-0">{{ $comment->user->firstName }}</h6>
                                                            </div>
                                                            <p class="mb-0 ms-auto">
                                                                {{ $comment->created_at->toFormattedDateString() }}</p>
                                                            <div>

                                                                <p>{!! $comment->body !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                            <div class="tab-pane fade " id="" role="tabpanel">
                                <p class="mb-0">{!! $product->description !!}</p>

                                {{-- <p class="mb-1">Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone.</p>
                            <p class="mb-1">Seitan aliquip quis cardigan american apparel, butcher voluptate nisi.</p> --}}
                            </div>
                            <div class="tab-pane fade" id="more-info" role="tabpanel">
                                <p></p>
                            </div>
                            <div class="tab-pane fade" id="tags" role="tabpanel">
                                <div class="tags-box w-50"> <a href="javascript:;" class="tag-link">Cloths</a>
                                    {{-- <a href="javascript:;" class="tag-link">Electronis</a>
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
                                <a href="javascript:;" class="tag-link">Shoes</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end product more info-->
        </div>
    </div>
    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0" id="modalContent">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 text-center" id="modalBody">
                    <img id="modalImage" src="" alt="{{ $product->name }}" class="img-fluid" style="max-height: 80vh; width: auto; border-radius: 8px;">
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-light" id="prevImageBtn" style="display: none;">
                            <i class="bx bx-chevron-left"></i> Prethodna
                        </button>
                        <span class="text-white align-self-center" id="imageCounter"></span>
                        <button type="button" class="btn btn-sm btn-light" id="nextImageBtn" style="display: none;">
                            Sledeća <i class="bx bx-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        // Image Modal functionality
        document.addEventListener('DOMContentLoaded', function() {
            const imageModal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const imageCounter = document.getElementById('imageCounter');
            const prevBtn = document.getElementById('prevImageBtn');
            const nextBtn = document.getElementById('nextImageBtn');
            
            // Get all images
            const allImages = [];
            document.querySelectorAll('.product-image-clickable, .product-thumb-clickable').forEach(function(img) {
                allImages.push({
                    src: img.getAttribute('data-image-src'),
                    index: parseInt(img.getAttribute('data-image-index'))
                });
            });
            
            let currentImageIndex = 0;
            
            // Ensure backdrop/overlay is dark when modal opens
            imageModal.addEventListener('show.bs.modal', function(event) {
                // Force dark backdrop/overlay
                setTimeout(function() {
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.style.opacity = '0.95';
                        backdrop.style.backgroundColor = '#000';
                        backdrop.classList.add('show');
                    }
                }, 10);
                
                const trigger = event.relatedTarget || event.target.closest('[data-bs-toggle="modal"]');
                if (trigger) {
                    const imageSrc = trigger.getAttribute('data-image-src');
                    const imageIndex = parseInt(trigger.getAttribute('data-image-index'));
                    
                    modalImage.src = imageSrc;
                    currentImageIndex = imageIndex;
                    updateImageCounter();
                    updateNavigationButtons();
                }
            });
            
            // Ensure backdrop/overlay stays dark when modal is shown
            imageModal.addEventListener('shown.bs.modal', function() {
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.style.opacity = '0.95';
                    backdrop.style.backgroundColor = '#000';
                    backdrop.classList.add('show');
                }
                
                // Prevent body scroll
                document.body.style.overflow = 'hidden';
                document.body.style.paddingRight = '0';
            });
            
            // Cleanup when modal is hidden
            imageModal.addEventListener('hidden.bs.modal', function() {
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
            
            // Close modal when clicking on backdrop or outside the image
            const modalContent = document.getElementById('modalContent');
            const modalBody = document.getElementById('modalBody');
            
            // Click on backdrop to close
            imageModal.addEventListener('click', function(event) {
                // If click is on the modal itself (backdrop), close it
                if (event.target === imageModal) {
                    const modalInstance = bootstrap.Modal.getInstance(imageModal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                }
            });
            
            // Click on modal body (but not on image) to close
            modalBody.addEventListener('click', function(event) {
                // If click is on modal body but not on the image, close modal
                if (event.target === modalBody || event.target.classList.contains('modal-body')) {
                    const modalInstance = bootstrap.Modal.getInstance(imageModal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                }
            });
            
            // Prevent closing when clicking on the image itself
            modalImage.addEventListener('click', function(event) {
                event.stopPropagation();
            });
            
            // Prevent closing when clicking on navigation buttons or counter
            prevBtn.addEventListener('click', function(event) {
                event.stopPropagation();
            });
            nextBtn.addEventListener('click', function(event) {
                event.stopPropagation();
            });
            imageCounter.addEventListener('click', function(event) {
                event.stopPropagation();
            });
            
            // Update image counter
            function updateImageCounter() {
                if (allImages.length > 1) {
                    imageCounter.textContent = `${currentImageIndex + 1} / ${allImages.length}`;
                } else {
                    imageCounter.textContent = '';
                }
            }
            
            // Update navigation buttons
            function updateNavigationButtons() {
                if (allImages.length > 1) {
                    prevBtn.style.display = currentImageIndex > 0 ? 'inline-block' : 'none';
                    nextBtn.style.display = currentImageIndex < allImages.length - 1 ? 'inline-block' : 'none';
                } else {
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'none';
                }
            }
            
            // Previous image
            prevBtn.addEventListener('click', function() {
                if (currentImageIndex > 0) {
                    currentImageIndex--;
                    modalImage.src = allImages[currentImageIndex].src;
                    updateImageCounter();
                    updateNavigationButtons();
                }
            });
            
            // Next image
            nextBtn.addEventListener('click', function() {
                if (currentImageIndex < allImages.length - 1) {
                    currentImageIndex++;
                    modalImage.src = allImages[currentImageIndex].src;
                    updateImageCounter();
                    updateNavigationButtons();
                }
            });
            
            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (imageModal.classList.contains('show')) {
                    if (e.key === 'ArrowLeft' && currentImageIndex > 0) {
                        prevBtn.click();
                    } else if (e.key === 'ArrowRight' && currentImageIndex < allImages.length - 1) {
                        nextBtn.click();
                    } else if (e.key === 'Escape') {
                        const modalInstance = bootstrap.Modal.getInstance(imageModal);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }
                }
            });
        });
    </script>

    {{--  
<script>
    $(document).ready(function() {
        $('.like-button').click(function(e) {
            e.preventDefault();

            var userId = $(this).data('user-id');

            $.ajax({
                url: '{{ route("like") }}',
                type: 'POST',
                data: {
                    user_id: userId,
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                },
                error: function(xhr) {
                    // Handle error response
                    console.log(xhr.responseText);
                }
            });
        });

        $('.dislike-button').click(function(e) {
            e.preventDefault();

            var userId = $(this).data('user-id');

            $.ajax({
                url: '{{ route("dislike") }}',
                type: 'POST',
                data: {
                    user_id: userId,
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                },
                error: function(xhr) {
                    // Handle error response
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script> --}}

@endsection

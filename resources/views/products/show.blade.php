@extends('layouts.master')

@section('title', 'Detalji')

@section('content')
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
                                            @foreach ($images as $image)
                                                @if ($image)
                                                    <div class="item">
                                                        <img src="/storage/Product_images/{{ $image }}"
                                                            class="" alt="">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                            @foreach ($images as $image)
                                                @if ($image)
                                                    <button class="owl-thumb-item">
                                                        <img src="/storage/Product_images/{{ $image }}"
                                                            class="" alt="">
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
                                                                                <input class="form-check-input d-flex"
                                                                                    type="radio" name="sendproduct_id"
                                                                                    id="inlineRadio{{ $product->id }}"
                                                                                    value="{{ $product->id }}"
                                                                                    {{ $product->isDisabledForCurrentExchange ? 'disabled' : '' }}>
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
    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
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

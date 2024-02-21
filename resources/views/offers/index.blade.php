@extends('layouts.master')

@section('title', 'Ponude')

@section('content')

    <div class="container">
        <h3 class="d-none">Account</h3>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-none mb-3 mb-lg-0 border">
                            <div class="card-body">
                                <div class="list-group list-group-flush">	<a href="/dashboard" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Dashboard <i class='bx bx-tachometer fs-5'></i></a>
                                    <a href="/offers" class="list-group-item active d-flex justify-content-between align-items-center">Ponude <i class='bx bx-cart-alt fs-5'></i></a>
                                    <a href="/wishlist" class="list-group-item d-flex justify-content-between align-items-center">Oglasi koje pratim <i class='bx bx-download fs-5'></i></a>
                                    <a href="account-addresses.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Addresses <i class='bx bx-home-smile fs-5'></i></a>
                                    <a href="account-payment-methods.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Payment Methods <i class='bx bx-credit-card fs-5'></i></a>
                                    <a href="account-user-details.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Account Details <i class='bx bx-user-circle fs-5'></i></a>
                                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Logout <i class='bx bx-log-out fs-5'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card shadow-none mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="container">
                                        <div class="product-more-info">
                                            <ul class="nav nav-tabs mb-0" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#ponude" role="tab" aria-selected="true">
                                                        <div class="d-flex align-items-center">
                                                            <div class="tab-title text-uppercase fw-500">Ponude</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#zahtevi" role="tab" aria-selected="false">
                                                        <div class="d-flex align-items-center">
                                                            <div class="tab-title text-uppercase fw-500">Moji zahtevi</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                            <div class="tab-content pt-3">
                                                <div class="tab-pane fade show active" id="ponude" role="tabpanel">
                                                    
                                                    @foreach ($offers as $offer)
                                                        @php
                                                        // $sendPproductImages = $offer->sendproduct->images ? explode(",", $offer->sendproduct->images) : [];
                                                        if ($offer->sendproduct !== null && null !== $offer->sendproduct->images) {
                                                                $sendPproductImages = explode(",", $offer->sendproduct->images);
                                                            }
                                                        @endphp 
                                                        
                                                        @php
                                                            // $images = $offer->product->images ? explode(",", $offer->product->images) : [];
                                                            if ($offer->product !== null && null !== $offer->product->images) {
                                                                    $images = explode(",", $offer->product->images);
                                                                }
                                                        @endphp 
                                                        <div class="product-grid border-1">
                                                              
                                                            <div class="row row-cols-2 position-relative">
                                                                <div class="col">
                                                                    <div class="d-grid gap-2">
                                                                        {{$offer->user->firstName}}
                                                                    </div>
                                                                    <div class="card rounded-0 product-card">
                                                                        <div class="card-header bg-transparent border-bottom-0">
                                                                            <div class="d-flex align-items-center justify-content-end gap-3">                                                                   
                                                                                <a href="javascript:;">
                                                                                    {{-- <div class="product-wishlist"> <i class="bx bx-heart"></i>
                                                                                    </div> --}}
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        @if ($offer->sendproduct)
                                                                            <a href="{{route('products.show', $offer->sendproduct->id)}}"><img src="/storage/Product_images/{{ $sendPproductImages[0] }}" class="rounded = 9 card-img-top" style="width: 150px; height: 100px"  alt=""></a> <!-- dobijeni artikal za zamenu -->
                                                                        @else
                                                                            <img src="/storage/Product_images/noimage.jpg" class="rounded = 9 card-img-top" style="width: 150px; height: 100px"  alt="">
                                                                        @endif
                                                                        <div class="card-body">
                                                                            <div class="product-info">
                                                                                <a href="javascript:;">
                                                                                    {{-- <p class="product-catergory font-13 mb-1">Catergory Name</p> --}}
                                                                                </a>
                                                                                @if($offer->sendproduct)
                                                                                    <a href="javascript:;">
                                                                                        <h6 class="product-name mb-2">{{$offer->sendproduct->name}}</h6>
                                                                                    </a>
                                                                                @else
                                                                                    <p>Oglas više ne postoji!</p>
                                                                                @endif
                                                                                
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="mb-1 product-price">	
                                                                                        {{-- <span class="me-1 text-decoration-line-through">$99.00</span>
                                                                                        <span class="fs-5">$49.00</span> --}}
                                                                                        @if($offer->accepted == 1 || $offer->accepted == 3)
                                                                                            Broj Telefona: {{$offer->sendproduct->user->phone ?? 'no client'}}
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="cursor-pointer ms-auto">
                                                                                        {{-- @if($offer->accepted == 1 || $offer->accepted == 3)
                                                                                            {{$offer->user->phone ?? 'no client'}}
                                                                                        @endif --}}
                                                                                        {{-- <i class="bx bxs-star text-warning"></i>
                                                                                        <i class="bx bxs-star text-warning"></i>
                                                                                        <i class="bx bxs-star text-warning"></i>
                                                                                        <i class="bx bxs-star text-warning"></i>
                                                                                        <i class="bx bxs-star text-warning"></i> --}}
                                                                                    </div>
                                                                                </div>
                                                                               
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <img src="/assets/images/arrow-right2.png" class="arrow-image-swap">
                                                                <div class="col">
                                                                    <div class="d-grid gap-2">
                                                                        Moj proizvod
                                                                    </div>
                                                                    <div class="card rounded-0 product-card">
                                                                        <div class="card-header bg-transparent border-bottom-0">
                                                                            <div class="d-flex align-items-center justify-content-end gap-3">
                                                                                <a href="javascript:;">
                                                                                    {{-- <div class="product-wishlist"> <i class="bx bx-heart"></i>
                                                                                    </div> --}}
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        @if ($offer->product)
                                                                            <a href="{{route('products.show', $offer->product->id)}}"><img src="/storage/Product_images/{{ $images[0] }}" class="rounded = 9 card-img-top" style="width: 150px; height: 100px"  alt=""></a>  <!-- artikal za zamenu -->
                                                                        @else
                                                                            <img src="/storage/Product_images/noimage.jpg" class="rounded = 9 card-img-top" style="width: 150px; height: 100px"  alt="">
                                                                        @endif
                                                                        <div class="card-body">
                                                                            <div class="product-info">
                                                                                <a href="javascript:;">
                                                                                    {{-- <p class="product-catergory font-13 mb-1">{{$offer->product->category}}</p> --}}
                                                                                </a>
                                                                                @if ($offer->product)
                                                                                    <a href="javascript:;">
                                                                                        <h6 class="product-name mb-2">{{$offer->product->name}}</h6>
                                                                                    </a>                                                                                    
                                                                                @else
                                                                                    <p>Oglas više ne postoji!</p>
                                                                                @endif
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="mb-1 product-price"> 
                                                                                        {{-- <span class="me-1 text-decoration-line-through">$99.00</span> --}}
                                                                                        {{-- <span class="fs-5">$49.00</span> --}}
                                                                                        @if($offer->accepted == 1 || $offer->accepted == 3)
                                                                                        Broj Telefona: {{$offer->product->user->phone ?? 'no client'}}
                                                                                    @endif
                                                                                    </div>
                                                                                    <div class="cursor-pointer ms-auto"> 
                                                                                        {{-- @if($offer->accepted == 1 || $offer->accepted == 3)
                                                                                            Br.Tel.{{auth()->user()->phone ?? 'no client'}}
                                                                                        @endif --}}
                                                                                        {{-- <i class="bx bxs-star text-warning"></i>
                                                                                        <i class="bx bxs-star text-warning"></i>
                                                                                        <i class="bx bxs-star text-light-4"></i>
                                                                                        <i class="bx bxs-star text-light-4"></i> --}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="product-action mt-2">
                                                                                    <div class="d-grid gap-2">
                                                                                        {{-- <a href="javascript:;" class="btn btn-dark btn-ecomm">	<i class="bx bxs-cart-add"></i>Add to Cart</a>
                                                                                        <a href="javascript:;" class="btn btn-light btn-ecomm" data-bs-toggle="modal" data-bs-target="#QuickViewProduct"><i class="bx bx-zoom-in"></i>Quick View</a> --}}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end row-->
                                                            <div class="product-action mt-2">
                                                                <div class="d-grid gap-2">
                                                                    @if($offer->accepted == 0)
                                                                        @if ($offer->product)
                                                                                <div class="row">
                                                                                    <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.update', $offer->id)}}" method="POST">
                                                                                        {{ csrf_field() }}
                                                                                        {{method_field('post')}}
                                                                                        <input type="hidden" name="accepted" value="1">
                                                                                        <button class="btn btn-success btn-sm rounded-0 m-0 btn-ecomm" type="submit"><img src="/assets/images/correct.png" alt=""></button>
                                                                                        {{-- <a class="btn btn-success btn-sm rounded-0 m-0 btn-ecomm" type="submit"><img src="/assets/images/correct.png" alt=""></a> --}}
                                                                                        
                                                                                    </form>                                                                       
                                                                                    <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.rejected', $offer->id)}}" method="POST">
                                                                                        {{ csrf_field() }}
                                                                                        {{method_field('post')}}
                                                                                        <input type="hidden" name="accepted" value="2">
                                                                                        {{-- <a class="btn btn-danger btn-sm rounded-0 m-0 btn-ecomm" type="submit"><img src="/assets/images/incorrect.png" alt=""></a> --}}
                                                                                        <button class="btn btn-danger btn-sm rounded-0 m-0 btn-ecomm" type="submit"><img src="/assets/images/incorrect.png" alt=""></button>
                                                                                    </form>
                                                                                </div>
                                                                                    {{-- <a href="javascript:;" class="btn btn-dark btn-sm rounded-0">Odustani</a> --}}
                                                                             
                                                                                {{-- <a href="javascript:;" class="btn btn-light btn-ecomm" data-bs-toggle="modal" data-bs-target="#QuickViewProduct"><i class="bx bx-zoom-in"></i>Quick View</a> --}}
                                                                        @endif
                                                                        
                                                                    @endif
        
                                                                    @if($offer->accepted == 1)
                                                                        Da li je uspešna zamena?
                                                                        <div class="row">
                                                                            <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.confirmation', $offer->id)}}" method="POST">
                                                                                {{ csrf_field() }}
                                                                                {{method_field('post')}}
                                                                                <input type="hidden" name="accepted" value="3">
                                                                                <button class="btn btn-success btn-sm m-0 btn-ecomm" type="submit">DA</button>
                                                                                {{-- <a class="btn btn-success btn-sm rounded-0 m-0 btn-ecomm" type="submit"><img src="/assets/images/correct.png" alt=""></a> --}}
                                                                            </form>
                                                                            <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.canceled', $offer->id)}}" method="post">
                                                                                {{ csrf_field() }}
                                                                                {{method_field('post')}}
                                                                                <input type="hidden" name="accepted" value="4">
                                                                                <button class="btn btn-danger btn-sm m-0 btn-ecomm" type="submit">NE</button>
                                                                                {{-- <a class="btn btn-danger btn-sm rounded-0 m-0 btn-ecomm" type="submit"><img src="/assets/images/incorrect.png" alt=""></a> --}}
                                                                            </form>
                                                                        </div>                                                                
                                                                    @endif
        
                                                                    @if ($offer->accepted == 2)
                                                                        <div class="btn btn-danger">
                                                                            <p>Zahtev odbijen!</p>
                                                                        </div>
                                                                        
                                                                        <form class="d-grid gap-2  p-0 m-0" action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                            {{ csrf_field() }}
                                                                            {{method_field('delete')}}  
                                                                            <button style="border:none; transparent:none;"  type="submit">
                                                                                <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                            </button>  
                                                                        </form>                      
                                                                    @endif
        
                                                                    @if($offer->accepted == 3)
                                                                        @if($offer->product)
                                                                            <div class="row">
                                                                                <button type="button" class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#exampleModal{{$offer->id}}" data-bs-whatever="@mdo"><i class="bx bx-star"></i></button>
                                                                                <form class="d-grid gap-2 col-6 p-0 m-0" action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                                    {{ csrf_field() }}
                                                                                    {{method_field('delete')}}  
                                                                                    <button style="border:none; transparent:none;"  type="submit">
                                                                                        <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                    </button>                                                                                                                                               
                                                                                </form>   
                                                                            </div>
                                                                        @endif
                                                                    @endif
        
                                                                    @if ($offer->accepted == 4)
                                                                        <div class="btn btn-danger">
                                                                            <p>Neuspešna zamena!</p>                                                                    
                                                                        </div>
                                                                        <div class="row">
                                                                            <button type="button" class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#exampleModal{{$offer->id}}" data-bs-whatever="@mdo">Oceni korisnika</button>
                                                                            <form class="d-grid gap-2 col-6 p-0 m-0" action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                                {{ csrf_field() }}
                                                                                {{method_field('delete')}}  
                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                </button>                                                                                                                                                 
                                                                            </form>
                                                                        </div>
                                                                    @endif
        
                                                                    @if (!$offer->product)                                                                
                                                                            <form class="d-grid gap-2  p-0 m-0" action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                                {{ csrf_field() }}
                                                                                {{method_field('delete')}}  
                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                </button>                                                                                                                                                 
                                                                            </form>
                                                                        </td>
                                                                    @endif
        
                                                                </div>
                                                            </div>
                                                        </div>  
                                                        <hr> 
                                                        <di type="button"v class="modal fade" id="exampleModal{{$offer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Napišite komentar</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{route('comments.store', $offer->id)}}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="mb-3">
                                                                                    <label for="recipient-name" class="col-form-label">Vaše ime i prezime</label>
                                                                                    <input disabled type="text" class="form-control rounded-0" name="user_id" value="{{Auth()->user()->firstName }}  {{ Auth()->user()->lastName}} ">
                                                                                </div>
                                                                                <div class="mb-3">   
                                                                                    
                                                                                        <input type="hidden" name="product_user_id" value="{{ $offer->sendproduct->user_id }}">                        
                                                                                                                                    
                                                                                </div>
                                                                            
                                                                            
                                                                                <div class="mb-3">
                                                                                    <label for="message-text" class="col-form-label">Tekst komentara</label>
                                                                                    <textarea class="form-control rounded-0" name="body" id="example" rows="5">{!! old('body') !!}</textarea>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    @if (optional(Auth::user())->id)
                                                                                        @if (Auth::user()->id == $offer->sendproduct->user_id)
                                                                                            <div class="like">
                                                                                                <button type="button" disabled id="btn" class="like-button mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold" data-user-id="{{ $offer->sendproduct->user_id }}">Like <span id="count" class="like-count">{{ $offer->sendproduct->user->likes() }}</span></button>
                                                                                                <button type="button" disabled id="btn" class="dislike-button mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold" data-user-id="{{ $offer->sendproduct->user_id }}">Dislike <span id="count" class="dislike-count">{{ $offer->sendproduct->user->dislikes() }}</span></button>  
                                                                                            </div>  
                                                                                        @else
                                                                                            <div class="like">
                                                                                                <button type="button" class="like-button mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold" data-user-id="{{ $offer->sendproduct->user_id }}">Like <span class="like-count">{{ $offer->sendproduct->user->likes() }}</span></button>
                                                                                                <button type="button" class="dislike-button mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold" data-user-id="{{ $offer->sendproduct->user_id }}">Dislike <span class="dislike-count">{{ $offer->sendproduct->user->dislikes() }}</span></button>  
                                                                                            </div>   
                                                                                            <br>                                   
                                                                                            
                                                                                        @endif                                            
                                                                                    @endif
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Postavi</button>
                                                                                </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </di>                                 
                                                    @endforeach
                                                </div>
                                                
                                                <div class="tab-pane fade" id="zahtevi" role="tabpanel">
                                                    @foreach ($sendoffers as $sendoffer)
                                                        @php
                                                            // $sendOfferImages = $sendoffer->sendproduct->images ? explode(",", $sendoffer->sendproduct->images) : [];
                                                            if ($sendoffer->sendproduct !== null && null !== $sendoffer->sendproduct->images) {
                                                                    $sendofferImages = explode(",", $sendoffer->sendproduct->images);
                                                                }
                                                        @endphp 
                                                
                                                        @php
                                                            // $images = $sendoffer->product->images ? explode(",", $sendoffer->product->images) : [];
                                                            if ($sendoffer->product !== null && null !== $sendoffer->product->images) {
                                                                    $images = explode(",", $sendoffer->product->images);
                                                                }
                                                        @endphp   
                                                        <div class="row row-cols-2 position-relative">
                                                            <div class="col">
                                                                <div class="d-grid gap-2">
                                                                    Moj proizvod
                                                                    {{-- {{$sendoffer->user->firstName}} --}}
                                                                </div>
                                                                <div class="card rounded-0 product-card">
                                                                    <div class="card-header bg-transparent border-bottom-0">
                                                                        <div class="d-flex align-items-center justify-content-end gap-3">                                                                   
                                                                            <a href="javascript:;">
                                                                                {{-- <div class="product-wishlist"> <i class="bx bx-heart"></i>
                                                                                </div> --}}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    @if ($sendoffer->sendproduct)
                                                                        <a href="{{route('products.show', $sendoffer->sendproduct->id)}}"><img src="/storage/Product_images/{{ $sendofferImages[0] }}" class="rounded = 9 card-img-top " style="width: 150px; height: 100px;"  alt=""></a> <!-- dobijeni artikal za zamenu -->
                                                                    @else
                                                                    <img src="/storage/Product_images/noimage.jpg" class="rounded = 9 card-img-top" style="width: 150px; height: 100px"  alt="">
                                                                    @endif
                                                                    <div class="card-body">
                                                                        <div class="product-info">
                                                                            <a href="javascript:;">
                                                                                {{-- <p class="product-catergory font-13 mb-1">Catergory Name</p> --}}
                                                                            </a>
                                                                            @if ($sendoffer->sendproduct)
                                                                                <a href="javascript:;">
                                                                                    <h6 class="product-name mb-2">{{$sendoffer->sendproduct->name}}</h6>
                                                                                </a>
                                                                            @else
                                                                                <p>Oglas više ne postoji!</p>
                                                                            @endif
                                                                            
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="mb-1 product-price">	
                                                                                    {{-- <span class="me-1 text-decoration-line-through">$99.00</span>
                                                                                    <span class="fs-5">$49.00</span> --}}
                                                                                    @if($sendoffer->accepted == 1 || $sendoffer->accepted == 3)
                                                                                        Broj Telefona: {{$sendoffer->sendproduct->user->phone ?? 'no client'}}
                                                                                    @endif
                                                                                </div>
                                                                                <div class="cursor-pointer ms-auto">
                                                                                    {{-- @if($offer->accepted == 1 || $offer->accepted == 3)
                                                                                        {{$offer->user->phone ?? 'no client'}}
                                                                                    @endif --}}
                                                                                    {{-- <i class="bx bxs-star text-warning"></i>
                                                                                    <i class="bx bxs-star text-warning"></i>
                                                                                    <i class="bx bxs-star text-warning"></i>
                                                                                    <i class="bx bxs-star text-warning"></i>
                                                                                    <i class="bx bxs-star text-warning"></i> --}}
                                                                                </div>
                                                                            </div>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <img src="/assets/images/arrow-right2.png" class="arrow-image-swap">
                                                            <div class="col">
                                                                <div class="d-grid gap-2">
                                                                    
                                                                    {{$sendoffer->acceptorName}}
                                                                </div>
                                                                <div class="card rounded-0 product-card">
                                                                    <div class="card-header bg-transparent border-bottom-0">
                                                                        <div class="d-flex align-items-center justify-content-end gap-3">
                                                                            <a href="javascript:;">
                                                                                {{-- <div class="product-wishlist"> <i class="bx bx-heart"></i>
                                                                                </div> --}}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    @if ($sendoffer->product)
                                                                        <a href="{{route('products.show', $sendoffer->product->id)}}"><img src="/storage/Product_images/{{ $images[0] }}" class="rounded = 9 card-img-top" style="width: 150px; height: 100px"  alt=""></a>  <!-- artikal za zamenu -->
                                                                    @else
                                                                        {{-- <p>Oglas više ne postoji!</p> --}}
                                                                        <img src="/storage/Product_images/noimage.jpg" class="rounded = 9 card-img-top" style="width: 150px; height: 100px"  alt="">
                                                                    @endif
                                                                    <div class="card-body">
                                                                        <div class="product-info">
                                                                            <a href="javascript:;">
                                                                                {{-- <p class="product-catergory font-13 mb-1">{{$sendoffer->product->category}}</p> --}}
                                                                            </a>
                                                                            @if ($sendoffer->product)
                                                                                <a href="javascript:;">
                                                                                    <h6 class="product-name mb-2">{{$sendoffer->product->name}}</h6>
                                                                                </a>
                                                                            @else
                                                                                <p>Oglas više ne postoji!</p>
                                                                            @endif
                                                                            
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="mb-1 product-price"> 
                                                                                    {{-- <span class="me-1 text-decoration-line-through">$99.00</span> --}}
                                                                                    {{-- <span class="fs-5">$49.00</span> --}}
                                                                                    @if($sendoffer->accepted == 1 || $sendoffer->accepted == 3)
                                                                                    Broj Telefona: {{$sendoffer->product->user->phone ?? 'no client'}}
                                                                                @endif
                                                                                </div>
                                                                                <div class="cursor-pointer ms-auto"> 
                                                                                    {{-- @if($offer->accepted == 1 || $offer->accepted == 3)
                                                                                        Br.Tel.{{auth()->user()->phone ?? 'no client'}}
                                                                                    @endif --}}
                                                                                    {{-- <i class="bx bxs-star text-warning"></i>
                                                                                    <i class="bx bxs-star text-warning"></i>
                                                                                    <i class="bx bxs-star text-light-4"></i>
                                                                                    <i class="bx bxs-star text-light-4"></i> --}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="product-action mt-2">
                                                                                <div class="d-grid gap-2">
                                                                                    {{-- <a href="javascript:;" class="btn btn-dark btn-ecomm">	<i class="bx bxs-cart-add"></i>Add to Cart</a>
                                                                                    <a href="javascript:;" class="btn btn-light btn-ecomm" data-bs-toggle="modal" data-bs-target="#QuickViewProduct"><i class="bx bx-zoom-in"></i>Quick View</a> --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-action mt-2">
                                                            <div class="d-grid gap-2">
                                                                @if ($sendoffer->accepted == 0)
                                                                    <div class="btn btn-warning">
                                                                        <p>Zahtev  na cekanju</p>
                                                                    </div>
                                                                @endif
                                                                {{-- <a href="javascript:;" class="btn btn-dark btn-ecomm">	<i class="bx bxs-cart-add"></i>Add to Cart</a> --}}
                                                                {{-- <a href="javascript:;" class="btn btn-light btn-ecomm" data-bs-toggle="modal" data-bs-target="#QuickViewProduct"><i class="bx bx-zoom-in"></i>Quick View</a> --}}
                                                            </div>
                                                        </div>

                                                        @if($sendoffer->accepted == 1)
                                                            Da li je uspešna zamena?
                                                            <div class="row">
                                                                <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.confirmation', $sendoffer->id)}}" method="POST">
                                                                    {{ csrf_field() }}
                                                                    {{method_field('post')}}
                                                                    <input type="hidden" name="accepted" value="3">
                                                                    <button class="btn btn-success btn-sm m-0 btn-ecomm" type="submit">DA</button>
                                                                    {{-- <a class="btn btn-success btn-sm rounded-0 m-0 btn-ecomm" type="submit"><img src="/assets/images/correct.png" alt=""></a> --}}
                                                                </form>
                                                                <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.canceled', $sendoffer->id)}}" method="post">
                                                                    {{ csrf_field() }}
                                                                    {{method_field('post')}}
                                                                    <input type="hidden" name="accepted" value="4">
                                                                    <button class="btn btn-danger btn-sm m-0 btn-ecomm" type="submit">NE</button>
                                                                    {{-- <a class="btn btn-danger btn-sm rounded-0 m-0 btn-ecomm" type="submit"><img src="/assets/images/incorrect.png" alt=""></a> --}}
                                                                </form>
                                                            </div>                                                                
                                                        @endif

                                                        @if ($sendoffer->accepted == 2)
                                                            <div class="d-grid gap-2">
                                                                <div class="btn btn-danger">
                                                                    <p>Zahtev odbijen!</p>
                                                                </div>                                                                
                                                            </div>
                                                            <form class="d-grid gap-2  p-0 m-0" action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                {{ csrf_field() }}
                                                                {{method_field('delete')}}  
                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                </button>  
                                                            </form>                      
                                                        @endif

                                                        @if($sendoffer->accepted == 3)
                                                            @if($sendoffer->product)
                                                                <div class="row">
                                                                    <button type="button" class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#exampleModal1{{$sendoffer->id}}" data-bs-whatever="@mdo"><i class="bx bx-star"></i></button>
                                                                    <form class="d-grid gap-2 col-6 p-0 m-0" action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                        {{ csrf_field() }}
                                                                        {{method_field('delete')}}  
                                                                        <button style="border:none; transparent:none;"  type="submit">
                                                                            <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                        </button>                                                                                                                                               
                                                                    </form>   
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @if ($sendoffer->accepted == 4)
                                                            <div class="d-grid gap-2">
                                                                <div class="btn btn-danger">
                                                                    <p>Neuspešna zamena!</p>                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <button type="button" class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#exampleModal1{{$sendoffer->id}}" data-bs-whatever="@mdo">Oceni korisnika</button>
                                                                <form class="d-grid gap-2 col-6 p-0 m-0" action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                    {{ csrf_field() }}
                                                                    {{method_field('delete')}}  
                                                                    <button style="border:none; transparent:none;"  type="submit">
                                                                        <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                    </button>                                                                                                                                                 
                                                                </form>
                                                            </div>
                                                        @endif

                                                        @if (!$sendoffer->product)                                                                
                                                                <form class="d-grid gap-2  p-0 m-0" action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                    {{ csrf_field() }}
                                                                    {{method_field('delete')}}  
                                                                    <button style="border:none; transparent:none;"  type="submit">
                                                                        <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                    </button>                                                                                                                                                 
                                                                </form>
                                                            </td>
                                                        @endif
                                                        <div class="modal fade" id="exampleModal1{{$sendoffer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Napišite komentar</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{route('comments.store', $sendoffer->id)}}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="mb-3">
                                                                            <label for="recipient-name" class="col-form-label">Vaše ime i prezime</label>
                                                                            <input disabled type="text" class="form-control rounded-0" name="user_id" value="{{Auth()->user()->firstName }}  {{ Auth()->user()->lastName}} ">
                                                                            </div>
                                                                            <div class="mb-3">   
                                                                                
                                                                                    <input type="hidden" name="product_user_id" value="{{ $sendoffer->product->user_id }}">                        
                                                                                
                                                                            </div>
                                                                            <div class="mb-3">
                                                                            <label for="message-text" class="col-form-label">Tekst komentara</label>
                                                                            <textarea class="form-control rounded-0" name="body" id="example" rows="5">{!! old('body') !!}</textarea>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Postavi</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    @endforeach
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
  
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Napišite komentar</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('comments.store', $offer->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Vaše ime i prezime</label>
                  <input disabled type="text" class="form-control rounded-0" name="user_id" value="{{Auth()->user()->firstName }}  {{ Auth()->user()->lastName}} ">
                </div>
                <div class="mb-3">   
                    @if ($offer->sendproduct->user_id )
                        <input type="hidden" name="product_user_id" value="{{ $offer->sendproduct->user_id }}">                        
                    @endif                                                   
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Tekst komentara</label>
                  <textarea class="form-control rounded-0" name="body" id="example" rows="5">{!! old('body') !!}</textarea>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Postavi</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> --}}


    {{-- <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Napišite komentar</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('comments.store', $sendoffer->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Vaše ime i prezime</label>
                  <input disabled type="text" class="form-control rounded-0" name="user_id" value="{{Auth()->user()->firstName }}  {{ Auth()->user()->lastName}} ">
                </div>
                <div class="mb-3">   
                    @if ($sendoffer->product->user_id)
                        <input type="hidden" name="product_user_id" value="{{ $sendoffer->product->user_id }}">                        
                    @endif
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Tekst komentara</label>
                  <textarea class="form-control rounded-0" name="body" id="example" rows="5">{!! old('body') !!}</textarea>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Postavi</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
@endsection


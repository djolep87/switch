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
                                    <a href="/wishlist" class="list-group-item d-flex justify-content-between align-items-center">Oglasi koje pratim <i class='bx bx-star fs-5'></i></a>
                                    <a href="account-addresses.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Addresses <i class='bx bx-home-smile fs-5'></i></a>
                                    <a href="account-payment-methods.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Payment Methods <i class='bx bx-credit-card fs-5'></i></a>
                                    <a href="/auth.edit/{{auth()->user()->id}}" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Uredi Profil <i class='bx bx-user-circle fs-5'></i></a>
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
                                                        @if (!$offer->offer_archived == 1)
                                                            @php
                                                            
                                                            if ($offer->sendproduct !== null && null !== $offer->sendproduct->images) {
                                                                    $sendPproductImages = explode(",", $offer->sendproduct->images);
                                                                }
                                                            @endphp 
                                                            
                                                            @php
                                                                
                                                                if ($offer->product !== null && null !== $offer->product->images) {
                                                                        $images = explode(",", $offer->product->images);
                                                                    }
                                                            @endphp 
                                                            <div class="product-grid border-1">
                                                                
                                                                <div class="row row-cols-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 position-relative">
                                                                    <div class="col">
                                                                        <div class="card rounded-0 product-card">
                                                                            {{$offer->user->firstName}}
                                                                            <div class="card-header bg-transparent border-bottom-0">
                                                                                <div class="d-flex align-items-center justify-content-end gap-3">
                                                                                    <a href="javascript:;">
                                                                                        
                                                                                    </a>
                                                                                    <a href="javascript:;">
                                                                                        
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            @if ($offer->sendproduct)
                                                                                <a href="{{route('products.show', $offer->sendproduct->id)}}"><img src="/storage/Product_images/{{ $sendPproductImages[0] }}" class="card-img-top" alt=""></a> <!-- dobijeni artikal za zamenu -->
                                                                            @else
                                                                                <img src="/storage/Product_images/noimage.jpg" class="card-img-top"alt="">
                                                                            @endif
                                                                            {{-- <img src="assets/images/products/01.png" class="card-img-top" alt="..."> --}}
                                                                            <div class="card-body">
                                                                                <div class="product-info">
                                                                                    <a href="javascript:;">
                                                                                    
                                                                                    </a>
                                                                                    <a href="javascript:;">
                                                                                        @if($offer->sendproduct)
                                                                                            <a href="javascript:;">
                                                                                                <h6 class="product-name mb-2">{{$offer->sendproduct->name}}</h6>
                                                                                            </a>
                                                                                        @else
                                                                                            <p>Oglas više ne postoji!</p>
                                                                                        @endif
                                                                                    </a>                                                                                
                                                                                    @if($offer->accepted == 1 || $offer->accepted == 3)
                                                                                        <hr>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <div class="mb-1 product-price">
                                                                                                
                                                                                                    Broj Telefona: {{$offer->sendproduct->user->phone ?? 'no client'}} <br>
                                                                                                    Grad: {{$offer->sendproduct->user->city ?? 'no client'}}                                                                                            
                                                                                            </div>
                                                                                            <div class="cursor-pointer ms-auto">
                                                                                                    
                                                                                            </div>
                                                                                        </div>                                                   
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <img src="/assets/images/arrow.png" class="arrow-image-swap">
                                                                    <div class="col">
                                                                        <div class="card rounded-0 product-card">
                                                                            Moj proizvod
                                                                            <div class="card-header bg-transparent border-bottom-0">
                                                                                <div class="d-flex align-items-center justify-content-end gap-3">
                                                                                    <a href="javascript:;">
                                                                                        
                                                                                    </a>
                                                                                    <a href="javascript:;">
                                                                                        
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            @if ($offer->product)
                                                                                <a href="{{route('products.show', $offer->product->id)}}"><img src="/storage/Product_images/{{ $images[0] }}" class="card-img-top" alt=""></a>  <!-- artikal za zamenu -->
                                                                            @else
                                                                                <img src="/storage/Product_images/noimage.jpg" class="card-img-top" alt="">
                                                                            @endif
                                                                            <div class="card-body">
                                                                                <div class="product-info">
                                                                                    <a href="javascript:;">
                                                                                        
                                                                                    </a>
                                                                                    <a href="javascript:;">
                                                                                        @if ($offer->product)
                                                                                            <a href="javascript:;">
                                                                                                <h6 class="product-name mb-2">{{$offer->product->name}}</h6>
                                                                                            </a>                                                                                    
                                                                                        @else
                                                                                            <p>Oglas više ne postoji!</p>
                                                                                        @endif
                                                                                    </a>                                                                                
                                                                                    @if($offer->accepted == 1 || $offer->accepted == 3)
                                                                                    <hr>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <div class="mb-1 product-price"> 
                                                                                                Broj Telefona: {{$offer->product->user->phone ?? 'no client'}} <br>
                                                                                                Grad: {{$offer->product->user->city ?? 'no client'}}                                                                                            
                                                                                            </div>
                                                                                            <div class="cursor-pointer ms-auto"> 
                                                                                                    
                                                                                            </div>
                                                                                        </div>                                                    
                                                                                    @endif 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end row-->
                                                                <div class="product-action mt-2">
                                                                    <div class="d-grid gap-2">
                                                                        @if($offer->accepted == 0)
                                                                            @if ($offer->product && $offer->sendproduct)
                                                                                <div class="row">
                                                                                    <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.update', $offer->id)}}" method="POST">
                                                                                        {{ csrf_field() }}
                                                                                        {{method_field('post')}}
                                                                                        <input type="hidden" name="accepted" value="1">
                                                                                        <button class="btn btn-success btn-sm rounded-0 m-0 btn-ecomm" type="submit"><img src="/assets/images/correct.png" alt=""></button>
                                                                                        
                                                                                        
                                                                                    </form>                                                                       
                                                                                    <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.rejected', $offer->id)}}" method="POST">
                                                                                        {{ csrf_field() }}
                                                                                        {{method_field('post')}}
                                                                                        <input type="hidden" name="accepted" value="2">
                                                                                        
                                                                                        <button class="btn btn-danger btn-sm rounded-0 m-0 btn-ecomm" type="submit"><img src="/assets/images/incorrect.png" alt=""></button>
                                                                                    </form>
                                                                                </div>
                                                                                    

                                                                            @else

                                                                                <form class="d-grid gap-2  p-0 m-0" action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                                    {{ csrf_field() }}
                                                                                    {{method_field('delete')}}  
                                                                                    <button style="border:none; transparent:none;"  type="submit">
                                                                                        <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                    </button>  
                                                                                </form>   

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
                                                                                    
                                                                                </form>
                                                                                <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.canceled', $offer->id)}}" method="post">
                                                                                    {{ csrf_field() }}
                                                                                    {{method_field('post')}}
                                                                                    <input type="hidden" name="accepted" value="4">
                                                                                    <button class="btn btn-danger btn-sm m-0 btn-ecomm" type="submit">NE</button>
                                                                                    
                                                                                </form>
                                                                            </div>                                                                
                                                                        @endif
            
                                                                        @if ($offer->accepted == 2)
                                                                            <div class="alert alert-danger text-center" role="alert">
                                                                                Zahtev odbijen!
                                                                            </div>
                                                                            
                                                                            <form class="d-grid gap-2  p-0 m-0" action="{{route('offers.offer_archived', $offer->id)}}"  method="POST">
                                                                                {{ csrf_field() }}                                                                           
                                                                                <input type="hidden" name="offer_archived" value="1">                                                                           
                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                </button>  
                                                                            </form>                                                                        
                                                                        @endif
            
                                                                        @if($offer->accepted == 3)
                                                                            @if($offer->product)
                                                                                <div class="alert alert-success text-center" role="alert">
                                                                                    Uspešna zamena! Ocenite korisnika.
                                                                                </div>
                                                                                <div class="row">
                                                                                    <button type="button" class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#exampleModal{{$offer->id}}" data-bs-whatever="@mdo">Oceni korisnika</i></button>
                                                                                    <form class="d-grid gap-2  p-0 m-0 col-6" action="{{route('offers.offer_archived', $offer->id)}}"  method="POST">
                                                                                        {{ csrf_field() }}                                                                           
                                                                                        <input type="hidden" name="offer_archived" value="1">                                                                           
                                                                                        <button style="border:none; transparent:none;"  type="submit">
                                                                                            <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                        </button>  
                                                                                    </form>                                                                       
                                                                                </div>
                                                                            @endif
                                                                        @endif
            
                                                                        @if ($offer->accepted == 4)
                                                                            <div class="alert alert-danger text-center" role="alert">
                                                                                Neuspešna zamena! Ocenite korisnika.
                                                                            </div>
                                                                            <div class="row">
                                                                                <button type="button" class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#exampleModal{{$offer->id}}" data-bs-whatever="@mdo">Oceni korisnika</button>
                                                                                <form class="d-grid gap-2  p-0 m-0 col-6" action="{{route('offers.offer_archived', $offer->id)}}"  method="POST">
                                                                                {{ csrf_field() }}                                                                           
                                                                                <input type="hidden" name="offer_archived" value="1">                                                                           
                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                </button>  
                                                                            </form>
                                                                            </div>
                                                                        @endif
            
                                                                        {{-- @if (!$offer->product)                                                                
                                                                                <form class="d-grid gap-2  p-0 m-0" action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                                    {{ csrf_field() }}
                                                                                    {{method_field('delete')}}  
                                                                                    <button style="border:none; transparent:none;"  type="submit">
                                                                                        <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                    </button>                                                                                                                                                 
                                                                                </form>
                                                                            </td>
                                                                        @endif --}}
            
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                            <hr>                                                            
                                                        @endif
                                                        @if ($offer->product && $offer->sendproduct)
                                                            <div type="button"v class="modal fade" id="exampleModal{{$offer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                        
                                                                                            <input type="hidden" name="product_user_id" value="{{ $offer->sendproduct->user_id ?? 'no client'}}">                        
                                                                                                                                        
                                                                                    </div>
                                                                                
                                                                                
                                                                                    <div class="mb-3">
                                                                                        <label for="message-text" class="col-form-label">Tekst komentara</label>
                                                                                        <textarea class="form-control rounded-0" name="body" id="example" rows="5">{!! old('body') !!}</textarea>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        @if (optional(Auth::user())->id)
                                                                                            @if (Auth::user()->id == $offer->sendproduct->user_id)
                                                                                                <div class="like">
                                                                                                    <button style="transition: none; border: none;" type="button" disabled id="btn" class="like-button mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold" data-user-id="{{ $offer->sendproduct->user_id }}"><img src="/assets/images/thumbs-up.svg" alt=""> <span id="count" class="like-count">{{ $offer->sendproduct->user->likes() }}</span></button>
                                                                                                    <button style="transition: none; border: none;" type="button" disabled id="btn" class="dislike-button mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold" data-user-id="{{ $offer->sendproduct->user_id }}"><img src="/assets/images/thumbs-down.svg" alt=""> <span id="count" class="dislike-count">{{ $offer->sendproduct->user->dislikes() }}</span></button>  
                                                                                                </div>  
                                                                                            @else
                                                                                                <div class="like">
                                                                                                    <button style="transition: none; border: none;" type="button" class="like-button mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold" data-user-id="{{ $offer->sendproduct->user_id }}"><img src="/assets/images/thumbs-up.svg" alt=""> <span class="like-count">{{ $offer->sendproduct->user->likes() }}</span></button>
                                                                                                    <button style="transition: none; border: none;" type="button" class="dislike-button mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold" data-user-id="{{ $offer->sendproduct->user_id }}"><img src="/assets/images/thumbs-down.svg" alt=""> <span class="dislike-count">{{ $offer->sendproduct->user->dislikes() }}</span></button>  
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
                                                            </div>                                                     
                                                        @endif 
                                                    @endforeach
                                                </div>
                                                
                                                <div class="tab-pane fade" id="zahtevi" role="tabpanel">
                                                    @foreach ($sendoffers as $sendoffer)
                                                        @if (!$sendoffer->sendoffer_archived == 1)
                                                            @php
                                                                
                                                                if ($sendoffer->sendproduct !== null && null !== $sendoffer->sendproduct->images) {
                                                                        $sendofferImages = explode(",", $sendoffer->sendproduct->images);
                                                                    }
                                                            @endphp 
                                                    
                                                            @php
                                                                
                                                                if ($sendoffer->product !== null && null !== $sendoffer->product->images) {
                                                                        $images = explode(",", $sendoffer->product->images);
                                                                    }
                                                            @endphp  
                                                            <div class="product-grid border-1">                                                             
                                                                <div class="row row-cols-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 position-relative">
                                                                    <div class="col">
                                                                        <div class="card rounded-0 product-card">
                                                                            Moj proizvod
                                                                            <div class="card-header bg-transparent border-bottom-0">
                                                                                <div class="d-flex align-items-center justify-content-end gap-3">
                                                                                    <a href="javascript:;">
                                                                                        
                                                                                    </a>
                                                                                    <a href="javascript:;">
                                                                                        
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            @if ($sendoffer->sendproduct)
                                                                                <a href="{{route('products.show', $sendoffer->sendproduct->id)}}"><img src="/storage/Product_images/{{ $sendofferImages[0] }}" class="rounded = 9 card-img-top "alt=""></a> <!-- dobijeni artikal za zamenu -->
                                                                                @else
                                                                                    <img src="/storage/Product_images/noimage.jpg" class="rounded = 9 card-img-top" alt="">
                                                                                @endif
                                                                            <div class="card-body">
                                                                                <div class="product-info">
                                                                                    <a href="javascript:;">
                                                                                    
                                                                                    </a>
                                                                                    <a href="javascript:;">
                                                                                        @if ($sendoffer->sendproduct)
                                                                                        <a href="javascript:;">
                                                                                            <h6 class="product-name mb-2">{{$sendoffer->sendproduct->name}}</h6>
                                                                                            </a>
                                                                                        @else
                                                                                            <p>Oglas više ne postoji!</p>
                                                                                        @endif
                                                                                    </a>
                                                                                    
                                                                                    @if($sendoffer->sendaccepted == 1 || $sendoffer->sendaccepted == 3)
                                                                                    <hr>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <div class="mb-1 product-price">
                                                                                                    Broj Telefona: {{$sendoffer->sendproduct->user->phone ?? 'no client'}} <br>
                                                                                                    Grad: {{$sendoffer->sendproduct->user->city ?? 'no client'}}
                                                                                                </div>
                                                                                                <div class="cursor-pointer ms-auto">
                                                                                                    
                                                                                                </div>
                                                                                        </div>                                                   
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <img src="/assets/images/arrow.png" class="arrow-image-swap">
                                                                    <div class="col">
                                                                        <div class="card rounded-0 product-card">
                                                                            {{$sendoffer->acceptorName}}
                                                                            <div class="card-header bg-transparent border-bottom-0">
                                                                                <div class="d-flex align-items-center justify-content-end gap-3">
                                                                                    <a href="javascript:;">
                                                                                        
                                                                                    </a>
                                                                                    <a href="javascript:;">
                                                                                        
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            @if ($sendoffer->product)
                                                                            <a href="{{route('products.show', $sendoffer->product->id)}}"><img src="/storage/Product_images/{{ $images[0] }}" class="rounded = 9 card-img-top" alt=""></a>  <!-- artikal za zamenu -->
                                                                            @else
                                                                                
                                                                                <img src="/storage/Product_images/noimage.jpg" class="rounded = 9 card-img-top" alt="">
                                                                            @endif
                                                                            <div class="card-body">
                                                                                <div class="product-info">
                                                                                    <a href="javascript:;">
                                                                                        
                                                                                    </a>
                                                                                    <a href="javascript:;">
                                                                                        @if ($sendoffer->product)
                                                                                        <a href="javascript:;">
                                                                                            <h6 class="product-name mb-2">{{$sendoffer->product->name}}</h6>
                                                                                        </a>
                                                                                        @else
                                                                                            <p>Oglas više ne postoji!</p>
                                                                                        @endif
                                                                                    </a>
                                                                                    @if($sendoffer->sendaccepted == 1 || $sendoffer->sendaccepted == 3)
                                                                                    <hr>
                                                                                        <div class="d-flex align-items-center">
                                                                                            <div class="mb-1 product-price"> 
                                                                                                Broj Telefona: {{$sendoffer->product->user->phone ?? 'no client'}} <br>
                                                                                                Grad: {{$sendoffer->product->user->city ?? 'no client'}}
                                                                                            </div>
                                                                                            <div class="cursor-pointer ms-auto"> 
                                                                                                
                                                                                            </div>
                                                                                        </div>                                                    
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="product-action mt-2">
                                                                <div class="d-grid gap-2">
                                                                    @if ($sendoffer->sendaccepted == 0)
                                                                        @if (!$sendoffer->product)
                                                                            <form class="d-grid gap-2  p-0 m-0" action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                                {{ csrf_field() }}
                                                                                {{method_field('delete')}}  
                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                </button>  
                                                                            </form> 
                                                                        @else                                                                        
                                                                            <div class="alert alert-info text-center" role="alert">
                                                                                Zahtev  na čekanju!
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    
                                                                </div>
                                                            </div>
    
                                                            @if($sendoffer->sendaccepted == 1)
                                                                Da li je uspešna zamena?
                                                                <div class="row">
                                                                    <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.confirmation_sendoffer', $sendoffer->id)}}" method="POST">
                                                                        {{ csrf_field() }}
                                                                        {{method_field('post')}}
                                                                        <input type="hidden" name="accepted" value="3">
                                                                        <button class="btn btn-success btn-sm m-0 btn-ecomm" type="submit">DA</button>
                                                                       
                                                                    </form>
                                                                    <form class="d-grid gap-2 col-6 p-0 m-0" action="{{url('offers.canceled_sendoffer', $sendoffer->id)}}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{method_field('post')}}
                                                                        <input type="hidden" name="accepted" value="4">
                                                                        <button class="btn btn-danger btn-sm m-0 btn-ecomm" type="submit">NE</button>
                                                                        
                                                                    </form>
                                                                </div>                                                                
                                                            @endif
    
                                                            @if ($sendoffer->sendaccepted == 2)
                                                                <div class="d-grid gap-2">
                                                                    <div class="alert alert-danger text-center" role="alert">
                                                                        Zahtev odbijen!
                                                                    </div>                                                                
                                                                </div>
                                                                <form class="d-grid gap-2  p-0 m-0" action="{{route('offers.sendoffer_archived', $sendoffer->id)}}"  method="POST">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="sendoffer_archived" value="1">                                                                                                                            
                                                                    <button style="border:none; transparent:none;"  type="submit">
                                                                        <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                    </button>  
                                                                </form>                      
                                                            @endif
    
                                                            @if($sendoffer->sendaccepted == 3)
                                                                @if($sendoffer->product)
                                                                    <div class="alert alert-success text-center" role="alert">
                                                                        Uspešna zamena! Ocenite korisnika.
                                                                    </div>
                                                                    <div class="row">
                                                                        <button type="button" class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#exampleModal1{{$sendoffer->id}}" data-bs-whatever="@mdo">Oceni korisnika</button>
                                                                        <form class="d-grid gap-2  p-0 m-0 col-6" action="{{route('offers.sendoffer_archived', $sendoffer->id)}}"  method="POST">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="sendoffer_archived" value="1">                                                                                                                            
                                                                            <button style="border:none; transparent:none;"  type="submit">
                                                                                <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                            </button>  
                                                                        </form>         
                                                                    </div>
                                                                @endif
                                                            @endif
    
                                                            @if ($sendoffer->sendaccepted == 4)
                                                                <div class="d-grid gap-2">                                                               
                                                                    <div class="alert alert-danger text-center" role="alert">
                                                                        Neuspešna zamena! Ocenite korisnika.
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <button type="button" class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#exampleModal1{{$sendoffer->id}}" data-bs-whatever="@mdo">Oceni korisnika</button>
                                                                    <form class="d-grid gap-2  p-0 m-0 col-6" action="{{route('offers.sendoffer_archived', $sendoffer->id)}}"  method="POST">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="sendoffer_archived" value="1">                                                                                                                            
                                                                        <button style="border:none; transparent:none;"  type="submit">
                                                                            <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                        </button>  
                                                                    </form>      
                                                                </div>
                                                            @endif
                                                            <hr>
                                                        @endif

                                                        
                                                        @if ($sendoffer->product)
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
                                                                                    
                                                                                        <input type="hidden" name="product_user_id" value="{{ $sendoffer->product->user_id ?? 'no client'}}">                        
                                                                                    
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Tekst komentara</label>
                                                                                <textarea class="form-control rounded-0" name="body" id="example" rows="5">{!! old('body') !!}</textarea>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    @if (optional(Auth::user())->id)
                                                                                        @if (Auth::user()->id == $sendoffer->product->user_id)
                                                                                            <div class="like">
                                                                                                <button style="transition: none; border: none;" type="button" disabled id="btn" class="like-button mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold" data-user-id="{{ $sendoffer->product->user_id ?? 'no client'}}"><img src="/assets/images/thumbs-up.svg" alt=""> <span id="count" class="like-count">{{ $sendoffer->product->user->likes() }}</span></button>
                                                                                                <button style="transition: none; border: none;" type="button" disabled id="btn" class="dislike-button mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold" data-user-id="{{ $sendoffer->sendproduct->user_id ?? 'no client'}}"><img src="/assets/images/thumbs-down.svg" alt=""> <span id="count" class="dislike-count">{{ $sendoffer->product->user->dislikes() }}</span></button>  
                                                                                            </div>  
                                                                                        @else
                                                                                            <div class="like">
                                                                                                <button style="transition: none; border: none;" type="button" class="like-button mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold" data-user-id="{{ $sendoffer->product->user_id ?? 'no client'}}"><img src="/assets/images/thumbs-up.svg" alt=""> <span class="like-count">{{ $sendoffer->product->user->likes() }}</span></button>
                                                                                                <button style="transition: none; border: none;" type="button" class="dislike-button mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold" data-user-id="{{ $sendoffer->product->user_id ?? 'no client'}}"><img src="/assets/images/thumbs-down.svg" alt=""> <span class="dislike-count">{{ $sendoffer->product->user->dislikes() }}</span></button>  
                                                                                            </div>   
                                                                                            <br>                                   
                                                                                            
                                                                                        @endif                                            
                                                                                    @endif                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Postavi</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        
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


@extends('layouts.master')

@section('title', 'Moji zahtevi')

@section('content')

    <div class="container">
        <h3 class="d-none">Account</h3>
        <div class="card prod-card">
            <div class="card-body prod-card">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-none mb-3 mb-lg-0 border">
                            <div class="card-body">
                                <div class="list-group list-group-flush"> 
                                    <a href="/dashboard" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Dashboard <i class='bx bx-tachometer fs-5'></i></a>
                                    <a href="/offers" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Ponude<i class='bx bx-refresh fs-5'></i></a>
                                    <a href="/sendOffers" class="list-group-item active d-flex justify-content-between align-items-center">Moji zahtevi <i class='bx bx-refresh fs-5'></i></a>
                                    <a href="/wishlist" class="list-group-item d-flex justify-content-between align-items-center">Oglasi koje pratim <i class='bx bx-heart fs-5'></i></a>
                                    {{-- <a href="account-addresses.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Addresses <i class='bx bx-home-smile fs-5'></i></a>
                                         <a href="account-payment-methods.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Payment Methods <i class='bx bx-credit-card fs-5'></i></a> --}}
                                    <a href="/auth.edit/{{ auth()->user()->id }}" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Uredi Profil <i class='bx bx-user-circle fs-5'></i></a>
                                    <a href="{{ route('logout') }}" class="list-group-item d-flex justify-content-between align-items-center bg-transparent" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Izlogujte se') }}<i class='bx bx-log-out fs-5'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card shadow-none mb-0">
                            <div class="card-body prod-card">
                                <div class="table-responsive">
                                    <div class="container">
                                        <div class="product-more-info">
                                            <h6 class="text-center">Moji zahtevi</h6>
                                            <div class="tab-content pt-3">
                                                @foreach ($sendoffers as $sendoffer)
                                                    @if (!$sendoffer->sendoffer_archived == 1)
                                                        @php

                                                            if ($sendoffer->sendproduct !== null && null !== $sendoffer->sendproduct->images) {
                                                                $sendofferImages = explode(',',$sendoffer->sendproduct->images, );
                                                            }
                                                        @endphp

                                                        @php

                                                            if ($sendoffer->product !== null && null !== $sendoffer->product->images) {
                                                                $images = explode(',', $sendoffer->product->images);   
                                                            }
                                                        @endphp
                                                        @php
                                                            // Check if this specific offer is in exchange
                                                            $thisOfferInExchange = ($sendoffer->accepted == 1 || $sendoffer->accepted == 3 || $sendoffer->sendaccepted == 1 || $sendoffer->sendaccepted == 3);
                                                            
                                                            // Check if the products in this offer are involved in OTHER exchanges
                                                            $productsInOtherExchanges = false;
                                                            if (!$thisOfferInExchange && $sendoffer->product && $sendoffer->sendproduct) {
                                                                // Check if BOTH products in this offer are involved in the SAME other exchange
                                                                $productsInOtherExchanges = \DB::table('offers')
                                                                    ->where('id', '!=', $sendoffer->id)
                                                                    ->where(function($query) use ($sendoffer) {
                                                                        // Check if both products are in the same offer (either direction)
                                                                        $query->where(function($subQuery) use ($sendoffer) {
                                                                            $subQuery->where('product_id', $sendoffer->product_id)
                                                                                    ->where('sendproduct_id', $sendoffer->sendproduct_id);
                                                                        })->orWhere(function($subQuery) use ($sendoffer) {
                                                                            $subQuery->where('product_id', $sendoffer->sendproduct_id)
                                                                                    ->where('sendproduct_id', $sendoffer->product_id);
                                                                        });
                                                                    })
                                                                    ->where(function($query) {
                                                                        $query->whereIn('accepted', [1, 3])
                                                                              ->orWhereIn('sendaccepted', [1, 3]);
                                                                    })
                                                                    ->exists();
                                                            }
                                                            
                                                            $shouldDisable = !$thisOfferInExchange && $productsInOtherExchanges;
                                                        @endphp
                                                        <div class="product-grid border-1 {{ $shouldDisable ? 'disabled-exchange' : '' }}">
                                                            @if ($shouldDisable)
                                                                <div class="alert alert-warning text-center mb-2" role="alert">
                                                                    <strong>Oglas je u procesu razmene!</strong><br>
                                                                    <small>Ovaj oglas je već prihvaćen za razmenu i nije dostupan za dodatne zahteve.</small>
                                                                </div>
                                                            @endif
                                                            <div
                                                                class="row row-cols-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 position-relative">
                                                                <div class="col">
                                                                    <p class="text-center">Moj oglas</p>
                                                                    <div class="card rounded-0 product-card {{ $shouldDisable ? 'opacity-50' : '' }}">
                                                                        <div class="card-header bg-transparent border-bottom-0">
                                                                            <div class="d-flex align-items-center justify-content-end gap-3">
                                                                                <a href="javascript:;"></a>
                                                                                <a href="javascript:;"></a>
                                                                            </div>
                                                                        </div>
                                                                        @if ($sendoffer->sendproduct)
                                                                            <a href="{{ route('products.show', $sendoffer->sendproduct->id) }}"><img src="/storage/Product_images/{{ $sendofferImages[0] }}" class="rounded = 9 card-img-top "alt=""></a>         
                                                                            <!-- dobijeni artikal za zamenu -->
                                                                        @else
                                                                            <img src="/storage/Product_images/noimage.jpg" class="rounded = 9 card-img-top" alt=""> 
                                                                        @endif
                                                                        <div class="card-body prod-card">
                                                                            <div class="product-info">
                                                                                <a href="javascript:;"></a>

                                                                                <a href="javascript:;">
                                                                                    @if ($sendoffer->sendproduct)
                                                                                        <a href="javascript:;">
                                                                                            <h6 class="product-name mb-2 text-center">
                                                                                                {{ $sendoffer->sendproduct->name }}
                                                                                            </h6>
                                                                                        </a>
                                                                                    @else
                                                                                        <p>Oglas više ne postoji!</p>
                                                                                    @endif
                                                                                </a>

                                                                                @if ($sendoffer->sendaccepted == 1 || $sendoffer->sendaccepted == 3)
                                                                                    <hr>
                                                                                    <div class="d-flex align-items-center">
                                                                                        
                                                                                        <div class="mb-1 product-price">
                                                                                            <img width="16px" src="/assets/images/avatar.svg" alt="" srcset="">
                                                                                                {{ $sendoffer->user->firstName ?? 'no client' }}
                                                                                            <br>   
                                                                                            <img width="16px" src="/assets/images/phone.svg" alt="" srcset="">
                                                                                                {{ $sendoffer->user->phone ?? 'no client' }}
                                                                                             <br>   
                                                                                            <img width="16px" src="/assets/images/location.svg" alt="" srcset="">
                                                                                                {{ $sendoffer->user->city ?? 'no client' }}
                                                                                        </div>
                                                                                        <div class="cursor-pointer ms-auto"> </div>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <img src="/assets/images/arrow.png" class="arrow-image-swap">
                                                                   
                                                                <div class="col">
                                                                    <p class="text-center">
                                                                        {{ $sendoffer->acceptorName }}</p>
                                                                    <div class="card rounded-0 product-card {{ $shouldDisable ? 'opacity-50' : '' }}">
                                                                        <div class="card-header bg-transparent border-bottom-0">
                                                                             <div class="d-flex align-items-center justify-content-end gap-3">
                                                                                <a href="javascript:;"></a>
                                                                                <a href="javascript:;"></a>
                                                                            </div> 
                                                                        </div>

                                                                        @if ($sendoffer->product)
                                                                            <a href="{{ route('products.show', $sendoffer->product->id) }}"><img src="/storage/Product_images/{{ $images[0] }}" class="rounded = 9 card-img-top" alt=""></a>    
                                                                            <!-- artikal za zamenu -->
                                                                        @else
                                                                            <img src="/storage/Product_images/noimage.jpg" class="rounded = 9 card-img-top"alt="">    
                                                                        @endif

                                                                        <div class="card-body prod-card">
                                                                            <div class="product-info">
                                                                                <a href="javascript:;"></a>                                                                              
                                                                                <a href="javascript:;">
                                                                                    @if ($sendoffer->product)
                                                                                        <a href="javascript:;">
                                                                                            <h6 class="product-name mb-2 text-center">
                                                                                                {{ $sendoffer->product->name }}
                                                                                            </h6>
                                                                                        </a>
                                                                                    @else
                                                                                        <p>Oglas više ne postoji!</p>
                                                                                    @endif
                                                                                </a>
                                                                                @if ($sendoffer->sendaccepted == 1 || $sendoffer->sendaccepted == 3)
                                                                                    <hr>
                                                                                    <div class="d-flex align-items-center">
                                                                                        
                                                                                        <div class="mb-1 product-price">
                                                                                            <img width="16px" src="/assets/images/avatar.svg" alt="" srcset="">
                                                                                                {{ $sendoffer->acceptorName }}
                                                                                            <br>
                                                                                            <img width="16px" src="/assets/images/phone.svg" alt="" srcset="">
                                                                                                {{ $sendoffer->product->user->phone ?? 'no client' }}
                                                                                            <br>
                                                                                            <img width="16px" src="/assets/images/location.svg" alt="" srcset="">
                                                                                                {{ $sendoffer->user->city ?? 'no client' }}
                                                                                        </div>
                                                                                        <div class="cursor-pointer ms-auto"></div>
                                                                                    </div>
                                                                                    @if($sendoffer->product && $sendoffer->product->user_id != auth()->id())
                                                                                        <div class="mt-2">
                                                                                            <a href="/messages/{{ $sendoffer->product->user_id }}/{{ $sendoffer->id }}" class="btn btn-primary btn-sm">
                                                                                                <i class="bx bx-message"></i> Pošalji poruku
                                                                                            </a>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-action mt-2">
                                                            <div class="d-grid gap-2">
                                                                @if ($shouldDisable)
                                                                    {{-- Show only delete option for offers not in exchange --}}
                                                                    <div class="alert alert-info text-center mb-2" role="alert">
                                                                        <small>Oglas je u procesu razmene - dostupno je samo brisanje</small>
                                                                    </div>
                                                                    <form class="d-grid gap-2 p-0 m-0" action="{{ route('offers.destroy', $sendoffer->id) }}" method="POST">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('delete') }}
                                                                        <button style="border:none; transparent:none;" type="submit" class="btn btn-outline-danger btn-sm">
                                                                            <img style="width: 16px" src="/assets/images/delete.svg" alt="" srcset="">
                                                                            Obriši oglas
                                                                        </button>
                                                                    </form>
                                                                @elseif ($sendoffer->sendaccepted == 0)
                                                                    @if (!$sendoffer->sendproduct || !$sendoffer->product)
                                                                        <form class="d-grid gap-2  p-0 m-0" action="{{ route('offers.destroy', $sendoffer->id) }}" method="POST">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('delete') }}
                                                                            <button style="border:none; transparent:none;" type="submit">
                                                                                <img style="width: 16px" src="/assets/images/delete.svg" alt="" srcset="">  
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <div class="alert alert-info text-center" role="alert">
                                                                            Zahtev na čekanju!
                                                                        </div>
                                                                    @endif
                                                                    <div class="text-center">
                                                                       <form action="{{ route('offers.destroy', $sendoffer->id) }}" method="POST" style="display: inline;">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="submit" style="
                                                                                border: none;
                                                                                background: none;
                                                                                padding: 0;
                                                                                margin: 0;
                                                                                display: inline-flex;
                                                                                align-items: center;
                                                                                gap: 6px;
                                                                                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
                                                                                font-size: 16px;
                                                                                color: #ff3b30;
                                                                                font-weight: 400;
                                                                                cursor: pointer;
                                                                                transition: opacity 0.2s ease;
                                                                            " onmouseover="this.style.opacity='0.6'" onmouseout="this.style.opacity='1'">
                                                                                <img src="/assets/images/incorrect.svg" alt="Otkaži" style="width: 17px; height: 17px; margin-top: 1px;">
                                                                                Otkaži zahtev
                                                                            </button>
                                                                        </form>

                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        @if ($sendoffer->sendaccepted == 1)
                                                            @if ($sendoffer->product)
                                                                Da li je uspešna zamena?
                                                                <div class="row">
                                                                    <form class="d-grid gap-2 col-6 p-0 m-0" action="{{ url('offers.confirmation_sendoffer', $sendoffer->id) }}" method="POST">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('post') }}
                                                                        <input type="hidden" name="accepted" value="3">
                                                                        <input type="hidden" name="struja" value="{{ $sendoffer->product->struja }}">
                                                                        <input type="hidden" name="voda" value="{{ $sendoffer->product->voda }}">
                                                                        <input type="hidden" name="co2" value="{{ $sendoffer->product->co2 }}">
                                                                        <button class="btn btn-success btn-sm m-0 btn-ecomm" type="submit">DA</button>
                                                                    </form>
                                                                    <form class="d-grid gap-2 col-6 p-0 m-0" action="{{ url('offers.canceled_sendoffer', $sendoffer->id) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('post') }}
                                                                        <input type="hidden" name="accepted" value="4">
                                                                        <button class="btn btn-danger btn-sm m-0 btn-ecomm" type="submit">NE</button>
                                                                    </form>
                                                                </div>
                                                            @else
                                                                <form class="d-grid gap-2  p-0 m-0 " action="{{ route('offers.sendoffer_archived', $sendoffer->id) }}"
                                                                    method="POST">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="sendoffer_archived" value="1">
                                                                    <button style="border:none; transparent:none;" type="submit">
                                                                       <img style="width: 16px" src="/assets/images/delete.svg" alt="" srcset="">  
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @endif

                                                        @if ($sendoffer->sendaccepted == 2)
                                                            <div class="d-grid gap-2">
                                                                <div class="alert alert-danger text-center" role="alert">
                                                                   Zahtev odbijen!
                                                                </div>
                                                            </div>
                                                            <form class="d-grid gap-2  p-0 m-0" action="{{ route('offers.sendoffer_archived', $sendoffer->id) }}" method="POST">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="sendoffer_archived" value="1">
                                                                <button style="border:none; transparent:none;" type="submit">
                                                                    <img style="width: 16px" src="/assets/images/delete.svg" alt="" srcset="">
                                                                </button>   
                                                            </form>
                                                        @endif    

                                                        @if ($sendoffer->sendaccepted == 3)
                                                            @if ($sendoffer->product)
                                                                <div class="alert alert-success text-center" role="alert">
                                                                    Uspešna zamena! Ocenite korisnika.
                                                                </div>
                                                                    
                                                                <div class="row">
                                                                    <button type="button" class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#exampleModal1{{ $sendoffer->id }}" data-bs-whatever="@mdo">Oceni korisnika</button>
                                                                    <form class="d-grid gap-2  p-0 m-0 col-6" action="{{ route('offers.sendoffer_archived', $sendoffer->id) }}" method="POST">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="sendoffer_archived" value="1">
                                                                        <button style="border:none; transparent:none;" type="submit">
                                                                           <img style="width: 16px" src="/assets/images/delete.svg" alt="" srcset="">
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
                                                                <button type="button" class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#exampleModal1{{ $sendoffer->id }}" data-bs-whatever="@mdo">Oceni korisnika</button>
 
                                                                <form class="d-grid gap-2  p-0 m-0 col-6" action="{{ route('offers.sendoffer_archived', $sendoffer->id) }}" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="sendoffer_archived" value="1">
                                                                    <button style="border:none; transparent:none;" type="submit">
                                                                        <img style="width: 16px" src="/assets/images/delete.svg" alt="" srcset="">
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                        <hr>
                                                    @endif

                                                    @if ($sendoffer->product)
                                                        <div class="modal fade" id="exampleModal1{{ $sendoffer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Napišite komentar
                                                                        </h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
  
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('comments.store', $sendoffer->id) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="mb-3">
                                                                                <label for="recipient-name" class="col-form-label">Vaše ime i prezime</label>
                                                                                <input disabled type="text" class="form-control rounded-0" name="user_id" value="{{ Auth()->user()->firstName }}  {{ Auth()->user()->lastName }} ">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <input type="hidden" name="product_user_id" value="{{ $sendoffer->product->user_id ?? 'no client' }}">
                                                                            </div>
                                                                            
                                                                            <div class="mb-3">
                                                                                <label for="message-text" class="col-form-label">Tekst komentara</label>
                                                                                <textarea class="form-control rounded-0" name="body" id="example" rows="5">{!! old('body') !!}</textarea>
                                                                            </div>
                                                                                   
                                                                            <div class="modal-footer">
                                                                                @if (optional(Auth::user())->id)
                                                                                    @if (Auth::user()->id == $sendoffer->product->user_id)
                                                                                        <div class="like">
                                                                                            <button style="transition: none; border: none;" type="button" disabled id="btn" class="like-button mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold" data-user-id="{{ $sendoffer->product->user_id ?? 'no client' }}">
                                                                                                <img src="/assets/images/thumbs-up.svg" alt=""> <span id="count" class="like-count">{{ $sendoffer->product->user->likes() }}</span>
                                                                                            </button>

                                                                                            <button style="transition: none; border: none;" type="button" disabled id="btn" class="dislike-button mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold" data-user-id="{{ $sendoffer->sendproduct->user_id ?? 'no client' }}">
                                                                                                <img src="/assets/images/thumbs-down.svg" alt=""> <span id="count" class="dislike-count">{{ $sendoffer->product->user->dislikes() }}</span>
                                                                                            </button>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="like">
                                                                                            <button style="transition: none; border: none;" type="button" class="like-button mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold" data-user-id="{{ $sendoffer->product->user_id ?? 'no client' }}">
                                                                                                <img src="/assets/images/thumbs-up.svg" alt="">
                                                                                                <span class="like-count">{{ $sendoffer->product->user->likes() }}</span>
                                                                                            </button>
     
                                                                                            <button style="transition: none; border: none;" type="button" class="dislike-button mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold" data-user-id="{{ $sendoffer->product->user_id ?? 'no client' }}">
                                                                                                <img src="/assets/images/thumbs-down.svg" alt=""> <span class="dislike-count">{{ $sendoffer->product->user->dislikes() }}</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <br>
                                                                                    @endif
                                                                                @endif 
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" id="btn" class="btn btn-primary">Postavi</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if($sendoffers->isEmpty() || $sendoffer->sendoffer_archived == 1)
                                                    <div class="alert alert-info text-center" role="alert">
                                                        Trenutno nemate zahteva za razmenu!
                                                    </div>
                                                @endif
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


@endsection
@include('sweetalert::alert')

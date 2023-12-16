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
                                                    <div class="col-lg-12">
                                                        <div class="card shadow-none mb-0">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Ponuda br.</th>
                                                                                <th>Podnosilac</th>
                                                                                <th>Naziv proizvoda</th>                                                                                
                                                                                <th>Moj proizvod</th>
                                                                                <th>Status zahteva</th>
                                                                                <th>Telefon korisnika</th>
                                                                                <th>Uspešna zamena</th>
                                                                                <th>Akcija</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>                                                                            
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
                                                                                <tr>
                                                                                    <td>{{$offer->id}}</td>  
                                                                                    <td>{{$offer->user->firstName}}</td> <!-- ulogovani user -->
                                                                                    @if ($offer->sendproduct)
                                                                                        <td><a href="{{route('products.show', $offer->sendproduct->id)}}"><img src="/storage/Product_images/{{ $sendPproductImages[0] }}" class="rounded = 9" style="width: 50px; height: 50px" alt=""><br> {{$offer->sendproduct->name}}</a> </td> <!-- dobijeni artikal za zamenu -->
                                                                                    @else
                                                                                    <td><p>Oglas više ne postoji!</p></td> 
                                                                                    @endif
                                                                                    {{-- <td>{{$product->acceptor}}</td> <!-- user kome je poslata ponuda --> --}}
                                                                                    @if ($offer->product)
                                                                                        <td><a href="{{route('products.show', $offer->product->id)}}"><img src="/storage/Product_images/{{ $images[0] }}" class="rounded = 9" style="width: 50px; height: 50px" alt=""><br>{{$offer->product->name}}</td></a>  <!-- artikal za zamenu -->
                                                                                    @else
                                                                                        <td><p>Oglas više ne postoji!</p></td>
                                                                                    @endif
                                                                                    @if($offer->accepted == 1)
                                                                                        <td>
                                                                                            <img src="/assets/images/success.png" class="asign-right" alt="" srcset="">
                                                                                        </td>
                                                                                        <td>
                                                                                            {{$offer->user->phone ?? 'no client'}}
                                                                                        </td>
                                                                                        <td>
                                                                                            <form action="{{url('offers.confirmation', $offer->id)}}" method="POST">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('post')}}
                                                                                                <input type="hidden" name="accepted" value="3">
                                                                                                <button class="btn btn-success btn-sm" type="submit">DA</button>
                                                                                            </form>
                                                                                            <form action="{{url('offers.canceled', $offer->id)}}" method="post">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('post')}}
                                                                                                <input type="hidden" name="accepted" value="4">
                                                                                                <button class="btn btn-danger btn-sm" type="submit">NE</button>
                                                                                            </form>
                                                                                            {{-- <form action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('delete')}}  
                                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                </button>                                                                                                                                                 
                                                                                            </form> --}}
                                                                                        </td>
                                                                                    @elseif ($offer->accepted == 0)     
                                                                                        <td>
                                                                                            @if ($offer->product)
                                                                                                <div class="d-flex gap-2">
                                                                                                    <form action="{{url('offers.update', $offer->id)}}" method="POST">
                                                                                                        {{ csrf_field() }}
                                                                                                        {{method_field('post')}}
                                                                                                        <input type="hidden" name="accepted" value="1">
                                                                                                        <button class="btn btn-success btn-sm rounded-0 m-2" type="submit">Prihvati</button>
                                                                                                    </form>
                                                                                                    {{-- <a href="javascript:;" class="btn btn-dark btn-sm rounded-0" >Prihvati</a> --}}
                                                                                                </div>
                                                                                                <div class="d-flex gap-2">	
                                                                                                    <form action="{{url('offers.rejected', $offer->id)}}" method="POST">
                                                                                                        {{ csrf_field() }}
                                                                                                        {{method_field('post')}}
                                                                                                        <input type="hidden" name="accepted" value="2">
                                                                                                        <button class="btn btn-danger btn-sm rounded-0 m-2" type="submit">Odbij zahtev</button>
                                                                                                    </form>
                                                                                                    {{-- <a href="javascript:;" class="btn btn-dark btn-sm rounded-0">Odustani</a> --}}
                                                                                                </div>
                                                                                            @endif
                                                                                        </td>
                                                                                    @elseif($offer->accepted == 3)
                                                                                        @if ($offer->product)
                                                                                            <td>
                                                                                                <p>Uspešna zamena!</p>
                                                                                            </td>
                                                                                            <td>{{$offer->user->phone ?? 'no client'}}</td>
                                                                                            
                                                                                            <td><img src="/assets/images/success.png" class="asign-right" alt="" srcset=""></td>
                                                                                            <td>
                                                                                                <form action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                                                    {{ csrf_field() }}
                                                                                                    {{method_field('delete')}}  
                                                                                                    <button style="border:none; transparent:none;"  type="submit">
                                                                                                        <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                    </button>                                                                                                                                               
                                                                                                </form>                                                                                                
                                                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Oceni korisnika</button>
                                                                                            </td>
                                                                                        @endif
                                                                                    @elseif($offer->accepted == 4)
                                                                                        @if ($offer->product)
                                                                                            <td>
                                                                                                <p>Neuspešna zamena!</p>
                                                                                            </td>
                                                                                            <td></td>
                                                                                            
                                                                                            <td><img src="/assets/images/cansel.png" class="asign-right" alt="" srcset=""></td>
                                                                                            <td>
                                                                                                <form action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                                                    {{ csrf_field() }}
                                                                                                    {{method_field('delete')}}  
                                                                                                    <button style="border:none; transparent:none;"  type="submit">
                                                                                                        <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                    </button>                                                                                                                                                 
                                                                                                </form>
                                                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Oceni korisnika</button>
                                                                                            </td>
                                                                                        @endif
                                                                                    @elseif($offer->accepted == 2)
                                                                                        <td>
                                                                                            <p>Zahtev odbijen!</p>
                                                                                        </td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td>
                                                                                            <form action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('delete')}}  
                                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                </button>                                                                                                                                                 
                                                                                            </form>                                                                                            
                                                                                        </td>
                                                                                    @else
                                                                                        <td>
                                                                                            <img src="/assets/images/success.png" class="asign-right" alt="" srcset="">
                                                                                        </td>
                                                                                        
                                                                                        <td>
                                                                                            {{-- {{$offer->user->phone ?? 'no client'}} --}}
                                                                                        </td>
                                                                                        <td>
                                                                                            <form action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('delete')}}  
                                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                </button>                                                                                                                                                 
                                                                                            </form>
                                                                                        </td>
                                                                                            {{-- <p>Uspešno prihvaćen zahtev! </p> --}}
                                                                                            {{-- <p>Kontaktirajte korisnika radi uspešne zamene.</p> --}}
                                                                                            {{-- <button btn btn-dark btn-sm rounded-0 ></button> --}}
                                                                                    @endif
                                                                                    @if (!$offer->product)
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                        <td>
                                                                                            <form action="{{route('offers.destroy', $offer->id)}}"  method="POST">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('delete')}}  
                                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                </button>                                                                                                                                                 
                                                                                            </form>
                                                                                        </td>
                                                                                    @endif
                                                                                </tr>   
                                                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                </div>                                                                             
                                                                            @endforeach                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="tab-pane fade" id="zahtevi" role="tabpanel">
                                                    <div class="col-lg-12">
                                                        <div class="card shadow-none mb-0">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Zahtev br.</th>
                                                                                <th>Podnosilac</th>
                                                                                <th>Moj proizvod</th>
                                                                                <th>Zamena za</th>
                                                                                <th>Prihvacen zahtev</th>
                                                                                <th>Ime korisnika</th>
                                                                                <th>Telefon korisnika</th>
                                                                                <th>Uspešna zamena</th>
                                                                                <th>Akcija</th>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>                                                                           
                                                                            @foreach ($sendoffers as $sendoffer) 
                                                                            @php
                                                                                // $sendOfferImages = $sendoffer->sendproduct->images ? explode(",", $sendoffer->sendproduct->images) : [];
                                                                                if ($sendoffer->sendproduct !== null && null !== $sendoffer->sendproduct->images) {
                                                                                        $sendOfferImages = explode(",", $sendoffer->sendproduct->images);
                                                                                    }
                                                                            @endphp 
                                                                        
                                                                            @php
                                                                                // $images = $sendoffer->product->images ? explode(",", $sendoffer->product->images) : [];
                                                                                if ($sendoffer->product !== null && null !== $sendoffer->product->images) {
                                                                                        $images = explode(",", $sendoffer->product->images);
                                                                                    }
                                                                            @endphp                                                                                    
                                                                                <tr>
                                                                                    <td>{{$sendoffer->id}}</td>  
                                                                                    <td>{{$sendoffer->user->firstName}}</td> <!-- ulogovani user -->
                                                                                    @if ($sendoffer->sendproduct)
                                                                                        <td><a href="{{route('products.show', $sendoffer->sendproduct->id)}}"><img src="/storage/Product_images/{{ $sendOfferImages[0] }}" class="rounded = 9" style="width: 50px; height: 50px" alt=""><br> {{$sendoffer->sendproduct->name}}</a> </td> <!-- dobijeni artikal za zamenu -->
                                                                                    @else
                                                                                        <td><p>Oglas više ne postoji!</p></td>
                                                                                    @endif
                                                                                    {{-- <td>{{$product->acceptor}}</td> <!-- user kome je poslata ponuda --> --}}
                                                                                    @if ($sendoffer->product)
                                                                                        <td><a href="{{route('products.show', $sendoffer->product->id)}}"><img src="/storage/Product_images/{{ $images[0] }}" class="rounded = 9" style="width: 50px; height: 50px" alt=""><br> {{$sendoffer->product->name}}</a> </td> <!-- artikal za zamenu -->
                                                                                    @else
                                                                                        <td><p>Oglas više ne postoji!</p></td> 
                                                                                    @endif
                                                                                    {{-- <td>{{$sendoffer->acceptor->id}}</td> --}}
                                                                                    {{-- <td>{{$sendoffer->acceptorName}}</td> --}}
                                                                                    @if($sendoffer->accepted == 1)
                                                                                        <td>
                                                                                            <img src="/assets/images/success.png" class="asign-right" alt="" srcset="">
                                                                                        </td>
                                                                                        <td>{{$sendoffer->acceptorName}}</td>    
                                                                                        <td>{{$sendoffer->acceptorNumber}}</td>
                                                                                        <td>
                                                                                            <form action="{{url('offers.confirmation', $sendoffer->id)}}" method="POST">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('post')}}
                                                                                                <input type="hidden" name="accepted" value="3">
                                                                                                <button class="btn btn-success btn-sm" type="submit">DA</button>
                                                                                            </form>
                                                                                            <form action="{{url('offers.canceled', $sendoffer->id)}}" method="post">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('post')}}
                                                                                                <input type="hidden" name="accepted" value="4">
                                                                                                <button class="btn btn-danger btn-sm" type="submit">NE</button>
                                                                                            </form>
                                                                                            {{-- <form action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('delete')}}  
                                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                </button>                                                                                                                                                 
                                                                                            </form> --}}
                                                                                        </td>
                                                                                    @elseif($sendoffer->accepted == 3)
                                                                                        @if ($sendoffer->product)
                                                                                            <td>
                                                                                                <p>Uspešna zamena!</p>
                                                                                            </td>
                                                                                            <td>{{$sendoffer->acceptorName}}</td>
                                                                                            <td>{{$sendoffer->acceptorNumber}}</td>
                                                                                            <td>
                                                                                                <img src="/assets/images/success.png" class="asign-right" alt="" srcset="">
                                                                                            </td>
                                                                                            <td>
                                                                                                <form action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                                                    {{ csrf_field() }}
                                                                                                    {{method_field('delete')}}  
                                                                                                    <button style="border:none; transparent:none;"  type="submit">
                                                                                                        <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                    </button>  
                                                                                                </form>
                                                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">Oceni korisnika</button>                                                                                                                                               
                                                                                            </td>
                                                                                        @endif
                                                                                    @elseif($sendoffer->accepted == 4)
                                                                                        @if ($sendoffer->product)
                                                                                            <td>
                                                                                                <p>Neuspešna zamena!</p>
                                                                                            </td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td><img src="/assets/images/cansel.png" class="asign-right" alt="" srcset=""></td>
                                                                                            <td>
                                                                                                <form action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                                                    {{ csrf_field() }}
                                                                                                    {{method_field('delete')}}  
                                                                                                    <button style="border:none; transparent:none;"  type="submit">
                                                                                                        <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                    </button>
                                                                                                </form>
                                                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">Oceni korisnika</button>                                                                                                                                                 
                                                                                            </td>
                                                                                        @endif
                                                                                    @elseif($sendoffer->accepted == 2)
                                                                                        <td>
                                                                                            <p>Zahtev odbijen!</p>
                                                                                        </td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td>
                                                                                            <form action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('delete')}}  
                                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                </button>                                                                                                                                                 
                                                                                            </form>                                                    
                                                                                        </td>
                                                                                    @else
                                                                                        <td><p>Zahtev na čekanju</p></td>                                                                                         
                                                                                    @endif
                                                                                    @if (!$sendoffer->product)
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                        <td>
                                                                                            <form action="{{route('offers.destroy', $sendoffer->id)}}"  method="POST">
                                                                                                {{ csrf_field() }}
                                                                                                {{method_field('delete')}}  
                                                                                                <button style="border:none; transparent:none;"  type="submit">
                                                                                                    <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                                                </button>                                                                                                                                                 
                                                                                            </form>
                                                                                        </td>
                                                                                    @endif
                                                                                        
                                                                                </tr>
                                                                                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                </div>
                                                                                @endforeach                                                                            
                                                                                
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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


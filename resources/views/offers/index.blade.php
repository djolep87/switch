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

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            
                                                                                @foreach ($offers as $offer)
                                                                                    
                                                                                    <tr>
                                                                                        <td>{{$offer->id}}</td>  
                                                                                        <td>{{$offer->user->firstName}}</td> <!-- ulogovani user -->
                                                                                        <td><a href="{{route('products.view', $offer->sendproduct->id)}}"><img src="/storage/Product_images/{{ $offer->sendproduct->image }}" class="rounded = 9" style="width: 50px; height: 50px" alt="">{{$offer->sendproduct->name}}</a> </td> <!-- dobijeni artikal za zamenu -->
                                                                                        {{-- <td>{{$product->acceptor}}</td> <!-- user kome je poslata ponuda --> --}}
                                                                                        <td><a href="{{route('products.view', $offer->product->id)}}"><img src="/storage/Product_images/{{ $offer->product->image }}" class="rounded = 9" style="width: 50px; height: 50px" alt="">{{$offer->product->name}}</td></a>  <!-- artikal za zamenu -->
                                                                                        @if ($offer->accepted == 0)     
                                                                                            <td>
                                                                                                <div class="d-flex gap-2">
                                                                                                    <form action="/offers/{{$offer->id}}" method="POST">
                                                                                                        @csrf
                                                                                                        <input type="hidden" name="accepted" value="1">
                                                                                                        <button class="btn btn-dark btn-sm rounded-0 m-2" type="submit">Prihvati</button>
                                                                                                    </form>
                                                                                                    {{-- <a href="javascript:;" class="btn btn-dark btn-sm rounded-0" >Prihvati</a> --}}
                                                                                                </div>
                                                                                                <div class="d-flex gap-2">	
                                                                                                    <a href="javascript:;" class="btn btn-dark btn-sm rounded-0">Odustani</a>
                                                                                                </div>
                                                                                            </td>
                                                                                            
                                                                                        @else
                                                                                            <td>
                                                                                                <img src="/assets/images/success.png" class="asign-right" alt="" srcset="">
                                                                                            </td>
                                                                                           
                                                                                            <td>
                                                                                                {{$offer->user->phone ?? 'no client'}}
                                                                                            </td>
                                                                                                {{-- <p>Uspešno prihvaćen zahtev! </p> --}}
                                                                                                {{-- <p>Kontaktirajte korisnika radi uspešne zamene.</p> --}}
                                                                                                {{-- <button btn btn-dark btn-sm rounded-0 ></button> --}}
                                                                                        @endif
                                                                                    </tr>
                                                                                    
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


                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            
                                                                                @foreach ($sendoffers as $sendoffer)
                                                                                    
                                                                                    <tr>
                                                                                        <td>{{$sendoffer->id}}</td>  
                                                                                        <td>{{$sendoffer->user->firstName}}</td> <!-- ulogovani user -->
                                                                                        <td><a href="{{route('products.view', $sendoffer->sendproduct->id)}}"><img src="/storage/Product_images/{{ $sendoffer->sendproduct->image }}" class="rounded = 9" style="width: 50px; height: 50px" alt="">{{$sendoffer->sendproduct->name}}</a> </td> <!-- dobijeni artikal za zamenu -->
                                                                                        {{-- <td>{{$product->acceptor}}</td> <!-- user kome je poslata ponuda --> --}}
                                                                                        <td><a href="{{route('products.view', $sendoffer->product->id)}}"><img src="/storage/Product_images/{{ $sendoffer->product->image }}" class="rounded = 9" style="width: 50px; height: 50px" alt="">{{$sendoffer->product->name}}</a> </td> <!-- artikal za zamenu -->
                                                                                        {{-- <td>{{$sendoffer->acceptor->id}}</td> --}}
                                                                                        {{-- <td>{{$sendoffer->acceptorName}}</td> --}}
                                                                                        @if($sendoffer->accepted == 1)
                                                                                            <td>
                                                                                                <img src="/assets/images/success.png" class="asign-right" alt="" srcset="">
                                                                                            </td>
                                                                                            <td>{{$sendoffer->acceptorName}}</td>    
                                                                                            <td>{{$sendoffer->acceptorNumber}}</td>
                                                                                        @else
                                                                                               <td><p>Zahtev na čekanju</p></td> 
                                                                                        @endif
                                                                                            
                                                                                    </tr>
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
  
@endsection


@extends('layouts.master')

@section('title', 'Moj nalog')

@section('content')
<div class="container">
    <h3 class="d-none">Account</h3>
    <div class="card prod-card">
        <div class="card-body prod-card">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-none mb-3 mb-lg-0 border rounded-0">
                        <div class="card-body">
                            <div class="list-group list-group-flush">	<a href="/dashboard" class="list-group-item d-flex justify-content-between align-items-center">Dashboard <i class='bx bx-tachometer fs-5'></i></a>
                                <a href="/offers" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Ponude <i class='bx bx-cart-alt fs-5'></i></a>
                                <a href="/sendOffers" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Moji zahtevi <i class='bx bx-cart-alt fs-5'></i></a>
                                <a href="/wishlist" class="list-group-item active d-flex justify-content-between align-items-center">Oglasi koje pratim <i class='bx bx-star fs-5'></i></a>
                                {{-- <a href="account-addresses.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Addresses <i class='bx bx-home-smile fs-5'></i></a>
                                <a href="account-payment-methods.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Payment Methods <i class='bx bx-credit-card fs-5'></i></a> --}}
                                <a href="/auth.edit/{{auth()->user()->id}}" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Uredi Profil <i class='bx bx-user-circle fs-5'></i></a>
                                <a href="{{ route('logout') }}" class="list-group-item d-flex justify-content-between align-items-center bg-transparent" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Izlogujte se') }}<i class='bx bx-log-out fs-5'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card shadow-none mb-0">
                        <div class="card-body prod-card">
                            <div class="col-lg-12">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body prod-card">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>ID</th>
                                                        {{-- <th>Datum kreiranja</th> --}}
                                                        <th>Slika</th>
                                                        <th>Naziv</th>
                                                        <th>Uredi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($wishlists->count() > 0)
                                                        @foreach ($wishlists as $item )
                                                        @php
                                                        
                                                         if ($item->products !== null && null !== $item->products->images) {
                                                                $wishlistImages = explode(",", $item->products->images);
                                                            }
                                                            // $wishlistImages = $item->products->images ? explode(",", $item->products->images) : [];
                                                        @endphp 
                                                            <tr>
                                                                <td>#{{$item->id}}</td>
                                                                <td>
                                                                    @if ($item->products)
                                                                        <div class=""><a href="{{route('products.show', $item->products->id)}}"><img src="/storage/Product_images/{{ $wishlistImages[0] }}" class="img-fluid rounded = 5"  style="width: 50px; height: 50px;" alt=""></a> </div>
                                                                    
                                                                    @else
                                                                        <img src="/storage/Product_images/noimage.jpg" class="rounded = 9 card-img-top" style="width: 50px; height: 50px"  alt="">
                                                                        
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->products)
                                                                        <a href="{{route('products.show', $item->products->id)}}">{{$item->products->name}}</a>  
                                                                        
                                                                    @else
                                                                        <p>Oglas više ne postoji!</p>
                                                                    @endif
                                                                    {{-- <p>Oglas više ne postoji!</p> --}}
                                                                
                                                                </td>
                                                                <td>
                                                                    <form action="/wishlist.destroy/{{$item->id}}" id="formDelete-{{ $item->id }}" method="POST">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('delete') }}   
                                                                        <a title="Obriši" class="deleteButton" data-id="{{ $item->id }}" href="#">
                                                                            <img style="width: 16px" src="/assets/images/delete.svg" alt="Delete">
                                                                        </a>                                                                    
                                                                    </form> 
                                                                </td>
                                                               
                                                            </tr>
                                                           
                                                        @endforeach
                                                    @else
                                                        <td>
                                                            <p>Ne pratite oglase.</p>
                                                        </td> 
                                                        
                                                    @endif
                                                   
                                                    
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
            <!--end row-->
        </div>
    </div>
</div>
@endsection
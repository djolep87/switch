@extends('layouts.master')

@section('title', 'Moj nalog')

@section('content')
<div class="container">
    <h3 class="d-none">Account</h3>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-none mb-3 mb-lg-0 border rounded-0">
                        <div class="card-body">
                            <div class="list-group list-group-flush">	<a href="/dashboard" class="list-group-item d-flex justify-content-between align-items-center">Dashboard <i class='bx bx-tachometer fs-5'></i></a>
                                <a href="/offers" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Ponude <i class='bx bx-cart-alt fs-5'></i></a>
                                <a href="/wishlist" class="list-group-item active d-flex justify-content-between align-items-center">Oglasi koje pratim <i class='bx bx-download fs-5'></i></a>
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
                            <div class="col-lg-12">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Indentifikacija</th>
                                                        {{-- <th>Datum kreiranja</th> --}}
                                                        <th>Slika</th>
                                                        <th>Naziv</th>
                                                        <th>Akcija</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($wishlist->count() > 0)
                                                        @foreach ($wishlist as $item )
                                                            <tr>
                                                                <td>#{{$item->id}}</td>
                                                                <td>
                                                                    <div class=""><img src="/storage/Product_images/{{ $item->products->image }}" class="img-fluid rounded = 9"  style="width: 50px; height: 50px;" alt=""></div>
                                                                </td>
                                                                <td>{{$item->products->name}}</td>
                                                                <td>
                                                                    <div class="d-flex gap-2">	
                                                                        {{-- <a href="{{route('products.view', $product->id)}}" ><img src="/assets/images/eye.png" alt="" srcset=""></a> --}}
                                                                        {{-- <a href="products.edit/{{$product->id}}"><img src="/assets/images/edit.png" alt="" srcset=""></a>
                                                                        <a href=""><img src="/assets/images/delete.png" alt="" srcset=""></a> --}}
                                                                    </div>
                                                                </td>
                                                            </tr>                                                        
                                                        @endforeach
                                                    @else
                                                        <p>Ne pratite oglase.</p>
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
@extends('layouts.master')

@section('title', 'Ponude')

@section('content')
<section class="py-4">
    <div class="container">
        <h3 class="d-none">Account</h3>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-none mb-3 mb-lg-0 border">
                            <div class="card-body">
                                <div class="list-group list-group-flush">	<a href="/dashboard" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Dashboard <i class='bx bx-tachometer fs-5'></i></a>
                                    <a href="/ponude" class="list-group-item active d-flex justify-content-between align-items-center">Ponude <i class='bx bx-cart-alt fs-5'></i></a>
                                    <a href="account-downloads.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Downloads <i class='bx bx-download fs-5'></i></a>
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
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Offer id</th>
                                                <th>Ime podnosioca zahteva</th>
                                                <th>Naziv proizvoda</th>
                                                {{-- <th>Ime primaoca zahteva</th> --}}
                                                <th>Moj proizvod</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                @foreach ($products as $product)
                                                    
                                                    <tr>
                                                        <td>{{$product->id}}</td>  
                                                        <td>{{$product->user->firstName}}</td> <!-- ulogovani user -->
                                                        <td><a href="{{route('products.view', $product->id)}}"><img src="/storage/Product_images/{{ $product->sendproduct->image }}" style="width: 30px; height: 30px" alt="">{{$product->sendproduct->name}}</a> </td> <!-- dobijeni artikal za zamenu -->
                                                        {{-- <td>{{$product->acceptor}}</td> <!-- user kome je poslata ponuda --> --}}
                                                        <td><img src="/storage/Product_images/{{ $product->image }}" style="width: 30px; height: 30px" alt="">{{$product->product->name}}</td> <!-- artikal za zamenu -->
                                                        <td>
                                                            <div class="d-flex gap-2">	
                                                                <a href="javascript:;" class="btn btn-dark btn-sm rounded-0">Prihvati</a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">	
                                                                <a href="javascript:;" class="btn btn-dark btn-sm rounded-0">Odustani</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
</section>
@endsection
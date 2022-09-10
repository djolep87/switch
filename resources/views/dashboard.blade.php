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
                            <div class="list-group list-group-flush">	<a href="account-dashboard.html" class="list-group-item active d-flex justify-content-between align-items-center">Dashboard <i class='bx bx-tachometer fs-5'></i></a>
                                <a href="account-orders.html" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Orders <i class='bx bx-cart-alt fs-5'></i></a>
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
                            <div class="col-lg-12">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Indentifikacija</th>
                                                        <th>Datum kreiranja</th>
                                                        <th>Slika</th>
                                                        <th>Naziv</th>
                                                        <th>Akcija</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($products as $product )
                                                        <tr>
                                                            <td>#{{$product->id}}</td>
                                                            <td>{{$product->created_at->toFormattedDateString()}}</td>
                                                            <td>
                                                                <div class=""><img src="/storage/Product_images/{{ $product->image }}" class="img-fluid " style="width: 50px; height: 50px;" alt=""></div>
                                                            </td>
                                                            <td>{{$product->name}}</td>
                                                            <td>
                                                                <div class="d-flex gap-2">	<a href="{{route('products.view', $product->id)}}" class="btn btn-dark btn-sm rounded-0">View</a>
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
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
@endsection
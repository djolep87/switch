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
                            <div class="list-group list-group-flush">	<a href="/dashboard" class="list-group-item active d-flex justify-content-between align-items-center">Dashboard <i class='bx bx-tachometer fs-5'></i></a>
                                <a href="/offers" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Ponude <i class='bx bx-cart-alt fs-5'></i></a>
                                <a href="/wishlist" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Oglasi koje pratim <i class='bx bx-download fs-5'></i></a>
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
                                            <div class="filter-sidebar d-none d-xl-flex pb-2">
                                                <div class="card rounded-0">
                                                    <button onclick="window.location.href='/products.create'" class="btn btn-dark">Postavite oglas<i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Šifra artikla</th>
                                                        <th>Datum kreiranja</th>
                                                        <th>Slika</th>
                                                        <th>Naziv</th>
                                                        <th>Akcija</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($products as $product )
                                                    @php
                                                        $images = $product->images ? explode(",", $product->images) : [];
                                                    @endphp 
                                                        <tr>
                                                            <td>#{{$product->id}}</td>
                                                            <td>{{$product->created_at->toFormattedDateString()}}</td>
                                                            <td>
                                                                <div class=""><img src="/storage/Product_images/{{ $images[0] }}" class="img-fluid rounded = 9"  style="width: 50px; height: 50px;" alt=""></div>
                                                            </td>
                                                            <td>{{$product->name}}</td>
                                                            <td>
                                                                <div class="d-flex gap-2">	
                                                                    <a title="Pogledaj" href="{{route('products.show', $product->id)}}" ><img src="/assets/images/eye.png" alt="" srcset=""></a>
                                                                    <a title="Uredi" href="products.edit/{{$product->id}}"><img src="/assets/images/edit.png" alt="" srcset=""></a>
                                                                    {{-- <form class="d-grid gap-2 col-6 p-0 m-0" action="{{route('product.destroy', $product->id)}}" id="frmDelete"  method="POST">
                                                                        {{ csrf_field() }}
                                                                        {{method_field('delete')}}  
                                                                        <button class="deleteButton" style="border:none; transparent:none;"  type="submit">
                                                                            <img src="/assets/images/delete.png" alt="" srcset="">                                                                        
                                                                            <a href=""><img src="/assets/images/delete.png" alt="" srcset=""></a>
                                                                        </button>                                                                
                                                                        <a title="Obriši" id="frmDelete" onclick="document.form.submit" href=""><img src="/assets/images/delete.png" alt="" srcset=""></a>

                                                                    </form>    --}}
                                                                    <form class="d-grid gap-2 col-6 p-0 m-0" action="{{ route('product.destroy', $product->id) }}" id="frmDelete" method="POST">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('delete') }}  
                                                                        <a title="Obriši" id="deleteButton" href="#"><img src="/assets/images/delete.png" alt="" srcset=""></a>
                                                                    </form>
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
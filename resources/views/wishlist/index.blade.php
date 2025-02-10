@extends('layouts.master')

@section('title', 'Moj nalog')

@section('content')
    <div class="container">
        <h3 class="d-none">Account</h3>
        <div class="card prod-card">
            <div class="card-body prod-card">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <div class="card shadow-none mb-3 mb-lg-0 border rounded-0">
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a href="/dashboard" class="list-group-item d-flex justify-content-between align-items-center">
                                        Dashboard <i class='bx bx-tachometer fs-5'></i>
                                    </a>
                                    <a href="/offers" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Ponude <i class='bx bx-refresh fs-5'></i>
                                    </a>
                                    <a href="/sendOffers" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Moji zahtevi <i class='bx bx-refresh fs-5'></i>
                                    </a>
                                    <a href="/wishlist" class="list-group-item active d-flex justify-content-between align-items-center">
                                        Oglasi koje pratim <i class='bx bx-heart fs-5'></i>
                                    </a>
                                    <a href="/auth.edit/{{ auth()->user()->id }}" class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        Uredi Profil <i class='bx bx-user-circle fs-5'></i>
                                    </a>
                                    <a href="{{ route('logout') }}" class="list-group-item d-flex justify-content-between align-items-center bg-transparent"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Izlogujte se') }} <i class='bx bx-log-out fs-5'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <div class="card shadow-none mb-0">
                            <div class="card-body prod-card">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Slika</th>
                                                <th>Naziv</th>
                                                <th>Uredi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($wishlists as $item)
                                                @php
                                                    $wishlistImages = $item->products?->images ? explode(',', $item->products->images) : [];
                                                @endphp
                                                <tr>
                                                    <td>#{{ $item->id }}</td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ route('products.show', $item->products->id ?? '') }}">
                                                                <img src="{{ asset('storage/Product_images/' . ($wishlistImages[0] ?? 'noimage.jpg')) }}"
                                                                     class="img-fluid rounded-5"
                                                                     style="width: 50px; height: 50px;"
                                                                     alt="Slika proizvoda">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($item->products)
                                                            <a href="{{ route('products.show', $item->products->id) }}">
                                                                {{ $item->products->name }}
                                                            </a>
                                                        @else
                                                            <p>Oglas više ne postoji!</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" id="formDelete-{{ $item->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a title="Obriši" class="deleteButton" data-id="{{ $item->id }}" href="#">
                                                                <img style="width: 16px" src="{{ asset('assets/images/delete.svg') }}" alt="Delete">
                                                            </a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">
                                                        <div class="alert alert-info" role="alert">
                                                            <p>Lista želja je prazna!</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
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
@endsection

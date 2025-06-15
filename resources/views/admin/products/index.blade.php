@extends('admin.layouts.app')
@section('title', 'List products')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">          
       <h5 class="card-header">Products</h5> 
                    <h6 class="card-header fw-bold py-3 mb-4"><span class="text-muted fw-light">Number of products {{$productCount}}</span></h6>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-dark">
                            <thead>
                              <tr>
                                <th>Ime</th>
                                <th>Stanje</th>
                                {{-- <th>Opis</th> --}}
                                <th>Slika</th>
                                <th>Vidjeno</th>
                                <th>User id</th>
                                <th>Categry id</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$product->name}}</strong></td>
                                        <td>{{$product->condicion}}</td>
                                        {{-- <td>{{$product->description}}</td> --}}
                                        <td>{{$product->images}}</td>
                                        <td>{{$product->views}}</td>
                                        <td>{{$product->user_id}}</td>
                                        <td>{{$product->category_id}}</td>
                                        <td>
                                            <a href="" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                             <div class="mt-3">
                                {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                      </table>
                    </div>
    </div>
</div>
@endsection
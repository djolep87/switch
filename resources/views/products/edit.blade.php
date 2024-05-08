@extends('layouts.master')

@section('title', 'Edit')

@section('content')
    <div class="">
        <div class="container">
            <div class="col-lg-12">
                <div class="card shadow-none mb-0 border">
                    <div class="card-body">
                        <form class="row g-3" action="/products/{{$product->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label class="form-label">Naziv proizvoda</label>
                                <input type="text" name="name" class="form-control" value="{{$product->name}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stanje</label>
                                <select class="form-select" name="condition" id="inputSelectCountry" aria-label="Default select example">
                                    <option selected value="Polovno">Polovno</option>
                                    <option value="Novo">Novo</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Kategorija</label>
                                <select class="form-select" name="category_id" id="inputSelectCountry" aria-label="Default select example">
                                    @foreach ($categories as $category )
                                        <option selected name="category_id" value="{{$category->id}}">{{$category->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Opis proizvoda</label>
                                <textarea rows="10" name="description" class="form-control rounded-0">{!! Request::old('description', $product->description) !!}</textarea>
                            </div>
                            {{-- <div class="col-12">
                                <label class="form-label">Slika proizvoda</label>
                                <input type="file" name="image" class="form-control" >
                                <img src="/storage/Product_images/{{$product->image}}" width="50px" height="50px" alt="">
                            </div> --}}
                            <div class="col-12">
                                <label class="form-label">Galerija proizvoda</label>
                                <input type="file" name="images[]" class="form-control" multiple>
                                @foreach ($images as $image)
                                @php
                                    $images = $product->images ? explode(",", $product->images) : [];
                                @endphp 
                                    <img src="/storage/Product_images/{{$images}}" width="50px" height="50px" alt="">
                                @endforeach
                            </div>
                        
                            <div class="col-12">
                                {{-- <button type="submit" name="submit" class="btn btn-dark btn-ecomm">Sacuvaj</button> --}}
                                <input class="btn btn-dark btn-ecomm" type="submit" name="submit" value="Sačuvaj">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
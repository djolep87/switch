@extends('layouts.master')

@section('title', 'Postavi oglas')

@section('content')
<div class="">
    <div class="container">
        <div class="col-lg-12">
            <div class="card shadow-none mb-0 border">
                <div class="card-body">
                    <form id="productForm" class="row g-3" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">Naziv proizvoda</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
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
                                @if ($categories->isNotEmpty())
                                    <option name="category_id" value="{{$categories->first()->id}}" selected>{{$categories->first()->name}}</option>
                                    @foreach ($categories->skip(1) as $category)
                                        <option name="category_id" value="{{$category->id}}">{{$category->name}}</option> 
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div id="container">
                            <div id="editorContainer">
                                <label class="form-label">Opis proizvoda</label>
                                <textarea class="form-control" name="description" id="description" >{!! old('description') !!}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Galerija proizvoda</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>
                        <div class="col-12">
                            <input class="btn btn-dark btn-ecomm" type="submit" name="submit" value="Sačuvaj">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
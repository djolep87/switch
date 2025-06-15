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
                        <div class="col-md-4">
                            <label class="form-label">Naziv proizvoda</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Stanje</label>
                            <select class="form-select" name="condition" id="inputSelectCountry" aria-label="Default select example">
                                <option selected value="Polovno">Polovno</option>
                                <option value="Novo">Novo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kategorija</label>
                            <select class="form-select" name="category_id" id="categorySelect">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" data-electricity="{{ $category->struja }}" 
                                        data-water="{{ $category->voda }}" data-co2="{{ $category->co2 }}">
                                        {{ $category->name }}
                                    </option> 
                                @endforeach
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
                            <input class="btn split-bg-warning" type="submit" name="submit" value="Sačuvaj">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.master')

@section('title', 'Postavi oglas')

@section('content')
<div class="">
    <div class="container">
        <div class="col-lg-12">
            <div class="card shadow-none mb-0 border">
                <div class="card-body">
                    <form class="row g-3" action="/products.store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">Naziv proizvoda</label>
                            <input type="text" name="name" class="form-control" required value="">
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
                        <div class="col-12">
                            <label class="form-label">Opis proizvoda</label>
                            <textarea rows="10" name="description" class="form-control rounded-0" required id="example"></textarea>
                        </div>
                        {{-- <div class="col-12">
                            <label class="form-label">Slika proizvoda</label>
                            <input type="file" name="image" class="form-control" >
                        </div> --}}
                        <div class="col-12">
                            <label class="form-label">Galerija proizvoda</label>
                            <input type="file" name="images[]" class="form-control" multiple>
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


    <script>
		var editor1 = new RichTextEditor("#inp_editor1");    
	</script>


@endsection
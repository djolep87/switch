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
                            <input type="text" name="name" id="productName" class="form-control" required value="{{ old('name') }}">
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
                                <label class="form-label">
                                    Opis proizvoda
                                    <button type="button" id="generateAiDescription" class="btn btn-sm btn-outline-primary ms-2" style="font-size: 0.875rem;">
                                        <i class="bx bx-sparkles"></i> Generiši AI opis
                                    </button>
                                    <span id="aiLoading" class="ms-2" style="display: none;">
                                        <i class="bx bx-loader-alt bx-spin"></i> Generisanje...
                                    </span>
                                </label>
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

<script>
    // Wait for CKEditor to be initialized (it's initialized in master.blade.php)
    document.addEventListener('DOMContentLoaded', function() {
        // Wait a bit for CKEditor to initialize
        setTimeout(function() {
            // Get the global editorInstance from master.blade.php
            let editorInstance = window.editorInstance;

            // AI Description Generator Button
            const generateButton = document.getElementById('generateAiDescription');
            const loadingIndicator = document.getElementById('aiLoading');
            const productNameInput = document.getElementById('productName');

            if (generateButton) {
                generateButton.addEventListener('click', function() {
                    const productName = productNameInput.value.trim();

                    if (!productName) {
                        alert('Molimo unesite naziv proizvoda pre generisanja opisa.');
                        productNameInput.focus();
                        return;
                    }

                    // Check if editor is initialized
                    if (!editorInstance) {
                        // Try to get it from the global scope
                        editorInstance = window.editorInstance;
                        if (!editorInstance) {
                            alert('Editor nije spreman. Molimo sačekajte trenutak i pokušajte ponovo.');
                            return;
                        }
                    }

                    // Disable button and show loading
                    generateButton.disabled = true;
                    loadingIndicator.style.display = 'inline';

                    // Make API call
                    fetch('{{ route("products.generate-description") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            product_name: productName
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && editorInstance) {
                            // Set the generated description in CKEditor
                            editorInstance.setData(data.description);
                        } else {
                            alert(data.message || 'Došlo je do greške pri generisanju opisa.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Došlo je do greške pri generisanju opisa. Molimo pokušajte ponovo.');
                    })
                    .finally(() => {
                        // Re-enable button and hide loading
                        generateButton.disabled = false;
                        loadingIndicator.style.display = 'none';
                    });
                });
            }
        }, 500); // Wait 500ms for CKEditor to initialize
    });
</script>
@endsection
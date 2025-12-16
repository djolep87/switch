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
                                <label class="form-label label-with-buttons">
                                    <span class="label-text">Opis proizvoda</span>
                                    <div class="label-actions">
                                        <button type="button" id="generateAiDescription" class="btn btn-sm ai-generate-btn">
                                            <i class="bx bx-brain ai-sparkle-icon"></i> Generiši AI opis
                                        </button>
                                        <button type="button" id="aiDescriptionInfo" class="btn btn-sm btn-link info-btn" data-bs-toggle="modal" data-bs-target="#aiDescriptionInfoModal">
                                            <i class="bx bx-info-circle"></i>
                                        </button>
                                        <span id="aiLoading" style="display: none;">
                                            <i class="bx bx-loader-alt bx-spin"></i> Generisanje...
                                        </span>
                                    </div>
                                </label>
                                <textarea class="form-control" name="description" id="description" >{!! old('description') !!}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Galerija proizvoda</label>
                            <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                            <small class="text-muted d-block mt-1">
                                <i class="bx bx-info-circle"></i> 
                                Slike će biti automatski optimizovane sa visokim kvalitetom (maksimalna širina 1920px). 
                                Preporučujemo slike u formatu JPG, PNG ili WebP.
                            </small>
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

<!-- Modal za AI opis info -->
<div class="modal fade" id="aiDescriptionInfoModal" tabindex="-1" aria-labelledby="aiDescriptionInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aiDescriptionInfoModalLabel">
                    <i class="bx bx-info-circle"></i> Informacije o AI opisu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Opis proizvoda će biti automatski generisan na osnovu naziva proizvoda koji ste uneli. AI će kreirati profesionalan i privlačan opis koji će pomoći kupcima da bolje razumeju vaš proizvod.</p>
                <p><strong>Napomena:</strong> Pre generisanja opisa, molimo vas da unesete naziv proizvoda.</p>
                <p class="mb-0">Nakon generisanja opisa, možete ga prepraviti i prilagoditi pre postavljanja oglasa ukoliko AI nije uneo podatke kako treba. Sve podatke o proizvodu možete izmeniti pre nego što sačuvate oglas.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
            </div>
        </div>
    </div>
</div>

<style>
    .label-with-buttons {
        display: flex !important;
        flex-wrap: nowrap !important;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        width: 100%;
    }

    .label-text {
        flex-shrink: 0;
        white-space: nowrap;
    }

    .label-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-shrink: 0;
        white-space: nowrap;
    }

    .info-btn {
        padding: 0.25rem 0.5rem !important;
        min-width: auto !important;
        color: #6c757d !important;
        text-decoration: none !important;
        font-size: 0.875rem !important;
    }

    .info-btn i {
        font-size: 1.2rem !important;
    }

    .info-btn:hover {
        color: #0d6efd !important;
    }

    #aiLoading {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        white-space: nowrap;
        font-size: 0.875rem;
    }

    @media (max-width: 576px) {
        .label-with-buttons {
            flex-wrap: nowrap !important;
            gap: 0.4rem !important;
        }

        .label-text {
            font-size: 0.875rem;
            white-space: nowrap;
        }

        .label-actions {
            flex-wrap: nowrap !important;
            gap: 0.4rem !important;
        }

        .ai-generate-btn {
            font-size: 0.75rem !important;
            padding: 0.4rem 0.75rem !important;
            white-space: nowrap;
        }

        .info-btn {
            padding: 0.25rem !important;
            flex-shrink: 0;
        }

        .info-btn i {
            font-size: 1rem !important;
        }

        #aiLoading {
            font-size: 0.75rem;
        }
    }

    .ai-generate-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.875rem;
        padding: 0.5rem 1.25rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 15px 0 rgba(102, 126, 234, 0.4);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        overflow: visible;
        white-space: nowrap;
    }

    .ai-generate-btn i,
    .ai-generate-btn span {
        flex-shrink: 0;
        position: relative;
        z-index: 2;
    }

    .ai-generate-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
        z-index: 0;
        pointer-events: none;
    }

    .ai-generate-btn:hover::before {
        left: 100%;
    }

    .ai-generate-btn:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        box-shadow: 0 6px 20px 0 rgba(102, 126, 234, 0.6);
        transform: translateY(-2px);
    }

    .ai-generate-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 10px 0 rgba(102, 126, 234, 0.4);
    }

    .ai-generate-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .ai-generate-btn:disabled:hover {
        transform: none;
        box-shadow: 0 4px 15px 0 rgba(102, 126, 234, 0.4);
    }

    .ai-sparkle-icon {
        font-size: 1.3rem !important;
        animation: sparkle 2s ease-in-out infinite;
        display: inline-block !important;
        vertical-align: middle;
        line-height: 1;
        color: #ffffff !important;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        opacity: 1 !important;
        visibility: visible !important;
        font-family: 'boxicons' !important;
        font-weight: 400 !important;
        font-style: normal !important;
    }

    @keyframes sparkle {
        0%, 100% {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
        50% {
            transform: scale(1.2) rotate(180deg);
            opacity: 0.8;
        }
    }

    .ai-generate-btn:hover .ai-sparkle-icon {
        animation-duration: 1s;
    }
</style>

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
@extends('admin.layouts.app')

@section('title', 'Lista Oglasa')
@section('content')
<style>
    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .badge-status {
        padding: 0.35em 0.65em;
        font-size: 0.75rem;
    }
    /* Filter submit button styling */
    #filterForm button[type="submit"] {
        min-width: 120px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    #filterForm button[type="submit"] i {
        font-size: 1.1rem;
    }
    @media (max-width: 768px) {
        #filterForm button[type="submit"] {
            min-width: auto;
            padding: 0.5rem 1rem;
        }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1">Lista Oglasa</h4>
                    <p class="text-muted mb-0">Upravljajte svim oglasima u sistemu</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-1 text-muted">Ukupno Oglasa</span>
                            <h3 class="card-title mb-0">{{ number_format($productCount) }}</h3>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-package fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-1 text-muted">Aktivni</span>
                            <h3 class="card-title mb-0 text-success">{{ number_format($activeCount) }}</h3>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-check-circle fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-1 text-muted">Neaktivni</span>
                            <h3 class="card-title mb-0 text-danger">{{ number_format($inactiveCount) }}</h3>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-danger">
                                <i class="bx bx-x-circle fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-1 text-muted">Ukupno Pregleda</span>
                            <h3 class="card-title mb-0 text-info">{{ number_format($totalViews) }}</h3>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-info">
                                <i class="bx bx-show fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.products') }}" id="filterForm">
                <div class="row g-3">
                    <!-- Search -->
                    <div class="col-md-4">
                        <label class="form-label">Pretraga</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" 
                                   class="form-control" 
                                   name="search" 
                                   placeholder="Pretraži po nazivu, opisu..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <!-- Status Filter -->
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Svi statusi</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktivni</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Neaktivni</option>
                        </select>
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="col-md-3">
                        <label class="form-label">Kategorija</label>
                        <select class="form-select" name="category_id">
                            <option value="">Sve kategorije</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Condition Filter -->
                    <div class="col-md-2">
                        <label class="form-label">Stanje</label>
                        <select class="form-select" name="condition">
                            <option value="">Sva stanja</option>
                            <option value="Novo" {{ request('condition') == 'Novo' ? 'selected' : '' }}>Novo</option>
                            <option value="Polovno" {{ request('condition') == 'Polovno' ? 'selected' : '' }}>Polovno</option>
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="col-md-1 d-flex align-items-end">
                        <div class="d-flex gap-2 w-100">
                            <button type="submit" class="btn btn-primary flex-grow-1" title="Primeni filtere">
                                <i class="bx bx-search me-1"></i>
                                <span class="d-none d-md-inline">Pretraži</span>
                            </button>
                            <a href="{{ route('admin.products') }}" class="btn btn-label-secondary" title="Resetuj filtere">
                                <i class="bx bx-x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Active Filters -->
    @if(request()->hasAny(['search', 'status', 'category_id', 'condition']))
        <div class="alert alert-info d-flex align-items-center mb-3" role="alert">
            <i class="bx bx-info-circle me-2"></i>
            <div class="flex-grow-1">
                <strong>Aktivni filteri:</strong>
                @if(request('search'))
                    <span class="badge bg-label-primary me-1">Pretraga: "{{ request('search') }}"</span>
                @endif
                @if(request('status'))
                    <span class="badge bg-label-success me-1">Status: {{ request('status') == 'active' ? 'Aktivni' : 'Neaktivni' }}</span>
                @endif
                @if(request('category_id'))
                    <span class="badge bg-label-info me-1">Kategorija: {{ $categories->find(request('category_id'))->name ?? 'N/A' }}</span>
                @endif
                @if(request('condition'))
                    <span class="badge bg-label-warning me-1">Stanje: {{ request('condition') }}</span>
                @endif
            </div>
            <a href="{{ route('admin.products') }}" class="btn btn-sm btn-label-secondary">
                <i class="bx bx-x"></i> Obriši sve
            </a>
        </div>
    @endif

    <!-- Products Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Svi Oglasi</h5>
            <div class="text-muted">
                <small>Prikazano: {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} od {{ $products->total() }}</small>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Slika</th>
                            <th>Naziv</th>
                            <th>Stanje</th>
                            <th>Status</th>
                            <th>Pregleda</th>
                            <th>Korisnik</th>
                            <th>Kategorija</th>
                            <th>Akcije</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    @php
                                        $imagePath = $product->images ? explode(',', $product->images)[0] : 'noimage.jpg';
                                    @endphp
                                    <img src="{{ asset('storage/Product_images/' . $imagePath) }}" 
                                         alt="{{ $product->name }}" 
                                         class="product-image"
                                         onerror="this.src='{{ asset('assets/images/noimage.jpg') }}'">
                                </td>
                                <td>
                                    <strong class="text-dark">{{ $product->name }}</strong>
                                    @if($product->description)
                                        <br><small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-label-secondary badge-status">{{ $product->condition ?? ($product->condicion ?? 'N/A') }}</span>
                                </td>
                                <td>
                                    @if(isset($product->status))
                                        @if($product->status == 'active')
                                            <span class="badge bg-label-success badge-status">Aktivan</span>
                                        @else
                                            <span class="badge bg-label-danger badge-status">Neaktivan</span>
                                        @endif
                                    @else
                                        <span class="badge bg-label-secondary badge-status">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-show me-1 text-muted"></i>
                                        <span>{{ number_format($product->views ?? 0) }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-user me-1 text-muted"></i>
                                        <span>ID: {{ $product->user_id }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-category me-1 text-muted"></i>
                                        <span>ID: {{ $product->category_id }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="#" class="btn btn-sm btn-label-primary" title="Izmeni">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovaj oglas?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-label-danger" title="Obriši">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bx bx-package fs-1 d-block mb-2"></i>
                                        <p class="mb-0">Nema oglasa</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
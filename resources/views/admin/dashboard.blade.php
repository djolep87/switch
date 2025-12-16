@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('content')
<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075), 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-2px);
        border-color: var(--bs-primary) !important;
    }
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1">Admin Dashboard</h4>
                    <p class="text-muted mb-0">Dobrodošli u admin panel. Upravljajte korisnicima, oglasima i postovima.</p>
                </div>
                <div>
                    <a href="/" class="btn btn-outline-primary">
                        <i class="bx bx-home me-1"></i>
                        Vrati se na sajt
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Users Card -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-1">Ukupno Korisnika</span>
                            <h3 class="card-title mb-2 mt-3">{{ number_format($userCount) }}</h3>
                            <small class="text-success fw-semibold">
                                <i class="bx bx-up-arrow-alt"></i> Aktivni korisnici
                            </small>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-user fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top-0">
                    <a href="/admin/users" class="btn btn-sm btn-label-primary w-100">
                        Pregled korisnika <i class="bx bx-right-arrow-alt ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Products Card -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-1">Ukupno Oglasa</span>
                            <h3 class="card-title mb-2 mt-3">{{ number_format($productCount) }}</h3>
                            <small class="text-success fw-semibold">
                                <i class="bx bx-up-arrow-alt"></i> Aktivni oglasi
                            </small>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-package fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top-0">
                    <a href="/admin/products" class="btn btn-sm btn-label-success w-100">
                        Pregled oglasa <i class="bx bx-right-arrow-alt ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Offers Card -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-1">Ukupno Ponuda</span>
                            <h3 class="card-title mb-2 mt-3">{{ number_format($offerCount) }}</h3>
                            <small class="text-warning fw-semibold">
                                <i class="bx bx-time"></i> Na čekanju
                            </small>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="bx bx-gift fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top-0">
                    <a href="javascript:void(0);" class="btn btn-sm btn-label-warning w-100">
                        Pregled ponuda <i class="bx bx-right-arrow-alt ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Posts Card -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-1">Ukupno Postova</span>
                            <h3 class="card-title mb-2 mt-3">{{ number_format($postsCount) }}</h3>
                            <small class="text-info fw-semibold">
                                <i class="bx bx-file"></i> Blog postovi
                            </small>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-info">
                                <i class="bx bx-news fs-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top-0">
                    <a href="/admin/posts" class="btn btn-sm btn-label-info w-100">
                        Pregled postova <i class="bx bx-right-arrow-alt ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Brze Akcije</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{ route('admin.users') }}" class="d-flex align-items-center p-3 border rounded text-decoration-none hover-shadow">
                                <div class="avatar avatar-md me-3">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="bx bx-user fs-4"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-dark">Korisnici</h6>
                                    <small class="text-muted">Upravljaj korisnicima</small>
                                </div>
                                <i class="bx bx-chevron-right fs-5 text-muted"></i>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{ route('admin.products') }}" class="d-flex align-items-center p-3 border rounded text-decoration-none hover-shadow">
                                <div class="avatar avatar-md me-3">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class="bx bx-package fs-4"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-dark">Oglasi</h6>
                                    <small class="text-muted">Upravljaj oglasima</small>
                                </div>
                                <i class="bx bx-chevron-right fs-5 text-muted"></i>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{ route('admin.posts.index') }}" class="d-flex align-items-center p-3 border rounded text-decoration-none hover-shadow">
                                <div class="avatar avatar-md me-3">
                                    <span class="avatar-initial rounded bg-label-info">
                                        <i class="bx bx-news fs-4"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-dark">Postovi</h6>
                                    <small class="text-muted">Upravljaj blogom</small>
                                </div>
                                <i class="bx bx-chevron-right fs-5 text-muted"></i>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{ route('admin.posts.create') }}" class="d-flex align-items-center p-3 border rounded text-decoration-none hover-shadow">
                                <div class="avatar avatar-md me-3">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <i class="bx bx-plus-circle fs-4"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-dark">Novi Post</h6>
                                    <small class="text-muted">Kreiraj novi post</small>
                                </div>
                                <i class="bx bx-chevron-right fs-5 text-muted"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity / Summary -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pregled Sistema</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Tip</th>
                                    <th>Ukupno</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-user text-primary me-2"></i>
                                            <span>Korisnici</span>
                                        </div>
                                    </td>
                                    <td><strong>{{ number_format($userCount) }}</strong></td>
                                    <td><span class="badge bg-label-success">Aktivno</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-package text-success me-2"></i>
                                            <span>Oglasi</span>
                                        </div>
                                    </td>
                                    <td><strong>{{ number_format($productCount) }}</strong></td>
                                    <td><span class="badge bg-label-success">Aktivno</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-gift text-warning me-2"></i>
                                            <span>Ponude</span>
                                        </div>
                                    </td>
                                    <td><strong>{{ number_format($offerCount) }}</strong></td>
                                    <td><span class="badge bg-label-warning">Na čekanju</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-news text-info me-2"></i>
                                            <span>Blog Postovi</span>
                                        </div>
                                    </td>
                                    <td><strong>{{ number_format($postsCount) }}</strong></td>
                                    <td><span class="badge bg-label-info">Aktivno</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informacije</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-sm me-3">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-user"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <small class="text-muted d-block">Prijavljen kao</small>
                            <strong>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</strong>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-sm me-3">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-envelope"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <small class="text-muted d-block">Email</small>
                            <strong>{{ Auth::user()->email }}</strong>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-sm me-3">
                            <span class="avatar-initial rounded bg-label-info">
                                <i class="bx bx-shield"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <small class="text-muted d-block">Uloga</small>
                            <strong>Administrator</strong>
                        </div>
                    </div>
                    <hr class="my-3">
                    <a href="/" class="btn btn-outline-primary w-100" target="_blank">
                        <i class="bx bx-globe me-1"></i>
                        Vrati se na sajt
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
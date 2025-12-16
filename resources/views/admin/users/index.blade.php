@extends('admin.layouts.app')

@section('title', 'Lista Korisnika')
@section('content')
<style>
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .badge-status {
        padding: 0.35em 0.65em;
        font-size: 0.75rem;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1">Lista Korisnika</h4>
                    <p class="text-muted mb-0">Upravljajte svim korisnicima u sistemu</p>
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
                            <span class="fw-semibold d-block mb-1 text-muted">Ukupno Korisnika</span>
                            <h3 class="card-title mb-0">{{ number_format($userCount) }}</h3>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-user fs-4"></i>
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
                            <span class="fw-semibold d-block mb-1 text-muted">Administratori</span>
                            <h3 class="card-title mb-0 text-warning">{{ number_format($adminCount) }}</h3>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="bx bx-shield fs-4"></i>
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
                            <span class="fw-semibold d-block mb-1 text-muted">Obični Korisnici</span>
                            <h3 class="card-title mb-0 text-success">{{ number_format($regularUserCount) }}</h3>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-user-circle fs-4"></i>
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
                            <span class="fw-semibold d-block mb-1 text-muted">Prihvaćeni</span>
                            <h3 class="card-title mb-0 text-info">{{ number_format($acceptedCount) }}</h3>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-info">
                                <i class="bx bx-check-circle fs-4"></i>
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
            <form method="GET" action="{{ route('admin.users') }}" id="filterForm">
                <div class="row g-3">
                    <!-- Search -->
                    <div class="col-md-5">
                        <label class="form-label">Pretraga</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" 
                                   class="form-control" 
                                   name="search" 
                                   placeholder="Pretraži po imenu, prezimenu, emailu, telefonu, gradu..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <!-- Role Filter -->
                    <div class="col-md-3">
                        <label class="form-label">Uloga</label>
                        <select class="form-select" name="role">
                            <option value="">Sve uloge</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administratori</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Obični korisnici</option>
                        </select>
                    </div>
                    
                    <!-- Status Filter -->
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Svi statusi</option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Prihvaćeni</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Na čekanju</option>
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="col-md-1 d-flex align-items-end">
                        <div class="d-flex gap-2 w-100">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="bx bx-filter"></i>
                            </button>
                            <a href="{{ route('admin.users') }}" class="btn btn-label-secondary" title="Resetuj filtere">
                                <i class="bx bx-x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Active Filters -->
    @if(request()->hasAny(['search', 'role', 'status']))
        <div class="alert alert-info d-flex align-items-center mb-3" role="alert">
            <i class="bx bx-info-circle me-2"></i>
            <div class="flex-grow-1">
                <strong>Aktivni filteri:</strong>
                @if(request('search'))
                    <span class="badge bg-label-primary me-1">Pretraga: "{{ request('search') }}"</span>
                @endif
                @if(request('role'))
                    <span class="badge bg-label-warning me-1">Uloga: {{ request('role') == 'admin' ? 'Administratori' : 'Korisnici' }}</span>
                @endif
                @if(request('status'))
                    <span class="badge bg-label-success me-1">Status: {{ request('status') == 'accepted' ? 'Prihvaćeni' : 'Na čekanju' }}</span>
                @endif
            </div>
            <a href="{{ route('admin.users') }}" class="btn btn-sm btn-label-secondary">
                <i class="bx bx-x"></i> Obriši sve
            </a>
        </div>
    @endif

    <!-- Users Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Svi Korisnici</h5>
            <div class="text-muted">
                <small>Prikazano: {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} od {{ $users->total() }}</small>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Korisnik</th>
                            <th>Email</th>
                            <th>Lokacija</th>
                            <th>Kontakt</th>
                            <th>Adresa</th>
                            <th>Status</th>
                            <th>Uloga</th>
                            <th>Akcije</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar bg-label-primary me-3">
                                            {{ strtoupper(substr($user->firstName, 0, 1) . substr($user->lastName, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong class="text-dark">{{ $user->firstName }} {{ $user->lastName }}</strong>
                                            <br>
                                            <small class="text-muted">ID: {{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-envelope me-2 text-muted"></i>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-map me-2 text-muted"></i>
                                        <div>
                                            <div>{{ $user->city }}</div>
                                            <small class="text-muted">{{ $user->country ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-phone me-2 text-muted"></i>
                                        <span>{{ $user->phone ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">{{ Str::limit($user->address ?? 'N/A', 30) }}</small>
                                </td>
                                <td>
                                    @if($user->accepted)
                                        <span class="badge bg-label-success badge-status">Prihvaćen</span>
                                    @else
                                        <span class="badge bg-label-warning badge-status">Na čekanju</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_admin)
                                        <span class="badge bg-label-warning badge-status">
                                            <i class="bx bx-shield me-1"></i>Admin
                                        </span>
                                    @else
                                        <span class="badge bg-label-secondary badge-status">
                                            <i class="bx bx-user me-1"></i>Korisnik
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="#" class="btn btn-sm btn-label-primary" title="Izmeni">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovog korisnika?');">
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
                                        <i class="bx bx-user fs-1 d-block mb-2"></i>
                                        <p class="mb-0">Nema korisnika</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($users->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
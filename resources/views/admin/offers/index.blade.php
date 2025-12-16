@extends('admin.layouts.app')

@section('title', 'Statistika Ponuda')
@section('content')
<style>
    .stat-card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 28px;
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1">Statistika Ponuda</h4>
                    <p class="text-muted mb-0">Pregled svih ponuda i njihovih statusa</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Offers -->
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-2 text-muted">Ukupno Ponuda</span>
                            <h3 class="stat-number mb-0">{{ number_format($totalOffers) }}</h3>
                            <small class="text-muted">Sve ponude u sistemu</small>
                        </div>
                        <div class="stat-icon bg-label-primary">
                            <i class="bx bx-gift text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Offers -->
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-2 text-muted">Na Čekanju</span>
                            <h3 class="stat-number mb-0 text-warning">{{ number_format($pendingOffers) }}</h3>
                            <small class="text-muted">Čekaju odgovor</small>
                        </div>
                        <div class="stat-icon bg-label-warning">
                            <i class="bx bx-time text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accepted Offers -->
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-2 text-muted">Prihvaćene</span>
                            <h3 class="stat-number mb-0 text-success">{{ number_format($acceptedOffers) }}</h3>
                            <small class="text-muted">Prihvaćene ponude</small>
                        </div>
                        <div class="stat-icon bg-label-success">
                            <i class="bx bx-check-circle text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejected Offers -->
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-2 text-muted">Odbijene</span>
                            <h3 class="stat-number mb-0 text-danger">{{ number_format($rejectedOffers) }}</h3>
                            <small class="text-muted">Odbijene ponude</small>
                        </div>
                        <div class="stat-icon bg-label-danger">
                            <i class="bx bx-x-circle text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Successful Offers -->
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-2 text-muted">Uspešne</span>
                            <h3 class="stat-number mb-0 text-success">{{ number_format($successfulOffers) }}</h3>
                            <small class="text-muted">Uspešno završene</small>
                        </div>
                        <div class="stat-icon bg-label-success">
                            <i class="bx bx-check-double text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unsuccessful Offers -->
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <span class="fw-semibold d-block mb-2 text-muted">Neuspešne</span>
                            <h3 class="stat-number mb-0 text-danger">{{ number_format($unsuccessfulOffers) }}</h3>
                            <small class="text-muted">Otkazane ponude</small>
                        </div>
                        <div class="stat-icon bg-label-danger">
                            <i class="bx bx-x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Statistics Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detaljna Statistika</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Broj Ponuda</th>
                                    <th>Procenat</th>
                                    <th>Opis</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-label-primary me-2">
                                                <i class="bx bx-gift"></i>
                                            </span>
                                            <strong>Ukupno Ponuda</strong>
                                        </div>
                                    </td>
                                    <td><strong class="text-primary">{{ number_format($totalOffers) }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                            </div>
                                            <span class="text-muted">100%</span>
                                        </div>
                                    </td>
                                    <td><small class="text-muted">Sve ponude u sistemu</small></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-label-warning me-2">
                                                <i class="bx bx-time"></i>
                                            </span>
                                            <strong>Na Čekanju</strong>
                                        </div>
                                    </td>
                                    <td><strong class="text-warning">{{ number_format($pendingOffers) }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $totalOffers > 0 ? ($pendingOffers / $totalOffers * 100) : 0 }}%"></div>
                                            </div>
                                            <span class="text-muted">{{ $totalOffers > 0 ? number_format(($pendingOffers / $totalOffers * 100), 1) : 0 }}%</span>
                                        </div>
                                    </td>
                                    <td><small class="text-muted">Čekaju odgovor korisnika</small></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-label-success me-2">
                                                <i class="bx bx-check-circle"></i>
                                            </span>
                                            <strong>Prihvaćene</strong>
                                        </div>
                                    </td>
                                    <td><strong class="text-success">{{ number_format($acceptedOffers) }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $totalOffers > 0 ? ($acceptedOffers / $totalOffers * 100) : 0 }}%"></div>
                                            </div>
                                            <span class="text-muted">{{ $totalOffers > 0 ? number_format(($acceptedOffers / $totalOffers * 100), 1) : 0 }}%</span>
                                        </div>
                                    </td>
                                    <td><small class="text-muted">Prihvaćene od strane korisnika</small></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-label-danger me-2">
                                                <i class="bx bx-x-circle"></i>
                                            </span>
                                            <strong>Odbijene</strong>
                                        </div>
                                    </td>
                                    <td><strong class="text-danger">{{ number_format($rejectedOffers) }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $totalOffers > 0 ? ($rejectedOffers / $totalOffers * 100) : 0 }}%"></div>
                                            </div>
                                            <span class="text-muted">{{ $totalOffers > 0 ? number_format(($rejectedOffers / $totalOffers * 100), 1) : 0 }}%</span>
                                        </div>
                                    </td>
                                    <td><small class="text-muted">Odbijene od strane korisnika</small></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-label-success me-2">
                                                <i class="bx bx-check-double"></i>
                                            </span>
                                            <strong>Uspešne</strong>
                                        </div>
                                    </td>
                                    <td><strong class="text-success">{{ number_format($successfulOffers) }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $totalOffers > 0 ? ($successfulOffers / $totalOffers * 100) : 0 }}%"></div>
                                            </div>
                                            <span class="text-muted">{{ $totalOffers > 0 ? number_format(($successfulOffers / $totalOffers * 100), 1) : 0 }}%</span>
                                        </div>
                                    </td>
                                    <td><small class="text-muted">Uspešno završene zamene</small></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-label-danger me-2">
                                                <i class="bx bx-x"></i>
                                            </span>
                                            <strong>Neuspešne</strong>
                                        </div>
                                    </td>
                                    <td><strong class="text-danger">{{ number_format($unsuccessfulOffers) }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $totalOffers > 0 ? ($unsuccessfulOffers / $totalOffers * 100) : 0 }}%"></div>
                                            </div>
                                            <span class="text-muted">{{ $totalOffers > 0 ? number_format(($unsuccessfulOffers / $totalOffers * 100), 1) : 0 }}%</span>
                                        </div>
                                    </td>
                                    <td><small class="text-muted">Otkazane zamene</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Card -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Rezime</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <div class="avatar avatar-md me-3">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class="bx bx-trending-up fs-4"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0">Stopa Uspeha</h6>
                                    <p class="mb-0 text-muted">
                                        @if($totalOffers > 0)
                                            {{ number_format(($successfulOffers / $totalOffers * 100), 2) }}%
                                        @else
                                            0%
                                        @endif
                                        <small>({{ $successfulOffers }} od {{ $totalOffers }})</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <div class="avatar avatar-md me-3">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="bx bx-pie-chart-alt-2 fs-4"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0">Aktivne Ponude</h6>
                                    <p class="mb-0 text-muted">
                                        {{ number_format($pendingOffers + $acceptedOffers) }}
                                        <small>(Na čekanju + Prihvaćene)</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


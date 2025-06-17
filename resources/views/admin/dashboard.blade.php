@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Admin Dashboard</h4>
                </div>
                <div class="card-header">
                    <a href="/">Vrati se na sajt</a>
                </div>
                <div class="card-body">
                    <p>Welcome to the admin dashboard!</p>
                    <p>You can manage users, view reports, and perform administrative tasks here.</p>
                  <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1">
                        <div class="col">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div>
                                        <h4 class="header-title">Total Users</h4>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle drop-arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="/admin/users" class="dropdown-item">Users list</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Revenue Analysis</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="card-body pt-0">
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <span class="badge bg-primary rounded-pill fs-13">45% <i class="ti ti-trending-up"></i> </span>
                                        <div class="text-end">
                                            <h3 class="fw-semibold">{{$users->count()}}</h3>
                                            <p class="text-muted mb-0">Since last month</p>
                                        </div>
                                    </div>
                    
                                    <div class="progress progress-soft progress-sm mt-3">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    
                        <div class="col">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div>
                                        <h4 class="header-title">Total Advertisement</h4>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle drop-arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="/admin/products" class="dropdown-item">Add List</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Revenue Analysis</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="card-body pt-0">
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <span class="badge bg-success rounded-pill fs-13">28% <i class="ti ti-trending-up"></i> </span>
                                        <div class="text-end">
                                            <h3 class="fw-semibold">{{$products->count()}}</h3>
                                            <p class="text-muted mb-0">Since last month</p>
                                        </div>
                                    </div>
                    
                                    <div class="progress progress-soft progress-sm mt-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    
                        <div class="col">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div>
                                        <h4 class="header-title">Offers</h4>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle drop-arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">Customer Insights</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Export Data</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Retention Rate</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="card-body pt-0">
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <span class="badge bg-warning rounded-pill fs-13">18% <i class="ti ti-trending-up"></i> </span>
                                        <div class="text-end">
                                            <h3 class="fw-semibold">{{$offers->count()}}</h3>
                                            <p class="text-muted mb-0">Since last month</p>
                                        </div>
                                    </div>
                    
                                    <div class="progress progress-soft progress-sm mt-3">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 18%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    
                        <div class="col">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div>
                                        <h4 class="header-title">Total Posts</h4>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle drop-arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="/admin/posts" class="dropdown-item">Posts list</a>
                                            <a href="/admin/posts/create" class="dropdown-item">Create Post</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Improve Rate</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="card-body pt-0">
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <span class="badge bg-info rounded-pill fs-13">3.2% <i class="ti ti-trending-down"></i> </span>
                                        <div class="text-end">
                                            <h3 class="fw-semibold">{{$posts->count()}}</h3>
                                            <p class="text-muted mb-0">Since last month</p>
                                        </div>
                                    </div>
                    
                                    <div class="progress progress-soft progress-sm mt-3">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 7.5%" aria-valuenow="7.5" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                                            <div class="col">
                                                <div class="d-flex justify-content-between align-items-center p-1">
                                                    <div>
                                                        <i class="ri-circle-fill fs-12 align-middle me-1 text-primary"></i>
                                                        <span class="align-middle fw-semibold">Direct</span>
                                                    </div>
                                                    <span class="fw-semibold text-muted float-end"><i class="ri-arrow-down-s-fill text-danger"></i> 965</span>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center p-1">
                                                    <div>
                                                        <i class="ri-circle-fill fs-12 text-secondary align-middle me-1"></i>
                                                        <span class="align-middle fw-semibold">Social</span>
                                                    </div>
                                                    <span class="fw-semibold text-muted float-end"><i class="ri-arrow-up-s-fill text-success"></i> 75</span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="d-flex justify-content-between align-items-center p-1">
                                                    <div>
                                                        <i class="ri-circle-fill fs-12 text-success align-middle me-1"></i>
                                                        <span class="align-middle fw-semibold"> Marketing</span>
                                                    </div>
                                                    <span class="fw-semibold text-muted float-end"><i class="ri-arrow-up-s-fill text-success"></i> 102</span>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center p-1">
                                                    <div>
                                                        <i class="ri-circle-fill fs-12 text-info align-middle me-1"></i>
                                                        <span class="align-middle fw-semibold">Affiliates</span>
                                                    </div>
                                                    <span class="fw-semibold text-muted float-end"><i class="ri-arrow-down-s-fill text-danger"></i> 96</span>
                                                </div>
                                            </div>
                                        </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.master')

@section('title', 'Ulogujte se')

@section('content')
<div class="wrapper">
   <div class="container">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="row row-cols-1 row-cols-xl-2">
            <div class="col mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="text-center">
                                <h3 class="">Ulogujte se</h3>
                                <p>Jos uvek nemate nalog? <a href="/register">Kreirajte nalog ovde</a>
                                </p>
                            </div>
                            {{-- <div class="d-grid">
                                <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                                    <img class="me-2" src="assets/images/icons/search.svg" width="16" alt="Image Description">
                                    <span>Ulogujte se preko Google-a</span>
                                    </span>
                                </a> <a href="javascript:;" class="btn btn-white"><i class="bx bxl-facebook"></i>Ulogujte se preko Facebook-a</a>
                            </div>
                            <div class="login-separater text-center mb-4"> <span>ILI ULOGUJTE SE PREKO EMAIL-a</span>
                                <hr/>
                            </div> --}}
                            <div class="form-body">
                                <form method="POST" action="{{ route('login') }}" class="row g-3">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email Adresa</label>
                                        <input type="email" class="form-control" name="email" id="inputEmailAddress" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Adresa">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Lozinka</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" required autocomplete="current-password" placeholder="Lozinka">
                                            <a href="javascript:;" class="input-group-text bg-transparent" id="togglePassword">
                                                <i class='bx bx-hide' id="toggleIcon"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Zapamti me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Zaboravili ste lozinku ?</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>{{ __('Ulogujte se') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div> 
</div>


@endsection

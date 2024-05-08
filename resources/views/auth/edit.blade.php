@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <section class="py-0 py-lg-5">
            <div class="container">
                <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">                        
                        <div class="col mx-auto">
                            <div class="card mb-0">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Izmeni podatke</h3>                                           
                                        </div>
                                        {{-- <div class="d-grid">
                                            <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                                                <img class="me-2" src="assets/images/icons/search.svg" width="16" alt="Image Description">
                                                <span>Registrujte se preko Google-a</span>
                                                </span>
                                            </a> <a href="javascript:;" class="btn btn-white"><i class="bx bxl-facebook"></i>Registrujte se preko Facebook-a</a>
                                        </div>
                                        <div class="login-separater text-center mb-4"> <span>ILI REGISTRUJTE SE PREKO EMAIL-a</span>
                                            <hr/>
                                        </div> --}}
                                        <div class="form-body">
                                            <form class="row g-3" method="POST" action="{{ route('user.update', ['id' => auth()->user()->id]) }}">
                                                @csrf
                                                <div class="col-sm-6">
                                                    <label for="inputFirstName" class="form-label">Ime</label>
                                                    <input type="text" name="firstName" class="form-control" id="inputFirstName" required placeholder="Ime" value="{{ auth()->user()->firstName }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="inputLastName" class="form-label">Prezime</label>
                                                    <input type="text" name="lastName" class="form-control" id="inputLastName" required placeholder="Prezime" value="{{ auth()->user()->lastName }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email Adresa</label>
                                                    <input type="email" name="email" class="form-control" id="Email Adresa" required placeholder="example@user.com" value="{{ auth()->user()->email }}">
                                                </div>
                                                {{-- <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Lozinka</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" name="password" required class="form-control border-end-0" id="inputChoosePassword" placeholder="Lozinka" value="{{ old('password') }}"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Potvrdi lozinku</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" name="password_confirmation" required class="form-control border-end-0" id="inputChoosePassword" placeholder="Lozinka" value="{{ old('password_confirmation') }}"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                    </div>
                                                </div> --}}
                                                <div class="col-12">
                                                    <label for="country" class="form-label">Zemlja</label>
                                                    <select class="form-select" id="inputSelectCountry" name="country" aria-label="Default select example">
                                                        <option selected>Srbija</option>
                                                        {{-- <option value="1">United Kingdom</option>
                                                        <option value="2">America</option>
                                                        <option value="3">Dubai</option> --}}
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label for="city" class="form-label">Grad</label>
                                                    <input type="text" name="city" class="form-control" id="city" required placeholder="Grad" value="{{ auth()->user()->city }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="address" class="form-label">Adresa</label>
                                                    <input type="text" name="address" class="form-control" required id="address" placeholder="Adresa" value="{{ auth()->user()->address }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="phone" class="form-label">Telefon</label>
                                                    <input type="text" name="phone" class="form-control" id="phone" required placeholder="Telefon" value="{{ auth()->user()->phone }}">
                                                </div>                                                
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-dark"><i class='bx bx-user'></i>{{ __('Izmeni') }}</button>
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
        </section>
        <!--end shop cart-->
    </div>
</div>

@endsection
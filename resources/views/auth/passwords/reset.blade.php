@extends('layouts.master')
@section('title', 'Resetovanje Lozinke')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Resetovanje Lozinke') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Adresa') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                      {{-- <div class="row mb-3">
                            <label for="inputChoosePassword" class="col-md-4 col-form-label text-md-end">Lozinka</label>
                            <div class="col-md-6" id="show_hide_password1">
                                <input type="password" name="password" required class="form-control border-end-0" id="inputChoosePassword1" placeholder="Lozinka" value="{{ old('password') }}">
                                <a href="javascript:;" class="input-group-text bg-transparent" id="togglePassword1">
                                    <i class='bx bx-hide' id="toggleIcon1"></i>
                                </a>
                            </div>
                            @error('password')
                                <div class="alert alert-warning py-2 px-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="inputConfirmPassword" class="col-md-4 col-form-label text-md-end">Potvrdi lozinku</label>
                            <div class="col-md-6" id="show_hide_password2">
                                <input type="password" name="password_confirmation" required class="form-control border-end-0" id="inputConfirmPassword" placeholder="Potvrdi lozinku" value="{{ old('password_confirmation') }}">
                                <a href="javascript:;" class="input-group-text bg-transparent" id="togglePassword2">
                                    <i class='bx bx-hide' id="toggleIcon2"></i>
                                </a>
                            </div>
                            @error('password')
                                <div class="alert alert-warning py-2 px-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}

                        <div class="row mb-3">
                            <label for="inputChoosePassword" class="col-md-4 col-form-label text-md-end">Lozinka</label>
                            <div class="col-md-6 position-relative">
                                <input type="password" name="password" required  class="form-control pr-5"  id="inputChoosePassword1"  placeholder="Lozinka"  value="{{ old('password') }}">

                                <span class="position-absolute"  style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"  id="togglePassword1">
                                    <i class='bx bx-hide' id="toggleIcon1"></i>
                                </span>
                                <div class="col-12">
                                    @error('password')
                                        <div class="alert alert-warning ">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputConfirmPassword" class="col-md-4 col-form-label text-md-end">Potvrdi lozinku</label>
                            <div class="col-md-6 position-relative">
                                <input type="password" name="password_confirmation" required class="form-control pr-5" id="inputConfirmPassword" placeholder="Potvrdi lozinku" value="{{ old('password_confirmation') }}" style="padding-right: 2.5rem;">

                                <span  class="position-absolute"  style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"  id="togglePassword2">
                                    <i class='bx bx-hide' id="toggleIcon2"></i>
                                </span>
                                <div class="col-12">
                                    @error('password')
                                        <div class="alert alert-warning">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Resetuj Lozinku') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


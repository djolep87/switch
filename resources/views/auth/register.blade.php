@extends('layouts.master')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="page-wrapper">
    <div class="page-content">
        <section class="py-0 py-lg-5">
            <div class="container">
                <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
                        <div class="col mx-auto">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Registrujte se</h3>
                                            <p>Imate nalog? <a href="/login">Ulogujte se ovde</a>
                                            </p>
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
                                            <form class="row g-3" method="POST" action="{{ route('register') }}">
                                                @csrf
                                                <div class="col-sm-6">
                                                    <label for="inputFirstName" class="form-label">Ime</label>
                                                    <input type="text" name="firstName" class="form-control" id="inputFirstName" required placeholder="Ime" value="{{ old('firstName') }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="inputLastName" class="form-label">Prezime</label>
                                                    <input type="text" name="lastName" class="form-control" id="inputLastName" required placeholder="Prezime" value="{{ old('lastName') }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email Adresa</label>
                                                    <input type="email" name="email" class="form-control" id="Email Adresa" required placeholder="example@user.com" value="{{ old('email') }}">
                                                </div>
                                                @error('email')
                                                    <div class="alert alert-warning mt-2">
                                                        {{ $message }} <br>
                                                        <small>Već imate nalog? <a href="{{ route('login') }}" class="text-decoration-underline">Ulogujte se ovde</a>.</small>
                                                    </div>
                                                @enderror
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Lozinka</label>
                                                    <div class="input-group" id="show_hide_password1">
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
                                                <div class="col-12">
                                                    <label for="inputConfirmPassword" class="form-label">Potvrdi lozinku</label>
                                                    <div class="input-group" id="show_hide_password2">
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
                                                </div>
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
                                                    <input type="text" name="city" class="form-control" id="city" required placeholder="Grad" value="{{ old('city') }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="address" class="form-label">Adresa</label>
                                                    <input type="text" name="address" class="form-control" required id="address" placeholder="Adresa" value="{{ old('address') }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="phone" class="form-label">Telefon</label>
                                                    <input type="text" name="phone" class="form-control" id="phone" required placeholder="Telefon" value="{{ old('phone') }}">
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" name="accepted" type="checkbox" id="flexSwitchCheckChecked" required value="1">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">
                                                            <a href="/uslovi">Slažem se sa uslovima korišćenja</a>
                                                            <span id="termsWarning" class="terms-warning" style="display: none;">
                                                                <i class="bx bx-error-circle ms-2" title="Morate ponovo potvrditi uslove korišćenja"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-dark"><i class='bx bx-user'></i>{{ __('Registruj se') }}</button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const termsCheckbox = document.getElementById('flexSwitchCheckChecked');
    const termsWarning = document.getElementById('termsWarning');
    
    // Check if the form was reloaded due to validation errors
    // This happens when there are old() values or validation errors
    const hasOldValues = {{ json_encode(old()) ? 'true' : 'false' }};
    const hasValidationErrors = {{ json_encode($errors->any()) ? 'true' : 'false' }};
    
    // Show warning if form was reloaded and checkbox is not checked
    if ((hasOldValues || hasValidationErrors) && !termsCheckbox.checked) {
        termsWarning.style.display = 'inline';
    }
    
    // Hide warning when user checks the checkbox
    termsCheckbox.addEventListener('change', function() {
        if (this.checked) {
            termsWarning.style.display = 'none';
        } else if (hasOldValues || hasValidationErrors) {
            termsWarning.style.display = 'inline';
        }
    });
    
    // Show warning when form is submitted but checkbox is not checked
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        if (!termsCheckbox.checked) {
            e.preventDefault();
            termsWarning.style.display = 'inline';
            termsCheckbox.focus();
        }
    });
});
</script>

<style>
.terms-warning {
    animation: pulse 1.5s infinite;
    display: inline-block;
}

@keyframes pulse {
    0% { 
        opacity: 1; 
        transform: scale(1);
    }
    50% { 
        opacity: 0.7; 
        transform: scale(1.1);
    }
    100% { 
        opacity: 1; 
        transform: scale(1);
    }
}

.terms-warning i {
    font-size: 24px;
    vertical-align: middle;
    color: #dc3545 !important;
    text-shadow: 2px 2px 4px rgba(220, 53, 69, 0.5);
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    transition: all 0.3s ease;
}

.terms-warning:hover i {
    transform: scale(1.1);
    text-shadow: 3px 3px 6px rgba(220, 53, 69, 0.7);
}
</style>



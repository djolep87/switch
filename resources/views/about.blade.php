@extends('layouts.master')

@section('title', 'O nama')

@section('content')

<section class="py-5 bg-light border-bottom">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5">Dobrodošli na <span class="text-primary">Trange Frange</span></h1>
            <p class="lead text-muted">Mesto gde stvari dobijaju drugu šansu, a ljudi prave pozitivnu razliku!</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <p class="fs-5">Trange Frange je online platforma za razmenu, poklanjanje i ponovno korišćenje predmeta. Naša zajednica okuplja ljude koji žele da štede novac, čuvaju prirodu i grade održivu budućnost.</p>
                <p class="fs-5">Umesto da bacate stvari koje vam više ne trebaju, delite ih sa onima kojima mogu koristiti. Bilo da je u pitanju garderoba, knjige, nameštaj, dečije stvari ili tehnologija – sve može dobiti novu svrhu.</p>
                <p class="fs-5">Naša platforma funkcioniše lako i sigurno: objavite oglas, pronađite osobu za razmenu i dogovorite preuzimanje – bez stresa, bez troškova, bez gubljenja vremena.</p>
                <p class="fs-5">Pridruživanjem Trange Frange zajednici postajete deo šire misije za bolji svet. Svaka vaša razmena doprinosi manjoj potrošnji i većoj solidarnosti među ljudima.</p>

                <div class="text-center mt-5">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4">Pridruži se odmah</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold">Šta sve možeš da razmeniš?</h3>
            <p class="text-muted">Na Trange Frange, mogućnosti su neograničene. Razmeni ili pokloni:</p>
        </div>

        <div class="row g-4 text-center">
            <div class="col-6 col-md-4 col-lg-3">
                <i class="bx bxs-t-shirt fs-1 text-primary mb-2"></i>
                <p class="fw-semibold">Garderoba</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <i class="bx bx-book fs-1 text-primary mb-2"></i>
                <p class="fw-semibold">Knjige</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <i class="bx bx-laptop fs-1 text-primary mb-2"></i>
                <p class="fw-semibold">Tehnologija</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <i class="bx bxs-bed fs-1 text-primary mb-2"></i>
                <p class="fw-semibold">Nameštaj</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <i class="bx bxs-baby-carriage fs-1 text-primary mb-2"></i>
                <p class="fw-semibold">Dečija oprema</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <i class="bx bx-football fs-1 text-primary mb-2"></i>
                <p class="fw-semibold">Sport i hobiji</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <i class="bx bx-home-alt fs-1 text-primary mb-2"></i>
                <p class="fw-semibold">Sitnice za kuću</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <i class="bx bx-dots-horizontal-rounded fs-1 text-primary mb-2"></i>
                <p class="fw-semibold">I još mnogo toga...</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold">Zašto baš Trange Frange?</h3>
            <hr class="mx-auto" style="width: 100px; height: 3px; background-color: #0d6efd; border: none;">
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow h-100 text-center p-4">
                    <img src="{{ asset('assets/images/icons/save.png') }}" alt="Održivost" width="60" class="mx-auto mb-3">
                    <h5 class="fw-semibold">Održivost na prvom mestu</h5>
                    <p class="text-muted small">Svaka razmena smanjuje količinu otpada i štedi resurse. Pravi korak ka zelenijoj budućnosti.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow h-100 text-center p-4">
                    <img src="{{ asset('assets/images/icons/trade.png') }}" alt="Razmena" width="60" class="mx-auto mb-3">
                    <h5 class="fw-semibold">Jednostavna i brza razmena</h5>
                    <p class="text-muted small">Objavi oglas za minut i pronađi osobu sa kojom možeš da razmeniš ili pokloniš stvari.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow h-100 text-center p-4">
                    <img src="{{ asset('assets/images/icons/community.png') }}" alt="Zajednica" width="60" class="mx-auto mb-3">
                    <h5 class="fw-semibold">Zajednica istomišljenika</h5>
                    <p class="text-muted small">Poveži se sa ljudima koji dele iste vrednosti, učestvuj u događajima i širi dobru energiju.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



{{-- <section class="py-5 bg-light border-bottom">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Dobrodošli na <span class="text-primary">Trange Frange!</span></h2>
            <p class="lead mt-3">Zajedno stvaramo održiviji svet – jedan predmet po jedan!</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <p class="fs-5">Trange Frange je platforma za razmenu i poklanjanje stvari koje vam više nisu potrebne. Umesto da bacate, pronađite ono što vam treba, iz udobnosti svog doma.</p>
                <p class="fs-5">Verujemo da svaki predmet zaslužuje drugu šansu – od garderobe do tehnike i nameštaja. Štedite novac, čuvajte resurse, i budite deo zajednice koja brine o planeti.</p>
                <p class="fs-5">Naša misija je jednostavna – da promovišemo održivost, olakšamo razmenu, i gradimo zajednicu sličnih vrednosti.</p>
                <p class="fs-5">Pridružite nam se danas i budite deo pozitivne promene. Hvala vam što zajedno s nama gradite održiviju budućnost!</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold text-dark">Zašto baš Trange Frange?</h3>
            <hr class="mx-auto" style="width: 100px; height: 3px; background-color: #0d6efd; border: none;">
        </div>

        <div class="row g-4">
            <!-- Kartica 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow h-100 text-center p-4">
                    <img src="{{ asset('assets/images/icons/save.png') }}" alt="Održivost" width="60" class="mx-auto mb-3">
                    <h5 class="fw-semibold mb-2">Održivost na prvom mestu</h5>
                    <p class="small text-muted">Doprinesite očuvanju planete deljenjem i ponovnim korišćenjem stvari. Smanjujemo otpad i štitimo resurse zajedno.</p>
                </div>
            </div>

            <!-- Kartica 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow h-100 text-center p-4">
                    <img src="{{ asset('assets/images/icons/trade.png') }}" alt="Razmena" width="60" class="mx-auto mb-3">
                    <h5 class="fw-semibold mb-2">Jednostavna i pouzdana razmena</h5>
                    <p class="small text-muted">Bezbedno razmenjujte ili poklanjajte stvari sa drugim korisnicima – brzo, lako i bez stresa.</p>
                </div>
            </div>

            <!-- Kartica 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow h-100 text-center p-4">
                    <img src="{{ asset('assets/images/icons/community.png') }}" alt="Zajednica" width="60" class="mx-auto mb-3">
                    <h5 class="fw-semibold mb-2">Zajednica istomišljenika</h5>
                    <p class="small text-muted">Upoznajte ljude koji dele iste vrednosti, razmenite iskustva i zajedno radimo na pozitivnim promenama.</p>
                </div>
            </div>
        </div>
    </div>
</section> --}}
{{-- <section class="py-4">
    <div class="container">
        <h4>Our Top Brands</h4>
        <hr>
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-cols-xl-5 g-4">
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/01.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/02.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/03.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/04.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/05.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/06.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/07.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/08.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/09.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/10.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/11.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/12.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/13.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/14.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border shadow-none">
                    <div class="card-body">
                        <a href="javscript:;">
                            <img src="assets/images/brands/15.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

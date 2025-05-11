@extends('layouts.master')

@section('title', 'Razmena')

@section('content')
<div class="container py-5">
    <h1 class="mb-5 text-center">Kako funkcioniše razmena na Trange Frange?</h1>

    <!-- Korak 1 -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h2 class="mb-3">1. Pronađite oglas koji vam se dopada</h2>
            <p class="lead">Na Trange Frange možete lako pronaći ono što vam treba. Koristite pretragu, filtrirajte po kategorijama i lokaciji.</p>
            <ul>
                <li>✅ Izaberite predmet koji vam odgovara</li>
                <li>✅ Pogledajte detaljan opis i slike</li>
            </ul>
        </div>
        <div class="col-lg-6 text-center">
            <img src="/assets/images/razmena/razmenah.png" width="300px" alt="Pronađi oglas" class="img-fluid rounded " style="border: 10px solid white;">
        </div>
    </div>

    <!-- Korak 2 -->
    <div class="row align-items-center mb-5 flex-lg-row-reverse">
        <div class="col-lg-6">
            <h2 class="mb-3">2. Pošaljite zahtev za razmenu</h2>
            <p class="lead">Kada pronađete oglas koji vam se sviđa, kliknite na dugme <strong>POŠALJI ZAHTEV</strong>. Unesite koji predmet nudite zauzvrat i pošaljite.</p>
            <p>Korisnik će dobiti obaveštenje i moći da prihvati ili odbije vašu ponudu.</p>
        </div>
        <div class="col-lg-6 text-center">
            <img src="/assets/images/razmena/razmena.png" width="300px" alt="Pošalji zahtev" class="img-fluid rounded " style="border: 10px solid white;">
        </div>
    </div>

    <!-- Korak 3 -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h2 class="mb-3">3. Pratite svoje zahteve i ponude</h2>
            <p class="lead">U svom profilu možete pratiti sve što ste poslali i primili.</p>
            <h5>Zahtevi</h5>
            <p>Pratite koje ste zahteve poslali i koji su prihvaćeni ili odbijeni.</p>
            <h5>Ponude</h5>
            <p>Pogledajte šta drugi nude za vaše oglase i odlučite da li vam odgovara.</p>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-6 text-center">
                    <img src="/assets/images/razmena/razmena3.1.png" width="300px" alt="Zahtevi i ponude" class="img-fluid rounded " style="border: 10px solid white;">
                </div>
                <div class="col-6 text-center">
                    <img src="/assets/images/razmena/razmena3.png" width="300px" alt="Zahtevi i ponude" class="img-fluid rounded " style="border: 10px solid white;">
                </div> 
            </div>
        </div>
    </div>

    <!-- Korak 4 -->
    <div class="row align-items-center mb-5 flex-lg-row-reverse">
        <div class="col-lg-6">
            <h2 class="mb-3">4. Razmena je dogovorena</h2>
            <p class="lead">Kada se obe strane slože, razmena se može realizovati.</p>
            <p>Nakon prihvatanja, videćete broj telefona korisnika. Kontaktirajte se i dogovorite sve detalje – vreme, mesto, način razmene.</p>
        </div>
        <div class="col-lg-6 text-center">
            <img src="/assets/images/razmena/razmena4.png" width="300px" alt="Dogovor" class="img-fluid rounded " style="border: 10px solid white;">
        </div>
    </div>

    <!-- Korak 5 -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h2 class="mb-3">5. Ocenjivanje nakon razmene</h2>
            <p class="lead">Nakon uspešne razmene, možete oceniti korisnika i ostaviti kratak komentar o iskustvu.</p>
            <p>Ocene grade poverenje i sigurnost na platformi.</p>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-6 text-center">
                    <img src="/assets/images/razmena/razmena5.png" width="300px" alt="Ocena" class="img-fluid rounded " style="border: 10px solid white;">
                </div>
                <div class="col-6 text-center">
                    <img src="/assets/images/razmena/razmena6.png" width="300px" alt="Ocena 2" class="img-fluid rounded " style="border: 10px solid white;">
                </div>
            </div>
        </div>
    </div>

    <!-- Korak 6 -->
    <div class="row align-items-center mb-5 flex-lg-row-reverse">
        <div class="col-lg-6">
            <h2 class="mb-3">6. Neuspešna razmena</h2>
            <p class="lead">Ako razmena nije realizovana, označite je kao neuspešnu kako bi vaši oglasi bili ponovo aktivni.</p>
            <p>Ako je razlog nepoštovanje dogovora, možete dodeliti negativnu ocenu.</p>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-6 text-center">
                    <img src="/assets/images/razmena/razmena7.png" width="300px" alt="Neuspešna razmena" class="img-fluid rounded " style="border: 10px solid white;">
                    
                </div>
                <div class="col-6 text-center">
                    <img src="/assets/images/razmena/razmena8.png" width="300px" alt="Neuspešna razmena" class="img-fluid rounded " style="border: 10px solid white;">
                </div>
            </div>
        </div>
    </div>

    <!-- Zaključak -->
    <div class="text-center">
        <h2 class="mb-3">Pametna razmena – Pametan izbor</h2>
        <p class="lead">Na <strong>Trange Frange</strong> razmena nije samo praktična – ona je i ekološki odgovorna.</p>
        <p>Produžavanjem veka trajanja stvarima, zajedno štedimo resurse, smanjujemo otpad i doprinosimo očuvanju planete.</p>
        <p>Registrujte se danas i postanite deo zajednice koja razmenjuje pametno!</p>
    </div>
</div>
@endsection
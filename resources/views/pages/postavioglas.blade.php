@extends('layouts.master')

@section('title', 'Postavi oglas')

@section('content')
    <!--wrapper-->
	<div class="wrapper">
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--start page content-->
				<section class="py-0 py-lg-4">
					<div class="container">
						<h4>Kako postaviti oglas</h4>
                        <div class="row">
                            <!-- Leva kolona -->
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <h1>Kako postaviti oglas?</h1>
                                    <p>Postavljanje oglasa na naš sajt je brzo i jednostavno. U samo nekoliko koraka možete besplatno objaviti svoj oglas i omogućiti drugima da ga vide.</p>

                                    <h2>Koraci za postavljanje oglasa:</h2>
                                    <ul>
                                        <li><span class="highlight">Registracija ili prijava:</span> Da biste postavili oglas, potrebno je da budete registrovani korisnik. Ako već imate nalog, jednostavno se prijavite.</li>
                                        <li><span class="highlight">Popunjavanje forme za oglas:</span> Kliknite na "Postavi oglas" i popunite neophodne informacije:
                                            <ul>
                                                <li><strong>Naziv proizvoda:</strong> Kratak i jasan naziv.</li>
                                                <li><strong>Stanje:</strong> Opis da li je vaš oglas nov ili polovan.</li>
                                                <li><strong>Kategorija:</strong> Izaberite odgovarajuću kategoriju.</li>
                                                <li><strong>Opis:</strong> Detaljan opis predmeta.</li>
                                                <li><strong>Dodavanje slika:</strong> Kvalitetne fotografije povećavaju šanse za uspešnu prodaju.</li>
                                                <li><strong>Provera i objavljivanje:</strong> Pregledajte oglas i kliknite "Sačuvaj".</li>
                                            </ul>
                                        </li>
                                    </ul>
                                    
                                    <h2>Zašto postaviti oglas kod nas?</h2>
                                    <ul>
                                        <li><strong>✔ Besplatno postavljanje oglasa</strong></li>
                                        <li><strong>✔ Brza i jednostavna procedura</strong></li>
                                        <li><strong>✔ Veliki broj posetilaca</strong></li>
                                        <li><strong>✔ Mogućnost uređivanja oglasa</strong></li>
                                    </ul>
                                    
                                    <p><strong>Ne čekajte – postavite svoj oglas već danas i pronađite idealnu stvar za vas!</strong> 🚀</p>
                                </div>
                            </div>

                            <!-- Desna kolona -->
                            <div class="col-lg-6 text-center">
                                <img src="{{ asset('assets/images/how/screen2.jpg') }}" alt="Postavi oglas" width="100%" class="img-fluid ">
                            </div>
                        </div>
                    </div>
				</section>

				<!--end start page content-->
			</div>
		</div>
		<!--end page wrapper -->

		<!--Start Back To Top Button-->
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
	</div>
	<!--end wrapper-->
@endsection
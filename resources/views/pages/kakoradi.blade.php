@extends('layouts.master')
@section('title', 'Kako radi')

@section('content')
    	<!--wrapper-->
		<div class="wrapper">
			<!--start page wrapper -->
			<div class="page-wrapper">
				<div class="page-content">
					<!--start page content-->
					<section class="py-0 py-lg-4">
						<div class="container">
							<div class="row align-items-center">
								<div class="col-md-6">
									<h1 class="mb-3">Pravila i uputstva o platformi</h1>
									<p class="lead">Trange Frange se razlikuje od klasičnih sajtova za kupovinu. Kod nas razmenjujete stvari!</p>
									<p>Da biste učestvovali u razmeni, potrebno je da postavite oglas – to je vaš "token" za razmenu. Kada vam se nešto dopadne, možete poslati ponudu, a istovremeno ćete i vi dobijati ponude za svoj oglas. Sami odlučujete da li ćete neku ponudu prihvatiti.</p>
									<ul>
										<li>✔ Postavite oglas sa slikama i opisom</li>
										<li>✔ Pretražujte oglase drugih korisnika</li>
										<li>✔ Pošaljite ponudu za ono što želite</li>
										<li>✔ Prihvatite ili odbijte ponude koje dobijate</li>
										<li>✔ Razmenite se direktno ili preko dostave</li>
									</ul>
									<p class="fw-bold">Sve je besplatno i jednostavno!</p>
								</div>
								<div class="col-md-6 d-flex justify-content-center align-items-center">
									<img class="img-fluid rounded " src="assets/images/slider.jpg" alt="Ilustracija razmene">
								</div>
							</div>
						</div>
					</section>
					<section class="py-5 bg-light">
						<div class="container">
							<h4 class="text-center mb-4">Kako funkcioniše Trange Frange?</h4>
							<div class="row row-cols-1 row-cols-md-3 g-4">
								<div class="col">
									<div class="card h-100 border-0 shadow-sm">
										<div class="card-body text-center">
											<img src="assets/images/icons/register.png" width="60" alt="">
											<h5 class="my-3">1. Registrujte se</h5>
											<p>Napravite svoj nalog za manje od minuta i pridružite se zajednici ljudi koji razmenjuju!</p>
											<a href="/register" class="btn btn-sm btn-outline-primary">Registruj se</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card h-100 border-0 shadow-sm">
										<div class="card-body text-center">
											<img src="assets/images/icons/ads.svg" width="60" alt="">
											<h5 class="my-3">2. Postavite oglas</h5>
											<p>Fotografišite stvar koju želite da razmenite, dodajte opis i objavite. Sve je besplatno.</p>
											<a href="/postavioglas" class="btn btn-sm btn-outline-success">Postavi oglas</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card h-100 border-0 shadow-sm">
										<div class="card-body text-center">
											<img src="assets/images/icons/deal1.svg" width="60" alt="">
											<h5 class="my-3">3. Počni razmenu</h5>
											<p>Pregledaj oglase, šalji i primaj ponude. Ako se dogovorite – razmena je uspešna!</p>
											<a href="/razmena" class="btn btn-sm btn-outline-dark">Više o razmeni</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<section class="py-5">
						<div class="container">
							<h4 class="text-center mb-4">Saveti za uspešnu razmenu</h4>
							<div class="row">
								<div class="col-md-6">
									<ul>
										<li>✔ Koristite jasne fotografije</li>
										<li>✔ Opisujte stanje stvari realno</li>
										<li>✔ Budite kulturni u komunikaciji</li>
										<li>✔ Razmenu obavite lično ili preko pouzdane dostave</li>
									</ul>
								</div>
								<div class="col-md-6">
									<p>Kroz Trange Frange ne samo što štedite novac, već i doprinosite očuvanju životne sredine. Svaka uspešna razmena znači manje otpada i više zadovoljnih korisnika. Vaša aktivnost ovde je deo pozitivne promene!</p>
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
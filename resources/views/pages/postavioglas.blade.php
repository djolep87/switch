@extends('layouts.master')

@section('title', 'Postavi oglas')

@section('content')
<div class="wrapper">
	<div class="page-wrapper">
		<div class="page-content">
			<section class="py-5">
				<div class="container">
					<div class="row align-items-center mb-5">
						<div class="col-lg-6">
							<h1 class="display-5 fw-bold mb-4">Kako postaviti oglas</h1>
							<p class="lead">Postavljanje oglasa na Trange Frange je jednostavno, brzo i potpuno besplatno. Prati sledeće korake i objavi svoj oglas za manje od 5 minuta.</p>
						</div>
						<div class="col-lg-6 text-center">
							<img src="{{ asset('assets/images/how/screen2.jpg') }}" alt="Postavi oglas" class="img-fluid rounded-3 ">
						</div>
					</div>

					<div class="row row-cols-1 row-cols-md-2 g-4">
						<div class="col">
							<div class="card border-0 shadow-sm h-100">
								<div class="card-body">
									<h5 class="card-title mb-3"><i class="bx bx-user-plus text-primary me-2"></i> 1. Registrujte se ili se prijavite</h5>
									<p class="card-text">Za postavljanje oglasa potrebno je da imate nalog. Ako ste novi korisnik, registrujte se. Ako već imate nalog – prijavite se i započnite.</p>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="card border-0 shadow-sm h-100">
								<div class="card-body">
									<h5 class="card-title mb-3"><i class="bx bx-edit-alt text-success me-2"></i> 2. Popunite formu za oglas</h5>
									<p class="card-text">Kliknite na <a href="/products.create">"Postavi oglas"</a> i unesite sve potrebne informacije o predmetu:</p>
									<ul class="list-unstyled">
										<li>• Naziv i opis predmeta</li>
										<li>• Stanje i kategorija</li>
										<li>• Dodajte fotografije</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="card border-0 shadow-sm h-100">
								<div class="card-body">
									<h5 class="card-title mb-3"><i class="bx bx-photo-album text-warning me-2"></i> 3. Dodajte slike</h5>
									<p class="card-text">Kvalitetne fotografije pomažu korisnicima da bolje procene predmet i povećavaju šansu za razmenu. Preporučujemo da dodate bar 2-3 jasne slike.</p>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="card border-0 shadow-sm h-100">
								<div class="card-body">
									<h5 class="card-title mb-3"><i class="bx bx-check-circle text-info me-2"></i> 4. Pregled i objava</h5>
									<p class="card-text">Nakon što popunite sve informacije, pregledajte oglas i kliknite na "Sačuvaj". Vaš oglas će odmah biti vidljiv ostalim korisnicima.</p>
								</div>
							</div>
						</div>
					</div>

					<hr class="my-5">

					<div class="text-center">
						<h4 class="mb-3">Zašto postaviti oglas kod nas?</h4>
						<div class="row justify-content-center">
							<div class="col-md-10">
								<ul class="list-group list-group-flush">
									<li class="list-group-item">✅ Potpuno besplatno oglašavanje</li>
									<li class="list-group-item">✅ Velika zajednica spremna na razmenu</li>
									<li class="list-group-item">✅ Ekološki i održiv način razmene</li>
									<li class="list-group-item">✅ Mogućnost uređivanja oglasa u svakom trenutku</li>
								</ul>
								<a href="/products.create" class="btn btn-primary mt-4 px-5 py-2">Postavi svoj oglas sada</a>
							</div>
						</div>
					</div>
					
				</div>
			</section>
		</div>
	</div>

	<a href="javascript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
</div>
@endsection
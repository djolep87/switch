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
                        <div class="row">
                            <div class="col col-sm-6">
                               <h1 class="">Pravila i uputstva o platformi</h1>
						        <h5>Naša platforma se razlikuje od klasičnih sajtova za kupovinu. Da biste učestvovali u razmeni, potrebno je da imate svoj oglas, koji koristite za slanje ponuda drugim korisnicima, u zavisnosti od toga šta vam se dopadne na sajtu. Istovremeno, i vi ćete dobijati ponude za svoj oglas. Na vama je da odlučite da li ćete neku ponudu prihvatiti ili ne.</h5>
						        {{-- <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>
						        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p> 
                             --}}
                            </div>
                            <div class="col col-sm-6 d-flex justify-content-center align-items-center">
                                <img class="mobileimg" src="assets/images/slider.jpg" alt="">
                            </div>
                        </div>
					</div>
				</section>
				<section class="py-4">
					<div class="container">
						<h4>Uputstva</h4>
						<hr>
						<div class="row row-cols-1 row-cols-lg-3">
							<div class="col d-flex">
								<div class="card rounded-0 shadow-none w-100">
									<div class="card-body">
										<img src="assets/images/icons/delivery.png" width="60" alt="">
										<h5 class="my-3">Registracija naloga</h5>
										<p class="mb-0">Registracija naloga je brza i jednostavna! U samo nekoliko koraka možete kreirati svoj nalog i odmah početi da koristite našu platformu.</p>
										<a href="/register" class="">Registruj se</a>
									</div>
								</div>
							</div>
							<div class="col d-flex">
								<div class="card rounded-0 shadow-none w-100">
									<div class="card-body">
										<img src="assets/images/icons/ads.svg" width="60" alt="">
										<h5 class="my-3">Postavite oglas</h5>
										<p class="mb-0">Postavite svoj oglas za samo par minuta i pronađite pravu osobu za razmenu! Naša platforma vam omogućava da lako dodate slike, opis i sve potrebne informacije o vašem predmetu. Proces je jednostavan, intuitivan i potpuno besplatan. </p>
										<a href="/postavioglas" class="">Više o postavljanju oglasa</a>
									</div>
								</div>
							</div>
							<div class="col d-flex">
								<div class="card rounded-0 shadow-none w-100">
									<div class="card-body">
										<img src="assets/images/icons/deal1.svg" width="60" alt="">
										<h5 class="my-3">Započnite u razmenu</h5>
										<p class="mb-0">Razmena nikada nije bila lakša! Na našoj platformi možete jednostavno pronaći, ponuditi i razmeniti stvari koje vam više nisu potrebne. Proces je brz, siguran i potpuno besplatan. Uštedite novac, oslobodite prostor i pronađite ono što vam treba – pridružite se razmeni odmah!</p>
										<a href="/razmena" class="">Više o razmeni</a>
									</div>
								</div>
							</div>
						</div>
						<!--end row-->
					</div>
				</section>
				<section class="py-4">
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
				</section>
				<!--end start page content-->
			</div>
		</div>
		<!--end page wrapper -->
		<!--Start Back To Top Button-->	<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
	</div>
	<!--end wrapper-->
@endsection
@extends('layouts.master')

@section('title', 'Razmena')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="exchange-info m-4">
                    <h2>Kako funkcioniše razmena?</h2>
                    <p>Razmena stvari na <strong>Trange Frange</strong> sajtu je brza i jednostavna!</p>
                    <ul>
                        <li>✅ Pronađite oglas koji vam se dopada.</li>
                        <li>✅ Pošaljite zahtev za zamenu.</li>
                        <li>✅ Sačekajte odgovor – korisnik može da prihvati ili odbije vašu ponudu.</li>
                    </ul>
                    <p>Možete i sami dobijati ponude za svoje oglase. Svaku ponudu možete <strong>prihvatiti</strong> ili <strong>odbiti</strong>, u zavisnosti od toga da li vam odgovara zamena.</p>
                    
                </div>
                <hr>
                <div class="exchange-info m-4">
                    <div class="">
                        <div class="">
                            <h2>Kako poslati zahtev</h2>
                            <p>Da biste poslali zahtev za zamenu, potrebno je da se registrujete na našem sajtu. Nakon toga, možete početi da šaljete zahteve za zamenu drugim korisnicima.</p>
                            <p>Ukoliko želite da razmenite svoj predmet, kliknite na dugme <strong>POŠALJI ZAHTEV</strong> na stranici oglasa. Nakon toga, sačekajte odgovor korisnika.</p>                        
                        </div>
                        <div class="d-flex justify-content-center" >
                            <img style="border: 20px solid white" class="razmena" src="/assets/images/razmena/razmena.png" alt="Kako poslati zahtev">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="exchange-info m-4">
                    <div class="requests-offers">
                        <h2>Vaši zahtevi i ponude</h2>
                        <p>U kontrolnom panelu možete pratiti status svojih zahteva i ponuda.</p>
                        
                        <h3>Zahtevi</h3>
                        <p>Proverite da li je vaš zahtev prihvaćen ili odbijen i nastavite sa razmenom u skladu sa statusom.</p>
                        <div class="d-flex justify-content-center">
                            <img style="border: 20px solid white" class="razmena" src="/assets/images/razmena/razmena2.jpeg" alt="Kako poslati zahtev">
                        </div>
                        
                        <h3>Ponude</h3>
                        <p>Pregledajte sve ponude koje ste dobili za oglase koje ste postavili na sajt.</p>
                        <p>Ukoliko vam ponuda odgovara možete je prihvatiti jednim klikom i nastaviti sa daljim koracima razmene. Ukoliko vam ponuda ne odgovara, jednostavno jednim klikom možete odbiti i obrisati ponudu.</p>
                        <div class="d-flex justify-content-center">
                            <img style="border: 20px solid white" class="razmena" src="/assets/images/razmena/razmena3.jpeg" alt="Kako poslati zahtev">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="exchange-info m-4">
                    <div>
                        <div>
                            <h2>Prihvaćena ponuda</h2>
                            <p>Ako je vaš zahtev prihvaćen ili ste vi prihvatili ponudu, možete nastaviti sa razmenom.</p>
                            
                            <p>Nakon prihvatanja, ispod slike oglasa prikazaće se broj telefona korisnika koji je postavio oglas. Možete ga direktno kontaktirati i dogovoriti dalju razmenu.</p>
                            
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <img style="border: 20px solid white" class="razmena" src="assets/images/razmena/razmena4.jpeg" alt="Kako poslati zahtev">
                        </div>

                    </div>
                    
                </div>
                <hr>

                <div class="exchange-info m-4">
                    <div>
                        <h2>Uspešna razmena</h2>
                        <p>Nakon što ste uspešno razmenili predmete, možete oceniti korisnika sa kojim ste razmenili stvari.</p>
                        <p>Ocena korisnika je važna jer pomaže drugim korisnicima da znaju sa kim razmenjuju stvari.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center">
                            <img style="border: 20px solid white" class="razmena" src="/assets/images/razmena/razmena5.png" alt="Kako poslati zahtev">
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <img style="border: 20px solid white" class="razmena" src="/assets/images/razmena/razmena6.png" alt="Kako poslati zahtev">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="exchange-info m-4">
                    <div>
                        <h2>Neuspešna razmena</h2>
                        <p>Ako razmena iz bilo kog razloga ne uspe, kliknite na dugme <strong>NE</strong> kako biste potvrdili da razmena nije realizovana. Vaši oglasi će automatski ponovo postati vidljivi na sajtu i bićete u mogućnosti da ih ponovo koristite za razmenu.</p>
    
                        <p>Nakon toga, ponovo ćete imati opciju da ocenite korisnika. Ako razmena nije uspela zbog neispunjenog dogovora, možete dodeliti negativnu ocenu.</p>
    
                    </div>
                    <div class="d-flex justify-content-center">
                        <img style="border: 20px solid white" class="razmena" src="/assets/images/razmena/razmena7.png" alt="Kako poslati zahtev">
                       
                    </div>
                </div>
                <hr>
                <div class="exchange-info m-4">
                    <div>
                        <p>Razmena na <strong>Trange Frange</strong> sajtu je jednostavna, sigurna i korisna!  
                        Bilo da tražite nešto novo ili želite da oslobodite prostor od stvari koje vam više ne trebaju,  
                        ovo je pravo mesto za vas.</p>
                
                        <p>Osim što štedite novac, razmenom direktno doprinosite očuvanju životne sredine!  
                        Produžavanjem veka trajanja predmeta smanjujemo otpad, štedimo resurse i pomažemo u smanjenju zagađenja.</p>
                
                        <p>Ne zaboravite da ocenjujete korisnike nakon svake razmene –  
                        tako zajedno gradimo poverenje i sigurnost na platformi.</p>
                
                        <p>Pridružite se zajednici koja misli ekološki i uživajte u pametnoj razmeni!</p>
                    </div>
                </div>
        </div>
        


    </div>
@endsection
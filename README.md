# EPOS
## Vloge uporabnikov

V seminarski nalogi izdelajte model spletne prodajalne z uporabo tehnologij Linux, Apache, SUPB MySQL, PHP, SSL, certifikatov X.509 in mobilne platforme Android.

Spletna prodajalna naj ima naslednje uporabnike, pri katerih hranite spodaj navedene atribute.

    Administrator: Ime, Priimek, Elektronski naslov in geslo.
    Prodajalec: Ime, Priimek, Elektronski naslov in geslo.
    Stranka: Ime, Priimek, Elektronski naslov, Naslov, Telefonska številka, geslo.
    Anonimni odjemalec, pri katerem ne hranite atributov.

## Osnovne storitve

Osnovne storitve prodajalne naj podpirajo naslednje operacije pri vsaki vlogi.
### Spletni vmesnik vloge Administrator

Vmesnik naj omogoča:

    Prijavo in odjavo. Dostop je dovoljen le odjemalcem, ki se overijo s pomočjo certifikatov X.509;
    Posodobitev lastnega gesla in ostalih atributov;
    Ustvarjanje, aktiviranje in deaktiviranje uporabniškega računa Prodajalec ter posodobitev njegovih atributov.

V vlogi administratorja imate lahko zgolj enega uporabnika, ki ga lahko kreirate ročno, denimo z uporabo določene skripte, vmesnika phpmyadmin in podobno.
### Spletni vmesnik vloge Prodajalec

Vmesnik naj omogoča:

    Prijavo in odjavo. Dostop je dovoljen le odjemalcem, ki se overijo s pomočjo certifikatov X.509;
    Posodobitev lastnega gesla in ostalih atributov;
    Obdelavo naročil. Slednje obsega:
        Pregled še neobdelanih naročil in njihovih postavk. Posamezno naročilo se prodajalcu prikaže šele, ko Stranka z nakupom zaključi;
        Potrjevanje ali preklic oddanih naročil;
        Ogled zgodovine potrjenih naročil in možnost storniranja potrjenih naročil.
    Ustvarjanje, aktiviranje in deaktiviranje artiklov in posodabljanje njihovih atributov. Pri obravnavi artiklov lahko upravljanje z zalogami izpustite. Z drugimi besedami -- v aplikaciji lahko vedno predpostavite, da je na zalogi dovolj artiklov;
    Ustvarjanje, aktiviranje in deaktiviranje uporabniških računov tipa Stranka in posodabljanje njegovih atributov.

### Spletni vmesnik vloge Stranka

Vmesnik naj omogoča:

    Prijavo in odjavo;
    Posodobitev lastnega gesla in ostalih atributov;
    Nakupovanje. To naj bo sestavljeno iz:
        Pregledovanja artiklov trgovine;
        Dodajanja in odstranjevanja artiklov v košarico ter spreminjanja količine v košarici;
        Zaključka nakupa. Tu se naj stranki prikaže povzetek kupljenih izdelkov s predračunom. Ko stranka naročilo potrdi, se to doda v čakalno vrsto neobdelanih naročil, kjer ga lahko v obravnavo prevzame Prodajalec.
    Dostop do seznama preteklih nakupov. Uporabnik lahko vidi vsa svoja pretekla naročila: oddana, potrjena in stornirana.
    Uporaba vmesnika Stranka je dovoljena le preko zavarovanega kanala. Odjemalca overite z uporabniškim imenom in geslom, ki naj bosta shranjena v SUPB.

### Spletni vmesnik anonimnega odjemalca

Vmesnik naj omogoča:

    Pregledovanje artiklov preko spletnega vmesnika;
    Registracijo preko spletnega vmesnika;
    Uporaba vmesnika anonimnega odjemalca je dovoljena preko javnega in zavarovanega kanala, pri registraciji pa nujno preklopite na zavarovan kanal. V splošnem poskrbite za ustrezno preklapljanje med omenjenima kanaloma.

### Vmesnik mobilne aplikacije (platforma Android)

Izdelajte Android aplikacijo, ki bo omogočala preprosto pregledovanje artiklov v vaši trgovini.

    Implementirajte vmesnik spletne storitve, preko katerega bo mobilna aplikacija komunicirala z vašo prodajalno;
    Implementirajte funkcionalnost brskanja po artiklih. Implementirajte vsaj dva zaslona:
        Prvi zaslon naj prikaže seznam vseh artiklov v trgovini;
        Če uporabnik izbere artikel s zgornjega seznama, naj aplikacija prikaže drug zaslon, kjer se izpišejo podrobnosti artikla.

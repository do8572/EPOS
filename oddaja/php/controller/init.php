<?php

include_once(__DIR__ . '/../model/uporabniki.php');
include_once(__DIR__ . '/../model/artikli.php');

//ustvari administratorja
$racun = new Uporabnik();
$res = $racun->ustvariAdministratorja();

//prijavi kot administrator
$res = $racun->prijaviX509('epos');

//registraraj prodajalce
$res = $racun->registrirajProdajalca('Ivan', 'Ocepek', 'ivan@gmail.com', 'otec');
$res = $racun->registrirajProdajalca('Alexandra', 'Ocepek', 'alexandra@gmail.com', 'mama');
$res = $racun->registrirajProdajalca('Denis', 'Trcek', 'Denis.Trcek@fri.uni-lj.si', 'prof');


//odjavi
$res = $racun->odjavi();

//registriraj stranke
$res = $racun->registrirajStranko(
  'Denis', 'Ocepek', 'denis@gmail.com', 'brat', 'Vecna pot 11', '070856391');
$res = $racun->registrirajStranko(
  'Doris', 'Ocepek', 'doris@gmail.com', 'sestra', 'Vecna pot 11', '070856391');
$res = $racun->registrirajStranko(
  'Diona', 'Ocepek', 'diona@gmail.com', 'sestra2', 'Vecna pot 11', '070856391');
$res = $racun->registrirajStranko(
  'Boris', 'Johnson', 'boris@gmail.com', 'bojo', '<script>alert()</script>', '070856391');

//prijavi kot prodajalec
$res = $racun->prijaviX509('prof');

//ustvari artikle
$artikel = new Artikel();
$res = $artikel->ustvari('Printer Cannon Pixma 580', 'Black inkjet printer', 63.28);
$res = $artikel->ustvari('Nikkon DSLR 350', 'All purpose Camera', 350.28);

//odjavi
$res = $racun->odjavi();

//repeat

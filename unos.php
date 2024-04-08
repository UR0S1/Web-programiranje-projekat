<?php

require_once 'konfiguracija.php';

// Dobijanje podataka iz forme
$ime = $_POST["ime"];
$prezime = $_POST["prezime"];
$broj_racuna = $_POST["broj_racuna"];
$valuta = $_POST["valuta"];
$iznos = $_POST["iznos"];

// Validacija podataka (npr. provjera da li je Broj Računa numerički)

// SQL upit za umetanje podataka u tabelu
$sql = "INSERT INTO moja_tabela (ime, prezime, broj_racuna, valuta, iznos)
        VALUES ('$ime', '$prezime', '$broj_racuna', '$valuta', $iznos)";

if ($conn->query($sql) === TRUE) {
    echo "Podaci su uspješno spremljeni!";
} else {
    echo "Greška pri unosu podataka: " . $conn->error;
}

$conn->close();
?>

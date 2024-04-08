<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ažuriranje Podataka</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Ažuriranje Podataka</h1>
        <?php
        require_once 'konfiguracija.php';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $broj_racuna = $_POST["broj_racuna"];
            $valuta = $_POST["valuta"];
            $iznos = $_POST["iznos"];

            // Validacija podataka

            $sql = "UPDATE moja_tabela SET ime='$ime', prezime='$prezime', broj_racuna='$broj_racuna', valuta='$valuta', iznos=$iznos WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "Podaci su uspešno ažurirani!";
            } else {
                echo "Greška pri ažuriranju podataka: " . $conn->error;
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>

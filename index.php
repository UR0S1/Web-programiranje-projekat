<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Svi Podaci</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Svi Podaci</h1>
        <?php
        require_once 'konfiguracija.php';

        $sql = "SELECT id, ime, prezime, broj_racuna, valuta, iznos FROM moja_tabela";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'><thead><tr><th>ID</th><th>Ime</th><th>Prezime</th><th>Broj Računa</th><th>Valuta</th><th>Iznos</th></tr></thead><tbody>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["ime"] . "</td><td>" . $row["prezime"] . "</td><td>" . $row["broj_racuna"] . "</td><td>" . $row["valuta"] . "</td><td>" . $row["iznos"] . "</td>";
                echo "<td><a href='pregled.php?id=" . $row["id"] . "' class='btn btn-info btn-sm'>Pregled</a> <a href='azuriranje.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Ažuriranje</a> <a href='brisanje.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Brisanje</a></td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "Nema rezultata.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>

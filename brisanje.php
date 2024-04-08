<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brisanje Podataka</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Brisanje Podataka</h1>
        <?php
        require_once "konfiguracija.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];

            $sql = "DELETE FROM moja_tabela WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "Podaci su uspješno obrisani!";
            } else {
                echo "Greška pri brisanju podataka: " . $conn->error;
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>

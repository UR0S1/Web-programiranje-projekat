<?php
	if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
	
		require_once "konfiguracija.php";
		$sql = "SELECT * FROM uplate WHERE id = ?";
		
		if($stmt = mysqli_prepare($link, $sql)){
		
			mysqli_stmt_bind_param($stmt, "i", $param_id);
			$param_id = trim($_GET["id"]);
			
			if(mysqli_stmt_execute($stmt)){

				$result = mysqli_stmt_get_result($stmt);
				
				if(mysqli_num_rows($result) == 1){
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					$datum = $row["datum"];
					$svrha = $row["svrha"];
					$iznos = $row["iznos"];
				}
				else{
					header("location: greska.php");
					exit();
				}
			}
			else{
				echo "Upss! Nešto je bilo pogrešno. Pokušajte kasnije.";
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($link);
	}
	else{
		header("location: greska.php");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
	<meta charset="UTF-8">
	<title>Citanje zapisa</title>
	<meta name="author" content="Урош Тодоровић, uros.todorovic@valjevskagimnazija.edu.rs">
	<meta name="description" content="Vežbe iz predmeta Veb programiranje, razvijanje veb aplikacije">
	<meta name="keywords" content="html, css, php, primer">
	<link rel="stylesheet" href="stil.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis/com/css2?family=Golos+Text&display=swap" rel="stylesheet">
	<link herf="stil3.css" rel="stylesheet">
</head>
<body>
	<main class="wrapper">
		<h1 class="mt-5 mb-3">Pregled podataka</h1>
		<div class="form-group">
			<label>Datum</label>
			<p><b><?php echo $row["datum"]; ?></b></p>
		</div>
		
		<div class="form-group">
			<label>Svrha</label>
			<p><b><?php echo $row["svrha"]; ?></b></p>
		</div>
		
		<div class="form-group">
			<label ">Iznos</label>
			<p><b><?php echo $row["iznos"]; ?></b></p>
		</div>
		
		<p><a href="index.php" class="btn btn-primary">Nazad</a></p>
	</main>
</body>
</html>
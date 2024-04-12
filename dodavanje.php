<?php
	require_once "konfiguracija.php";
	
	$datum = $svrha = $iznos = "";
	$datum_err = $svrha_err = $iznos_err = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		$input_datum = trim($_POST["datum"]);
		if(empty($input_datum)){
			$datum_err = "Molimo Vas, unesite datum.";
		}
		else{
			$datum = $input_datum;
		}
		
		$input_svrha = trim($_POST["svrha"]);
		if(empty($input_svrha)){
			$svrha_err = "Molimo Vas, unesite svrhu uplate.";
		}
		else{
			$svrha = $input_svrha;
		}
		
		$input_iznos = trim($_POST["iznos"]);
		if(empty($input_iznos)){
			$iznos_err = "Molimo Vas, unesite iznos uplate.";
		}
		else{
			$iznos = $input_iznos;
		}
		
		if(empty($datum_err) && empty($svrha_err) && empty($iznos_err)){
			$sql = "INSERT INTO uplate (datum, svrha, iznos) VALUES (?, ?, ?)";
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "sss", $param_datum, $param_svrha, $param_iznos);
				$param_datum = $datum;
				$param_svrha = $svrha;
				$param_iznos = $iznos;
				if(mysqli_stmt_execute($stmt)){
					header("location: index.php");
					exit();
				}
				else{
					echo "Upss! Nešto je bilo pogrešno. Pokušajte ponovo kasnije.";
				}
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($link);
	}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
	<meta charset="UTF-8">
	<title>Dodavanje zapisa</title>
	<meta name="author" content="Урош Тодоровић, uros.todorovic@valjevskagimnazija.edu.rs">
	<meta name="description" content="Vežbe iz predmeta Veb programiranje, razvijanje veb aplikacije">
	<meta name="keywords" content="html, css, php, prdatumr">
	<link rel="stylesheet" href="stil.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis/com/css2?family=Golos+Text&display=swap" rel="stylesheet">
	<link href="stil2.css" rel="stylesheet">
</head>
<body>
	<main class="wrapper">
		<h2 class="mt-5">Dodavanje zapisa</h2>
		<p>Molimo Vas da popunite ovaj obrazac i da dodate zapis o novoj uplati u bazu podataka.</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="form-group">
				<label>datum</label>
				<input type="date" name="datum" class="form-control <?php echo(!empty($datum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $datum; ?>">
				<span class="invalid-feedback"><?php echo $datum_err; ?></span>
			</div>
			
			<div class="form-group">
				<label>svrha</label>
				<textarea name="svrha" class="form-control <?php echo(!empty($svrha_err)) ? 'is-invalid' : ''; ?>"><?php echo $svrha; ?></textarea>
				<span class="invalid-feedback"><?php echo $svrha_err; ?></span>
			</div>
			
			<div class="form-group">
				<label>iznos</label>
				<input type="text" name="iznos" class="form-control <?php echo(!empty($iznos_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $iznos; ?>">
				<span class="invalid-feedback"><?php echo $iznos_err; ?></span>
			</div>
			
			<input type="submit" class="btn btn-primary" value="Uradi">
			<a href="index.php" class="btn btn-secondary" ml-2>Odustani</a>
			
		</form>
	</main>
</body>
</html>
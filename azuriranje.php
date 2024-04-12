<?php
	require_once "konfiguracija.php";
	$datum=$svrha=$iznos="";
	$datum_err=$svrha_err=$iznos_err="";
	
	if(isset($_POST["id"]) && !empty($_POST["id"])){
		$id = $_POST["id"];
		
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
			$iznos_err = "Molimo Vas, unesite iznos.";
		}
		else{
			$iznos = $input_iznos;
		}
		
		if(empty($datum_err) && empty($svrha_err) && empty($iznos_err)){
			
			$sql = "UPDATE uplate SET datum=?, svrha=?, iznos=? WHERE id=?";
			
			if($stmt = mysqli_prepare($link, $sql)){
				
				mysqli_stmt_bind_param($stmt, "sssi", $param_datum, $param_svrha, $param_iznos, $param_id);
				$param_datum = $datum;
				$param_svrha = $svrha;
				$param_iznos = $iznos;
				$param_id = $id;
				
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
	else{
		if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
			$id = trim($_GET["id"]);
			$sql = "SELECT * FROM uplate WHERE id = ?";
			
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "i", $param_id);
				$param_id = $id;
				
				if(mysqli_stmt_execute($stmt)){
					$result = mysqli_stmt_get_result($stmt);
					
					if(mysqli_num_rows($result) == 1){
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						$datum = $row["datum"];
						$svrha= $row["svrha"];
						$iznos=$row["iznos"];
					}
					else{
						header("location: greska.php");
						exit();
					}
				}
				else{
					echo "Upss! Nešto je bilo pogrešno. Pokušajte ponovo kasnije.";
				}
			}
			mysqli_stmt_close($stmt);
			mysqli_close($link);
		}
		else{
			header("location: greska.php");
			exit();
		}
	}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
	<meta charset="UTF-8">
	<title>Ažuriranje zapisa</title>
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
	<main class="wrapper col-md-12">
		<h2 class="mt-5">Ažuriranje zapisa</h2>
		<p>Molimo Vas, uredite ulazne podatke i sačuvajte izmene.</p>
		<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
			<div class="form-group">
				<label>Datum</label>
				<input type="date" name="datum" class="form-control" <?php echo (!empty($datum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $datum; ?>">
				<span class=invalid-feedback"><?php echo $datum_err; ?></span>
			</div>
			
			<div class="form-group">
				<label>Svrha</label>
				<textarea name="svrha" class="form-control" <?php echo (!empty($svrha_err)) ? 'is-invalid' : ''; ?>"><?php echo $svrha; ?></textarea>
				<span class=invalid-feedback"><?php echo $svrha_err; ?></span>
			</div>
			
			<div class="form-group">
				<label>Iznos</label>
				<input type="text" name="iznos" class="form-control" <?php echo (!empty($iznos_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $iznos; ?>">
				<span class=invalid-feedback"><?php echo $iznos_err; ?></span>
			</div>
			
			<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<input type="submit" class="btn btn-primary" value="Uradi">
			<a href="index.php" class="btn btn-secondary ml-2">Odustani</a> 
			
		</form>
	</main>
</body>
</html>
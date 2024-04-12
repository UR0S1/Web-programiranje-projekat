<!DOCTYPE html>
<html lang="sr">
<head>
	<meta charset="UTF-8">
	<title>Podaci o uplatama</title>
	<meta name="author" content="Урош Тодоровић, uros.todorovic@valjevskagimnazija.edu.rs">
	<meta name="description" content="Vežbe iz predmeta Veb programiranje, razvijanje veb aplikacije">
	<meta name="keywords" content="html, css, php, primer">
	<link rel="stylesheet" href="stil.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis/com/css2?family=Golos+Text&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<main class="wrapper mt-5 mb-3 clearfix">
		<h2 class="pull-left">Podaci o zaposlenima</h2>
		<a href="dodavanje.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Dodavanje nove uplate</a>
		<?php
			require_once "konfiguracija.php";
			$sql = "SELECT * FROM uplate";
			
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
					echo '<table class="table table-bordered table-striped">';
						echo "<thead>";
							echo "<tr>";
								echo "<th>ID</th>";
								echo "<th>Datum</th>";
								echo "<th>Svrha</th>";
								echo "<th>Iznos</th>";
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>\r\n";
							while($row = mysqli_fetch_array($result)){
								echo "<tr>";
									echo "<td>" . $row['id'] . "</td>";
									echo "<td>" . $row['datum'] . "</td>";
									echo "<td>" . $row['svrha'] . "</td>";
									echo "<td>" . $row['iznos'] . "</td>";
									echo "<td>\r\n";
										echo '<a href="citanje.php?id='. $row['id'] .'" class="mr-3" title="Pregled podataka" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
										echo '<a href="azuriranje.php?id='. $row['id'] .'" class="mr-3" title="Ažuriranje zapisa" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
										echo '<a href="brisanje.php?id='. $row['id'] .'" class="mr-3" title="Brisanje zapisa" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
									echo "</td>";
								echo "</tr>\r\n";
							}
						echo "</tbody>";
					echo "</table>\r\n";
					mysqli_free_result($result);
				}
				else{
					echo '<div class="alert alert-danger"><em>Nije pronađen nijedan zapis.</em></div>';
				}
			}
			else{
					echo "Upss! Nešto je bilo pogrešno. Pokušajte ponovo kasnije.";
				}
				
			mysqli_close($link);
		?>
	</main>
</body>
</html>
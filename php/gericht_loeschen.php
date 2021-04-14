<?php
if(isset($_POST["loeschen_gericht"]))
{
	$antwort = mysqli_query($link, "select * from rezepte where rezeptnummer=".$_GET["rezeptnummer"]."");
	$datensatz = mysqli_fetch_array($antwort);
	
	# Schritt 1 Datei löschen
	unlink("bilder/".$datensatz["bild"]."");
	# Schritt 2 Gericht löschen
	mysqli_query($link, "delete from rezepte where rezepte.rezeptnummer = ".$_GET["rezeptnummer"]."");
	# Umleitung
	header("Location: ?seite=verwaltung");
	exit;	
}
else
{
	$antwort = mysqli_query($link, "select * from rezepte where rezeptnummer=".$_GET["rezeptnummer"]."");
	$datensatz = mysqli_fetch_array($antwort);

	echo '<br>
		<div class="container">
		  <div class="row">
			<div class="col"></div>
				<div class="col-8">
					<div class="card" style="max-width: 2500px;">
					  <div class="card-body">
						<h2 style="text-align: center;"> <i class="bi bi-exclamation-triangle"></i> Löschenbestätigung</h2><br>
						<div class="alert alert-danger" role="alert"> Wollen Sie wirklich das Rezept '.$_GET["rezeptnummer"].' löschen? </div><br>
						<div style="text-align: center;">
						<h6>'.$datensatz["titel"].'</h6>
						<img src="bilder/'.$datensatz["bild"].'" style="width: 200px;"/><br><br><br>
						<form method="POST">
						<a href="?seite=verwaltung&unterseite=neues_gericht"><button type="submit" name="loeschen_gericht" class="btn btn-danger">Löschen</button></a>
						</form>
						oder <br><br>
						<a href="?seite=verwaltung"><button type="submit" class="btn btn-secondary">Zurück zur Verwaltung</button></a><br>
						</div>
					  </div>
					</div>
				</div>
			<div class="col"></div>
		  </div>
		 </div><br><br><br><br><br><br><br><br><br>'; 
}
?>
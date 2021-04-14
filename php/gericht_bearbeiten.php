<?php
if(isset($_POST["gericht_bearbeiten"]))
{
	#Auswertung
	$titel 				= $_POST["titel"];
	$beschreibung 		= $_POST["beschreibung"]; 
	$zutaten 			= $_POST["zutaten"];
	$zubereitung		= $_POST["zubereitung"];
	$land				= $_POST["land"];
	$vegetarisch 		= $_POST["vegetarisch"];
	$kategorie			= $_POST["kategorie"];
	$schwierigkeit 		= $_POST["schwierigkeit"];
	
	$antwort = mysqli_query($link, "select * from rezepte where rezeptnummer=".$_GET["rezeptnummer"]."");
	$datensatz = mysqli_fetch_array($antwort);
	
	if(isset($_FILES["bild"]))
	{
		if($_FILES["bild"]["name"] != "")
		{
			# altes Bild entfernen	
			unlink("bilder/".$datensatz["bild"].""); # Bilddatei löschen
			
			$bild			= uniqid().".jpg";	# neuer Dateiname
			move_uploaded_file($_FILES["bild"]["tmp_name"], "bilder/".$bild); # upload			
			mysqli_query($link, "update rezepte set bild = '$bild'
								 where rezeptnummer = ".$_GET["rezeptnummer"]." ");
		}
		else
		{
			# mache nichts mit dem Bild
		}
	}
	
	# Datenbank
	# Produkt speichern
	mysqli_query($link, "update rezepte set
						titel = '$titel', 
						beschreibung = '$beschreibung', 
						zutaten = '$zutaten', 
						zubereitung = '$zubereitung', 
						land = '$land', 
						vegetarisch = '$vegetarisch', 
						kategorie = '$kategorie', 
						schwierigkeit = '$schwierigkeit'
						where rezeptnummer = ".$_GET["rezeptnummer"]."");
	
	echo '<br><br><br><br>
	<div class="container">
	  <div class="row">
		<div class="col"></div>
			<div class="col-8">
				<div class="card" style="max-width: 2500px;">
				  <div class="card-body">
					<h2 style="text-align: center;">Gericht erfolreich geändert!</h2><br>
					<div class="alert alert-success" role="alert"> Es wurde das Gericht '.$_GET["rezeptnummer"].' geändert</div><br>
					<div style="text-align: center;">
					<a href="?seite=verwaltung"><button class="btn btn-secondary">Zurück zur Verwaltung</button></a>
					</div>
				  </div>
				</div>
			</div>
		<div class="col"></div>
	  </div>
	 </div><br><br><br><br><br><br><br><br><br>';
}
else
{
	include("gericht_daten_laden.php");
}


?>
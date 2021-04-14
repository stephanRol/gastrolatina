<?php
if(isset($_POST["neues_gericht_speichern"]))
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
	
	$bild			= uniqid().".png";	# neuer Dateiname
	move_uploaded_file($_FILES["bild"]["tmp_name"], "bilder/".$bild); # upload
	
	# Datenbank
	# Produkt speichern
	mysqli_query($link, "insert into rezepte 
						(titel, beschreibung, zutaten, zubereitung, bild, land, vegetarisch, kategorie, schwierigkeit)
						values
						('$titel', '$beschreibung', '$zutaten', '$zubereitung','$bild', '$land', '$vegetarisch', '$kategorie', '$schwierigkeit')
						");
	
	$produkt_pk = $link->insert_id; # primärschlüssel
	
	echo '<br><br><br><br>
	<div class="container">
	  <div class="row">
		<div class="col"></div>
			<div class="col-8">
				<div class="card" style="max-width: 2500px;">
				  <div class="card-body">
					<h2 style="text-align: center;">Gericht erfolreich erstellt!</h2><br>
					<div class="alert alert-success" role="alert"> Es wurde ein neues Gericht gespeichert unter: '. $produkt_pk.'</div><br>
					<div style="text-align: center;">
					<a href="?seite=verwaltung"><button class="btn btn-secondary">Zurück zur Verwaltung</button></a>
					<a href="?seite=verwaltung&unterseite=neues_gericht"><button class="btn btn-secondary">Weiteres Gericht</button></a><br>
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
	include("gericht_formular.php");
}
?>



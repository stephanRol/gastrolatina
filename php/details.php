<?php

$antwort = mysqli_query($link, "select * from rezepte where rezeptnummer=".$_GET["rezeptnummer"]."");
$datensatz = mysqli_fetch_array($antwort);

$land_antwort = mysqli_query($link, "select land_name from laender, rezepte where laender.land_nummer = ".$datensatz["land"]."");
$land_name = mysqli_fetch_array($land_antwort);


$liste_separat = explode(";", $datensatz["zutaten"]);

			echo '<div class="container">';	
			echo '<div class="card mb-3" style="max-width: 1200px; border-style: solid; border-width: 1px; border-color: #f9c586;">';
			echo  '<div class="row g-0">';
			echo    '<div class="col-md-4">';
			echo 		"<img src='bilder/".$datensatz["bild"]."' style='width:300px; height:250px;'/><br/><br/><br/>";
			echo 	        '<h5>&nbsp;&nbsp;&nbsp;Land:  '.$land_name[0].'&nbsp;<img src="bilder/'.$land_name[0].'.png" style="width:25px;" 
							data-toggle="tooltip" data-placement="bottom" title="'.$land_name[0].'" </h5><br/><br/>';
			echo 	        '<h5>&nbsp;&nbsp;&nbsp;Kategorie:  '.$datensatz["kategorie"].'&nbsp;</h5><br/>';
			echo 	        '<h5>&nbsp;&nbsp;&nbsp;Schwierigkeit:  '.$datensatz["schwierigkeit"].'&nbsp;</h5><br/>';
			echo 	        '<h5>&nbsp;&nbsp;&nbsp;Vegetarisch:  '.$datensatz["vegetarisch"].'&nbsp;';
			echo 			($datensatz["vegetarisch"]=="Ja")?('<img src="bilder/leaf.png" style="width:25px; data-toggle="tooltip" data-placement="bottom" title="Vegetarisch" />'):('');
			echo 			'</h5><br/><br/>';
			echo 			'<a href="?seite=gerichte">
								 <button class="btn btn-secondary ml-3" style="margin:3px;">Zurück</button></a>';
								 				 
			//echo 			'<a href="?seite=meinerezepte"><button class="btn btn-danger ml-1" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="bi bi-book"></i> Rezept hinzufügen</button></a>';
			
			if(@$_SESSION["rezeptnummer".$datensatz["rezeptnummer"]]==$datensatz["rezeptnummer"])
								 {
									echo '<a href="?seite=meinerezepte"><button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="bi bi-check2"></i>
									Rezept hinzugefügt</button></a>';
								 }
								 else
								 {
									
									echo '<a href="?seite=meinerezepte&rezeptnummer='.$datensatz["rezeptnummer"].'"><button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="bi bi-book"></i> 
									Rezept hinzufügen</button>
									</a>';
								 }		 
								 
			echo 	'</div>';
			echo    '<div class="col-md-8">';
			echo		'<div class="card-body" style="width:729px; height:650px; overflow:scroll;">';
			echo        	'<h2 class="card-title">'.$datensatz["titel"].'&nbsp;&nbsp;</h2><br>';
			echo 	        '<p class="card-text">'.$datensatz["beschreibung"].'</p>';
							//Tabelle
			echo 	        '<h5>Zutaten:</h5>';
			
			
			echo 		'<table class="table table-striped">';
			echo  			'<thead>';
			echo    			'<tr>';
			echo      			'<th scope="col">Menge</th>';
			echo      			'<th scope="col">Zutat</th>';
			echo    			'</tr>';
			echo   			'</thead>';
			echo  			'<tbody>';
			foreach($liste_separat as $elemente)
			{
					echo    			'<tr>';
					$liste_elemente = explode(":", $elemente);
					foreach($liste_elemente as $element)
					{
						echo      			'<td>'.$element.'</td>';
					}
					echo    			'</tr>';
			}
			echo   			'</tbody>';
			echo 		'</table>';
			
			echo 	        '<h5>Zubereitung:</h5>';
			echo 	        '<p class="card-text">'.$datensatz["zubereitung"].'</p>';
			echo    	'</div>';
			echo    '</div>';
			echo  '</div>';
			echo '</div>';	
			echo '</div>';
			echo '<br><br>';
?>


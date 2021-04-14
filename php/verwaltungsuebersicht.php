<?php
if(@$_POST["suche"] !== "")
{
	$_SESSION["suche"] = @$_POST["suche"];
}
?>
<div class="row">
  <div class="col-3" style="padding-left:6%;">
		
		<form method='post'>
			
			<div class="input-group">
				<div class="form-outline">
					<input type="search" name='suche' value='<?= @$_SESSION["suche"]; ?>' placeholder="search" class="form-control" />
				</div>
				<button type="submit" name='' value='' class="btn btn-primary"><i class="bi bi-search"></i></button>
			</div><br>

			<div class="card" style="width: 18rem;">
			  <div class="card-body">
				<h5 class="card-title">Länder</h5>
				<input type="checkbox" name="arg" value="Argentinien" /> Argentinien<br>
				<input type="checkbox" name="bol" value="Bolivien" /> Bolivien<br>
				<input type="checkbox" name="bra" value="Brasilien"/> Brasilien<br>
				<input type="checkbox" name="chi" value="Chile"/> Chile<br>
				<input type="checkbox" name="ecu" value="Ecuador"/> Ecuador<br>
				<input type="checkbox" name="kol" value="Kolumbien"/> Kolumbien<br>
				<input type="checkbox" name="mex" value="Mexico"/> Mexico<br>
				<input type="checkbox" name="par" value="Paraguay"/> Paraguay<br>
				<input type="checkbox" name="per" value="Peru"/> Peru<br>
				<input type="checkbox" name="uru" value="Uruguay"/> Uruguay<br>
				<input type="checkbox" name="ven" value="Venezuela"/> Venezuela<br><br>
				
				<h5 class="card-title"> Kategorie</h5>
				<input type="checkbox" name="hau" value="Hauptspeise"/> Hauptspeise<br>
				<input type="checkbox" name="get" value="Getränk"/> Getränk<br>
				<input type="checkbox" name="nac" value="Nachtisch"/> Nachtisch<br><br>
				
				<h5 class="card-title"> Schwierigkeit</h5>
				<input type="checkbox" name="lei" value="Leicht"/> Leicht<br>
				<input type="checkbox" name="mit" value="Mittel"/> Mittel<br>
				<input type="checkbox" name="ans" value="Anspruchvoll"/> Anspruchvoll<br><br>
				
				<h5 class="card-title"> Vegetarisch</h5>
				<input type="checkbox" name="veg" value="Ja"> Vegetarisch<br><br>
				
				<button type="submit" class="btn btn-primary">Suchen</button>
			  </div>
			</div>
		
		</form>
  </div>
  <div class="col-9">
	<?php
		//First state
		$filter_activ = false;	
		$antwort = mysqli_query($link, "SELECT * FROM rezepte");
		
		//suche
		if(@$_POST["suche"]!=="")
		{
				$suche_string = "((titel LIKE '%".@$_POST["suche"]."%'
								   OR zutaten LIKE '%".@$_POST["suche"]."%'	
								   OR zubereitung LIKE '%".@$_POST["suche"]."%'	
								) 
				AND  rezepte.land = laender.land_nummer)";
				
				$filter_activ = true;
		}												  
		else
		{
				$suche_string = "";
		}
		
		if( @$_POST["arg"] || 
			@$_POST["bol"] || 
			@$_POST["bra"] || 
			@$_POST["chi"] || 
			@$_POST["ecu"] || 
			@$_POST["kol"] || 
			@$_POST["mex"] || 
			@$_POST["par"] || 
			@$_POST["per"] || 
			@$_POST["uru"] || 
			@$_POST["ven"]
		)
		{
				$laender_string =   "((land_name='".@$_POST["arg"]."' 
									OR land_name='".@$_POST["bol"]."' 
									OR land_name='".@$_POST["bra"]."' 
									OR land_name='".@$_POST["chi"]."' 
									OR land_name='".@$_POST["ecu"]."' 
									OR land_name='".@$_POST["kol"]."' 
									OR land_name='".@$_POST["mex"]."' 
									OR land_name='".@$_POST["par"]."' 
									OR land_name='".@$_POST["per"]."' 
									OR land_name='".@$_POST["uru"]."' 
									OR land_name='".@$_POST["ven"]."' )
									AND  rezepte.land = laender.land_nummer)";
				
				if($filter_activ == true)
				{
					$laender_string = " AND ".$laender_string;
				}
				$filter_activ = true;
		}												  
		else
		{
				$laender_string = "";
		}
		
		if(@$_POST["hau"] || @$_POST["get"] || @$_POST["nac"])
		{
				$kategorie_string = "((kategorie='".@$_POST["hau"]."' 
									OR kategorie='".@$_POST["get"]."' 
									OR kategorie='".@$_POST["nac"]."')
									AND  rezepte.land = laender.land_nummer)";
				
				if($filter_activ == true)
				{
					$kategorie_string = " AND ".$kategorie_string;
				}	
				$filter_activ = true;				
		}												  
		else
		{
				$kategorie_string = "";
		}
		
		if(@$_POST["lei"] || @$_POST["mit"] || @$_POST["ans"])
		{
				$schwierigkeit_string = "((schwierigkeit='".@$_POST["lei"]."' 
								  OR schwierigkeit='".@$_POST["mit"]."' 
								  OR schwierigkeit='".@$_POST["ans"]."')
								  AND  rezepte.land = laender.land_nummer)";	
								  
				if($filter_activ == true)
				{
					$schwierigkeit_string = " AND ".$schwierigkeit_string;
				}	
				$filter_activ = true;
		}												  
		else
		{
				$schwierigkeit_string = "";
		}
		
		if(@$_POST["veg"])
		{
				$vegetarisch_string = "(vegetarisch='".@$_POST["veg"]."'
								  AND  rezepte.land = laender.land_nummer)";
				
				if($filter_activ == true)
				{
					$vegetarisch_string = " AND ".$vegetarisch_string;
				}	
				$filter_activ = true;
		}												  
		else
		{
				$vegetarisch_string = "";
		}
		
		$sql_befehl_teil_1 = "SELECT * FROM rezepte, laender WHERE ";
		$sql_befehl = $sql_befehl_teil_1.$suche_string.$laender_string.$kategorie_string.$schwierigkeit_string.$vegetarisch_string;
													 													 
		$antwort = mysqli_query($link, $sql_befehl);
		
		unset($_SESSION["alte_daten"][@array_keys($_POST)[0]]);
		
		//Einfügen Button
		echo '<a href="?seite=verwaltung&unterseite=neues_gericht"><button class="btn btn-primary"><i class="bi bi-plus-circle"></i> Neues Gericht erstellen</button></a><br><br>';
		
		
		if(count($_POST)>1 || count($_POST)>0 && @$_POST["suche"] !== "" && @$_POST["delete"] !== "Alle Löschen")
		 
		{
				$_SESSION["alte_daten"] = $_POST;
				echo '<form method="post" style="float: left">';
				echo   '<button type="submit" name="delete" value="Alle Löschen" class="btn btn-secondary">Alle Löschen&nbsp;<i class="bi bi-x-circle"></i></button>&nbsp';
				echo '</form>';
		}
		else
		{
			$_SESSION["alte_daten"]=array();
		}
		
		if(@$_POST["delete"]=="Alle Löschen")
		{
			$_SESSION["alte_daten"]=array();
		}
		
		$final_array = $_SESSION["alte_daten"];
		
		//Show boxes with search filters
		foreach($_SESSION["alte_daten"] as $key_post => $wert)
		{		
				if($wert !== "" && $wert !== "Ja") 
				{	
					echo '<form method="post" style="float: left">';
					echo   '<button type="submit" name="" value="" class="btn btn-secondary"> '.$wert.'&nbsp;&nbsp;<i class="bi bi-x-circle"></i></button>&nbsp';
						
						 foreach($_SESSION["alte_daten"] as $key_hidden => $wert_hidden){
								if($key_post !== $key_hidden)
								{
									echo '<input type="hidden" name="'.$key_hidden.'" value="'.$wert_hidden.'" />';
								}		
						 }		
					echo '</form>';
				} 
				
				else if($wert == "Ja")
				{
					echo '<form method="post" style="float: left">';
					echo '<button type="submit" name="" value="" class="btn btn-secondary"> Vegetarisch &nbsp;&nbsp;<i class="bi bi-x-circle"></i></button>&nbsp;';
					
						foreach($_SESSION["alte_daten"] as $key_hidden => $wert_hidden){
							    if($key_post !== $key_hidden)
							    {
									echo '<input type="hidden" name="'.$key_hidden.'" value="'.$wert_hidden.'" />';
								}	
						}
					echo '</form>';
				}
		}
		
		//Fürs Design notwendig
		if(count($_SESSION["alte_daten"])>0 && count($_SESSION["alte_daten"])<10 )
		{
			echo '<div>&nbsp;</div>';							
			echo "<br/><br/>";
		}
		else if(count($_SESSION["alte_daten"])>=10)
		{	
			echo '<div>&nbsp;</div>';							
			echo '<div>&nbsp;</div>';							
			echo '<div>&nbsp;</div>';							
			echo "<br/><br/><br/>";	
		}
		
		//Show all if there's no filters selected
		if(empty($_POST))
		{
			$antwort = mysqli_query($link, "SELECT * FROM rezepte");	
		}
		else if(@$antwort->num_rows == 0 && count(@$_POST)>=2)
		{
			
			echo '<div class="alert alert-danger" role="alert" style="width:700px;">Die Suche hat keine Ergebnisse geliefert.</div>';
		}
		else if(@$antwort->num_rows == 0 && $_POST["suche"]!=="")
		{
			
			echo '<div class="alert alert-danger" role="alert" style="width:700px;">Die Suche hat keine Ergebnisse geliefert.</div>';
		}
		else if(empty($_POST)==false && @$_POST["suche"]=="" && array_keys($_POST)[0]=="suche" && count($_POST)==1)
		{
			
			$antwort = mysqli_query($link, "SELECT * FROM rezepte");
		}
		
		//Rezepte anzeigen
		while($datensatz = mysqli_fetch_array($antwort))
		{
			$land_antwort = mysqli_query($link, "select land_name from laender, rezepte where laender.land_nummer = ".$datensatz["land"]."");
			$land_name = mysqli_fetch_array($land_antwort);
					
				echo '<div class="card mb-3" style="max-width: 1200px; border-style: solid; border-width: 1px; border-color: gray;">';
				echo  '<div class="row g-0">';
				echo    '<div class="col-md-4">';
				echo 		"<img src='bilder/".$datensatz["bild"]."' style='width:300px; height:250px;'/>";
				echo 	'</div>';
				echo    '<div class="col-md-8">';
				echo		'<div class="card-body">';
				echo        	'<h5 class="card-title">'.$datensatz["titel"]."&nbsp;&nbsp;".'<img src="bilder/'.$land_name[0].'.png" style="width:25px;" 
								data-toggle="tooltip" data-placement="bottom" title="'.$land_name[0].'" />';
				echo 			($datensatz["vegetarisch"]=="Ja")?('<img src="bilder/leaf.png" style="width:25px; data-toggle="tooltip" data-placement="bottom" title="Vegetarisch" />'):('');
				echo			'</h5>';
				echo 	        '<p class="card-text">'.$datensatz["beschreibung"].'</p>';
				echo        	'<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>';
				echo 			'<a href="?seite=verwaltung&unterseite=gericht_bearbeiten&rezeptnummer='.$datensatz["rezeptnummer"].'">
								 <button class="btn btn-secondary" style="margin:3px;">Bearbeiten</button></a>';
				echo 			'<a href="?seite=verwaltung&unterseite=gericht_loeschen&rezeptnummer='.$datensatz["rezeptnummer"].'"><button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="bi bi-x-circle"></i> 
								 Rezept löschen</button>
								 </a>';
				echo    	'</div>';
				echo    '</div>';
				echo  '</div>';
				echo '</div>';		
		}
		
		$_POST = array();
		
		?>
  </div>
</div>


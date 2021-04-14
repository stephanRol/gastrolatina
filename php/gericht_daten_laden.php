<?php

$antwort = mysqli_query($link, "select * from rezepte where rezeptnummer=".$_GET["rezeptnummer"]."");
$datensatz = mysqli_fetch_array($antwort);				  
					 
?>

<div class="container">
  <div class="row">
    <div class="col">
    </div>
		<div class="col-8">
			<div class="card" style="max-width: 2500px;">
			  <div class="card-body">
				<h1 style="text-align:center; font-family: Amatic SC, cursive; font-size: 50px"> Gericht bearbeiten</h1><br><br>
					<form method='post' enctype="multipart/form-data">
					  
					  <div class="mb-3">
						<label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Titel: </label>
						<input required type="text" name="titel" value="<?= $datensatz["titel"]?>" class="form-control">
					  </div>
					  <div class="mb-3">
						<label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Beschreibung: </label>
						<textarea required name="beschreibung" class="form-control" rows=3><?= $datensatz["beschreibung"]?></textarea>
					  </div>
					  <div class="mb-3">
						<label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Zutaten:</label>
						<textarea required name="zutaten" class="form-control" rows=5><?= $datensatz["zutaten"]?></textarea>
					  </div>
					  <div class="mb-3">
						<label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Zubereitung:</label>
						<textarea required name="zubereitung" class="form-control" rows=5><?= $datensatz["zubereitung"]?></textarea>
					  </div>
					  <label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Bild: </label><br />
					  <img src='bilder/<?= $datensatz["bild"]?>' style='width:300px; height:250px;'/><br><br>
					  <input type="file" name="bild" /><br/><br/>
					
					  <label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Land: </label><br />
					  <select required name="land" class="form-select" aria-label="Default select example">
					  <option selected></option>
					  <option <?= $datensatz["land"]==2? "selected" : ""; ?> value=2>Argentinien</option>
					  <option <?= $datensatz["land"]==5? "selected" : ""; ?> value=5>Bolivien</option>
					  <option <?= $datensatz["land"]==8? "selected" : ""; ?> value=8>Brasilien</option>
					  <option <?= $datensatz["land"]==3? "selected" : ""; ?> value=3>Chile</option>
					  <option <?= $datensatz["land"]==9? "selected" : ""; ?> value=9>Ecuador</option>
					  <option <?= $datensatz["land"]==10? "selected" : ""; ?> value=10>Kolumbien</option>
					  <option <?= $datensatz["land"]==1? "selected" : ""; ?> value=1>Mexico</option>
					  <option <?= $datensatz["land"]==6? "selected" : ""; ?> value=6>Paraguay</option>
					  <option <?= $datensatz["land"]==4? "selected" : ""; ?> value=4>Peru</option>
					  <option <?= $datensatz["land"]==7? "selected" : ""; ?> value=7>Uruguay</option>
					  <option <?= $datensatz["land"]==11? "selected" : ""; ?> value=11>Venezuela</option>
					  </select><br/><br/>  
					  
					  <label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Vegetarisch: </label><br />
					  <select required  name="vegetarisch"  class="form-select" aria-label="Default select example">
						  <option selected></option>
						  <option <?= $datensatz["vegetarisch"]=="Ja"? "selected" : ""; ?> value="Ja">Ja</option>
						  <option <?= $datensatz["vegetarisch"]=="Nein"? "selected" : ""; ?> value="Nein">Nein</option>
					  </select><br/><br/>
					  
					  <label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Kategorie: </label><br />
					  <select required name="kategorie" class="form-select" aria-label="Default select example">
						  <option selected></option>
						  <option <?= $datensatz["kategorie"]=="Hauptspeise"? "selected" : ""; ?> value="Hauptspeise">Hauptspeise</option>
						  <option <?= $datensatz["kategorie"]=="Getränk"? "selected" : ""; ?> value="Getränk">Getränk</option>
						  <option <?= $datensatz["kategorie"]=="Nachtisch"? "selected" : ""; ?> value="Nachtisch">Nachtisch</option>
					  </select><br/><br/>
					  
					  <label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Schwierigkeit: </label><br />
					  <select required name="schwierigkeit" class="form-select" aria-label="Default select example">
						  <option selected></option>
						  <option <?= $datensatz["schwierigkeit"]=="Leicht"? "selected" : ""; ?> value="Leicht">Leicht</option>
						  <option <?= $datensatz["schwierigkeit"]=="Mittel"? "selected" : ""; ?> value="Mittel">Mittel</option>
						  <option <?= $datensatz["schwierigkeit"]=="Anspruchvoll"? "selected" : ""; ?> value="Anspruchvoll">Anspruchvoll</option>
					  </select><br/><br/><br/>
					  
				  <button type="submit"  name="gericht_bearbeiten" class="btn btn-primary">Ändern</button><br><br>
				</form>
			  </div>
			</div>
		</div>
    <div class="col">
    </div>
  </div>
 </div><br><br><br><br><br><br>

<div class="container">
  <div class="row">
    <div class="col">
    </div>
		<div class="col-8">
			<div class="card" style="max-width: 2500px;">
			  <div class="card-body">
				<h1 style="text-align:center; font-family: Amatic SC, cursive; font-size: 50px"> Neues Gericht </h1><br><br>
					<form method='post' enctype="multipart/form-data">
					  
					  <div class="mb-3">
						<label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Titel: </label>
						<input required type="text" name="titel" class="form-control">
					  </div>
					  <div class="mb-3">
						<label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Beschreibung: </label>
						<textarea required name="beschreibung" class="form-control" rows=3></textarea>
					  </div>
					  <div class="mb-3">
						<label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Zutaten:</label>
						<textarea required name="zutaten" class="form-control" rows=5></textarea>
					  </div>
					  <div class="mb-3">
						<label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Zubereitung:</label>
						<textarea required name="zubereitung" class="form-control" rows=5></textarea>
					  </div>
					  
					  <label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Bild: </label><br />
					  <input type="file" name="bild" /><br/><br/>
					  
					  <label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Land: </label><br />
					  <select required name="land" class="form-select" aria-label="Default select example">
						  <option selected></option>
						  <option value=2>Argentinien</option>
						  <option value=5>Bolivien</option>
						  <option value=8>Brasilien</option>
						  <option value=3>Chile</option>
						  <option value=9>Ecuador</option>
						  <option value=10>Kolumbien</option>
						  <option value=1>Mexico</option>
						  <option value=6>Paraguay</option>
						  <option value=4>Peru</option>
						  <option value=7>Uruguay</option>
						  <option value=11>Venezuela</option>
					  </select><br/><br/>
					  
					  <label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Vegetarisch: </label><br />
					  <select required  name="vegetarisch"  class="form-select" aria-label="Default select example">
						  <option selected></option>
						  <option value="Ja">Ja</option>
						  <option value="Nein">Nein</option>
					  </select><br/><br/>
					  
					  <label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Kategorie: </label><br />
					  <select required name="kategorie" class="form-select" aria-label="Default select example">
						  <option selected></option>
						  <option value="Hauptspeise">Hauptspeise</option>
						  <option value="Getränk">Getränk</option>
						  <option value="Nachtisch">Nachtisch</option>
					  </select><br/><br/>
					  
					  <label class="form-label" style="font-family: Amatic SC, cursive; font-size: 26px;">Schwierigkeit: </label><br />
					  <select required name="schwierigkeit" class="form-select" aria-label="Default select example">
						  <option selected></option>
						  <option value="Leicht">Leicht</option>
						  <option value="Mittel">Mittel</option>
						  <option value="Anspruchvoll">Anspruchvoll</option>
					  </select><br/><br/><br/>
					  
				  <button type="submit"  name="neues_gericht_speichern" class="btn btn-primary">Erstellen</button><br><br>
				</form>
			  </div>
			</div>
		</div>
    <div class="col">
    </div>
  </div>
 </div><br><br><br><br><br><br>

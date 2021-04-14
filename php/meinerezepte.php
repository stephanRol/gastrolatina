<?php
	
if(isset($_SESSION["benutzer"]))
{

	if(isset($_GET["rezeptnummer"]))
	{
		$_SESSION["rezeptnummer".$_GET["rezeptnummer"].""] = $_GET["rezeptnummer"];
		
		$rezept_nummer = $_GET["rezeptnummer"];
		$user_name = $_SESSION["benutzer"];
		
		mysqli_query($link, "insert into meinerezepte 
							(rezept_nummer, user_name)
							values
							('$rezept_nummer','$user_name')
					");
		header("Location: ?seite=meinerezepte");
	}
	
	if(isset($_POST["einrezept_loeschen"]))
	{
		mysqli_query($link, "delete from meinerezepte where meinerezepte.rezept_nummer =".$_POST["einrezept_loeschen"]."");
		$_SESSION["rezeptnummer".$_POST["einrezept_loeschen"].""]="";
	}
	
	$antwort = mysqli_query($link, "SELECT * FROM meinerezepte, rezepte WHERE meinerezepte.rezept_nummer = rezepte. rezeptnummer");
	
		echo '<br>
			<div class="container">
			  <div class="row">
				<div class="col"></div>
					<div class="col-8">
						<div class="card" style="max-width: 2500px;">
						  <div class="card-body">
							<h2 style="text-align: center; font-family: Amatic SC, cursive; font-size: 50px">Meine Rezepte</h2><br>
							<div style="">
							
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">Bild</th>
										<th scope="col">Titel</th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>';
									
									if($antwort->{"num_rows"}==0)
									{
										echo "<tr><td>Es sind keine gespeicherten Rezepte vorhanden.<td></tr>";
									}
									else
									{
										while($datensatz = mysqli_fetch_array($antwort))
										{
											echo'<tr>
													<td style="width: 150px;"><img src="bilder/'.$datensatz["bild"].'" style="width: 100px;"/></td>
													<td style="width: 400px;">
														<h5 style="vertical-align: middle;">'.$datensatz["titel"].'</h5>
														<p style="vertical-align: middle;">'.$datensatz["kategorie"].'</p>
													</td>
													<td>
														<a href="?seite=details&rezeptnummer='.$datensatz["rezeptnummer"].'"><button type="submit" class="btn btn-secondary">&nbsp; Details &nbsp;</button></a><br><br>
														<form method="POST">
															<a href="?seite=verwaltung&unterseite=neues_gericht"><button type="submit" name="einrezept_loeschen" value="'.$datensatz["rezeptnummer"].'"class="btn btn-danger">Entfernen</button></a>
														</form>
													</td>
												</tr>';
										}
									}						
		echo					'</tbody>
							</table>
							
							</div>
						  </div>
						</div>
					</div>
				<div class="col"></div>
			  </div>
			 </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; 
}
else
{
	echo '<br><br><br>
		 <div class="container">
		  <div class="row">
			<div class="col">
			</div>
				<div class="col-8">
					<div class="card" style="max-width: 2500px;">
					  <div class="card-body">
						<h1 style="text-align:center; font-size: 40px;"><i class="bi bi-exclamation-triangle"></i> Hinweis</h1><br><br>
						<div class="alert alert-danger" role="alert" style="width:685px;">Um Ihre eigenen Rezepte zu sehen und zu speichern, müssen Sie sich einloggen</div><br>
						<div style="text-align:center;"><a href=?seite=login><button class="btn btn-secondary">Einloggen</button></a></div>
							
					  </div>
					</div>
				</div>
			<div class="col">
			</div>
		  </div>
		 </div><br><br><br><br><br><br><br>
		 <br><br><br><br><br><br><br><br>';
}	
?>
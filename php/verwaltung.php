<h1 style="text-align:center; color: white;"> Adminseite für die Verwaltung von Daten</h1>
<br><br>
<?php
if(isset($_GET["unterseite"]))
{
	switch($_GET["unterseite"])
	{
		case "neues_gericht":		include("neues_gericht.php"); 		break;
		case "gericht_bearbeiten":	include("gericht_bearbeiten.php");	break;
		case "gericht_loeschen":	include("gericht_loeschen.php");	break;
	}
}
else
{
	include("verwaltungsuebersicht.php");
}

?>
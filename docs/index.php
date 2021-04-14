<?php

session_start();

# Datenbankverbindung
#---------------------------------------------------------------------------------------------
$link = mysqli_connect("localhost",	"root", 	"", 		"gastro_latino");
mysqli_query($link, "SET names utf8"); # Verbindung auf utf-8 umstellen
#---------------------------------------------------------------------------------------------

if(isset($_GET["seite"]) && $_GET["seite"]=="logout")
{
	session_destroy();
	unset($_SESSION);
	setcookie("login_merken", "", time() -1); # cookie entfernen beim Client
	unset($_COOKIE["login_merken"]); #cookie aus dem Server RAM löschen
}

if(isset($_POST["benutzer"]) && isset($_POST["kennwort"]))
{
	if($_POST["benutzer"]=="max" && $_POST["kennwort"]=="mustermann")
	{
		$_SESSION["eingeloggt"] = true;
		$_SESSION["benutzer"] = "Max Mustermann";
		$_SESSION["mitteilung"] = "<div style='color:green'>Erfolgreich eingeloggt</div>";
		
		
		//gespeicherte Rezepte (meinerezepte)
		$antwort = mysqli_query($link, "SELECT * FROM meinerezepte, rezepte WHERE meinerezepte.rezept_nummer = rezepte. rezeptnummer");
		while($datensatz = mysqli_fetch_array($antwort))
		{
			$_SESSION["rezeptnummer".$datensatz["rezept_nummer"].""] = $datensatz["rezept_nummer"];
		}
				
		if(isset($_POST["merken"]))
		{
			setcookie("login_merken", "Max Mustermann", time() + 60*60*24*365);
		}
		# Kopfzeilen ändern
		header("Location: ?seite=verwaltung"); # Weiterleiten zur Verwaltung
		exit; # PHP- Programm Ende
	}
	else
	{
		$_SESSION["mitteilung"] = "<div style='color:red'>Falsche Eingabe</div>";
	}
}
#Wenn der cookie da ist
if(isset($_COOKIE["login_merken"]))
{
	$_SESSION["eingeloggt"]=true;
	$_SESSION["benutzer"]="Max Mustermann";
}
?>

<html>
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
	<div class = "container-fluid pl-0 pr-0" style="background-image: url('bilder/header.png'); opacity:0.9;">
		<div class= "row">
			<div class="col-10 pr-0">
			
				<h1 class="p-4 mb-0 text-white" style= "font-family: 'Amatic SC', cursive; font-size: 60px;">
				<img src="bilder/cutlery.png" style="width: 50px;" />
				Gastro<span style="color: white">-Latina</span>
				</h1>
				<!-- style="background-color: #f28b0d" -->
			</div>
			<div class="col-2 pl-5 mb-0 text-white d-flex align-items-center">
				<span clas="box" style="padding-left: 19%;">
					<?php
				if(isset($_SESSION["eingeloggt"]))
					{
						echo '<p style= "font-family: Amatic SC, cursive; font-size: 30px">'.$_SESSION["benutzer"].'</p>';
					}
				?>
				</span>
			</div>
		</div>	
	</div>
	
<head>
<meta charset="utf-8" />	
<!-- <link rel="stylesheet" href="css/style.css" />	-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="css/styling.css" />

</head>
	<?php
	
	if(@$_GET["seite"]=="start" || @$_GET["seite"]=="logout" || @$_GET["seite"]=="" || @$_GET["seite"]=="login")
	{
		$bg_bild = "background-image: url('bilder/orangebgdunkel.png'); ";
	}
	else if(@$_GET["seite"]=="verwaltung")
	{
		$bg_bild = "background-image: url('bilder/orangebw.png'); ";
	}
	else
	{
		$bg_bild = "";
	}
	?>
<body style="opacity:0.9; background-color: #ffe0b3; color:#333333; <?= $bg_bild?> ">
<header>
<div class = "container-fluid pl-0 pr-0">
	<div class= "row">
			<div class="col-11 pr-0">
				<nav class="nav shadow pl-4 mb-5" style="opacity:0.9; background-color: #f28b0d;">
					<!-- Navbar content -->
					<div class="nav-link"><a href="?seite=start" style= "font-family: 'Amatic SC', cursive; font-size: 25px; color: white;">Start</a></div>
					<div class="nav-link"><a href="?seite=gerichte" style= "font-family: 'Amatic SC', cursive; font-size: 25px; color: white;">Gerichte</a></div>
					<div class="nav-link"><a href="?seite=meinerezepte"  style= "font-family: 'Amatic SC', cursive; font-size: 25px; color: white;">Meine Rezepte</a></div>
					<?php
							if(isset($_SESSION["eingeloggt"]))
							{
								echo '<div class="nav-link"><a href="?seite=verwaltung" style= "font-family: Amatic SC, cursive; font-size: 25px; color: white;">Verwaltung</a></div>';
							}
					?>
				</nav>
			</div>
			<div class="col-1 pr-0 pl-0">
				<nav class="nav navbar-dark shadow p-0 mb-5" style="opacity:0.9; background-color: #f28b0d;">
					<?php
						if(isset($_SESSION["eingeloggt"]))
						{
							echo '<div class="nav-link"><a href="?seite=logout" style= "font-family: Amatic SC, cursive; font-size: 25px; color: white;"><i class="bi bi-person"></i> Logout</a></div>';
						}
						else
						{
							echo '<div class="nav-link"><a href="?seite=login" style= "font-family: Amatic SC, cursive; font-size: 25px; color: white;"><i class="bi bi-person"></i> Login</a></div>';
						}
					?>
				</nav>
			</div>
	</div>	
</div>
</header>

<main>
<?php
if(isset($_SESSION["mitteilung"]))
{
	//echo '<script> alert("Falsche Eingabe")</script>';
	//echo $_SESSION["mitteilung"]; //Anzeigen
	//unset ($_SESSION["mitteilung"]);	//Entfernen löschen
}

//Wenn die Seite nicht gesetzt ist
if(!isset($_GET["seite"]))
{
	$_GET["seite"]= "start";
}
//Seiteauswahl
switch($_GET["seite"])
{
	case "start":
		include("html/startseite.html");
	break;
	case "gerichte":
		include("php/gerichte.php");
	break;
	case "meinerezepte":
		include("php/meinerezepte.php");
	break;
	case "login":
		include("html/login.html");
	break;
	case "logout":
		include("html/startseite.html");
	break;
	case "verwaltung":
		if(isset($_SESSION["eingeloggt"]))
		{
			include("php/verwaltung.php");
		}
		else
		{
			header("Location: ?seite=login");
			exit;
		}
		
	break;
	case "details":
			include("php/details.php");		
	break;
	default:
	include("html/404.html");
}
?>

</main>
<footer class="p-3 bg-dark text-white">
Copyright 2021
<br><br><br><br>
</footer>
</body>
</html>
<?php
# Datenbankverbindung trennen
#---------------------------------------------------------------------------------------------
mysqli_close($link);
#---------------------------------------------------------------------------------------------
?>
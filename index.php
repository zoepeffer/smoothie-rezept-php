<?php
session_start();
$seite = $_GET["seite"] ?? "von_uns";

if(isset($_POST["login"]))
{
	$connect = mysqli_connect("localhost","root","","_smoothie_maker");
	$antwort = mysqli_query($connect, "select user_id from user 
	where login='".$_POST["login"]."' 	AND 	passwort=sha1('".$_POST["passwort"]."') ");
	
	// Prüfung ob genau ein Datensatz passt
	if($antwort->num_rows == 1)
	{
		// den eingeloggten Status speichern
		$_SESSION["erfolgreich_eingeloggt"] = true;	
		$daten = mysqli_fetch_array($antwort); 
		$_SESSION["user_id"] = $daten["user_id"]; 
		echo "erfolgreich eingeloggt";
	}
	else
	{
		echo "fehler beim einloggen";
	}
	
	mysqli_close($connect);
}

// Logout durchführen
if(isset($_GET["seite"]) && $_GET["seite"] == "logout")
{
	#session_destroy(); 
	unset($_SESSION["erfolgreich_eingeloggt"]); 
	unset($_SESSION["user_id"]);
}


include("templates/html_oben.php");
switch($seite)
{
	case "logout":
		echo "Sie sind nun abgemeldet";
	break;
	case "von_uns": 
		include("pages/von_uns.php"); # externe Datei einbinden
	break;
	case "smoothie_schreiben": 
		if(isset($_SESSION["erfolgreich_eingeloggt"]))
		{
			include("pages/smoothie_schreiben.php"); # externe Datei einbinden
		}
		
	break;
	
	case "alle_smoothie": 	
		// Prüfe ob Zugriff erlaubt ist
		if(isset($_SESSION["erfolgreich_eingeloggt"]))
		{
			// Speichern
			if(isset($_POST["rezension_id"]))
			{
				// Rezensionaktualisierung
				$connect = mysqli_connect("localhost","root","", "_smoothie_maker");
				mysqli_query($connect, "SET NAMES utf8");
				mysqli_query($connect, "UPDATE rezepte 
										SET rezension = ".$_POST["rezension_id"]." 
										WHERE rezept_id = ".$_POST["rezept_id"]);
										
				// Rezeptrezension abfragen
				$antwort = mysqli_query($connect, "select rezension_beschreibung 
													from rezension where rezension_id =".$_POST["rezension_id"]);	
				$rezensioninfo = mysqli_fetch_array($antwort);	
																
				echo "<h1>Rezensionsänderung gespeichert</h1>";										
				mysqli_close($connect);
			}
			
			// Formular zum Bearbeiten / speichern der Daten
			
			if(isset($_POST["bearbeiten_speichern"]))
			{
				$connect = mysqli_connect("localhost","root","", "_smoothie_maker");
				mysqli_query($connect, "SET NAMES utf8");
				
				$sql = "UPDATE rezepte 
										SET rezept_name = '".$_POST["rezept_name"]."',
											zutaten_list = '".$_POST["zutaten_list"]."',
											rezept_beschreibung = '".$_POST["rezept_beschreibung"]."'
										WHERE rezept_id = '".$_POST["rezept_id"]."'";
				#echo "<h1>$sql</h1>";	
				mysqli_query($connect, $sql);	

				if($connect->affected_rows == 1)	
				{			
					echo "<h1 style='color:green'>Änderungen erfolgreich gespeichert</h1>";
				}
				else
				{
					echo "<h1 style='color:green'>Es gab keine Änderungen</h1>";
					if($connect->error || $connect->affected_rows == -1) # bei Fehler!!!
					{
						echo "<h1 style='color:red'>Es ist ein Fehler aufgetreten. 
						Bitte kontaktieren Sie den Admin!</h1>";
						echo $connect->error."<br />";
						$_GET["rezept_id"] = $_POST["rezept_id"];
						$_GET["modus"] = "bearbeiten";
					}
				}
				mysqli_close($connect);
			}
			
			
			// Formular zum Löschen
			if(isset($_POST["loeschen_bestaetigen"]) && $_POST["loeschen_bestaetigen"] == "JA")
			{
				$connect = mysqli_connect("localhost","root","", "_smoothie_maker");
				mysqli_query($connect, "SET NAMES utf8");	
				if($connect->affected_rows >= 1)	
				{			
					//echo "<h1 style='color:green'>Löschvorgang erfolgreich ausgeführt für die Bearbeitungstabelle</h1>";
				}
				else
				{
				//echo "<h1 style='color:green'>Es gab nichts zu löschen (Bearbeitungstabelle)</h1>";
					if($connect->error || $connect->affected_rows == -1) # bei Fehler!!!
					{
						echo "<h1 style='color:red'>Es ist ein Fehler aufgetreten. Bitte kontaktieren Sie den Admin!</h1>";
						echo $connect->error."<br />";
					}
				}	
				
				$sql = "SELECT * FROM rezepte WHERE rezept_id = '".$_POST["rezept_id"]."'";
				$antwort = mysqli_query($connect, $sql);
				$datensatz = mysqli_fetch_array($antwort);
				$dateiziel = $datensatz["rezeptbild"];
				
				$sql = "DELETE FROM rezepte WHERE rezept_id = '".$_POST["rezept_id"]."'";
				#echo "<h1>$sql</h1>";
				mysqli_query($connect, $sql);
				if($connect->affected_rows == 1)	
				{	
					echo "<h1 style='color:green'>Der Smoothie wurde gelöscht</h1>";
					if(file_exists("uploads/".$dateiziel))
					{
						// Datei entfernen
						unlink("uploads/".$dateiziel); 
						echo "<h1 style='color:green'>Die Datei wurde gelöscht</h1>";					
					}	
				}
				else
				{
					echo "<h1 style='color:green'>Der Smoothie konnte nicht gelöscht werden</h1>";
					if($connect->error || $connect->affected_rows == -1) # 
					{
						echo "<h1 style='color:red'>Es ist ein Fehler aufgetreten. Bitte kontaktieren Sie den Admin!</h1>";
						echo $connect->error."<br />";
					}
				}		
				mysqli_close($connect);			
			}
	
			
			// Prüfe, ob die Rezept_id im Link steht
			if(isset($_GET["rezept_id"]))
			{
				
				if(isset($_GET["modus"]))
				{
					switch($_GET["modus"])
					{
						case "bearbeiten":
							// Bearbeitungsseite
							include("pages/smoothie_bearbeiten.php");		
						break;
						case "loeschen":
							// Löschseite
							include("pages/smoothie_loeschen.php");				
						break;	
						case "anschauen":
							include("pages/smoothie_details.php");
						break;
					}
				}
				else
				{
					echo "Ein Fehler ist aufgetreten: Modus nicht ausgewählt";
				}

				
			}
			else
			{
				include("pages/alle_smoothie.php"); 
			}
		}
	break;
	case "login": 
	include("pages/login.php"); 
	break;
	case "registration": 
		include("pages/registration.php"); 
	break;
	case "smoothies": 
		include("pages/smoothies.php"); 
	break;
	default:
		include("pages/404.php"); 
}
include("templates/html_unten.php");
?>
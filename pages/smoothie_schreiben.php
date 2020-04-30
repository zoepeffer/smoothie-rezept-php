	<br />
	<br />
	<div class="container">
	  <div class="row">
	    <div class="col">
	      <h1>Smoothie schreiben</h1>
	      <h4><em>Neue Smoothie schreiben...</em></h4>
	      <br />
	      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
	        sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
	        sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>

	      <?php
$connect = mysqli_connect("localhost","root","","_smoothie_maker");
mysqli_query($connect, "SET NAMES utf8");

// Formular nur anzeigen, wenn es nicht verschickt wurde
if(!isset($_POST["rezept_name"]))
{
?>

	      <!-- 1. Teil Text -->

	      <form action="" method="post" enctype="multipart/form-data">

	        <label for="rezept_name_label">Smoothie Name</label><br />
	        <textarea class="form-control form-control-sm" name="rezept_name"></textarea>

	        <br />

	        <label for="zutaten_list_label">Zutaten List</label><br />
	        <textarea class="form-control form-control-sm" name="zutaten_list"></textarea>

	        <br />
	        <br />

	        <label for="smoothie_beschreibung_label">Smoothie Beschreibung</label><br />
	        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="rezept_beschreibung"></textarea>

	        <!-- 2. Teil Datei -->

	        <br />
	        <label for="dominierte_zutat_typ">Dominierte Zutat-Typ</label><br />
	        <select class="form-control" name="zutat_typ">

	          <?php
	// Zutat-Typ liste abfragen
	$antwort = mysqli_query($connect, "select * from zutat");
	while($datensatz = mysqli_fetch_array($antwort))
	{
		echo '<option value="'.$datensatz["zutat_id"].'">'
		.$datensatz["zutat_name"].'</option>';
	}
	?>
	        </select>

	        <br />
	        <br />

	        <label for="farbe_label">Farbe?</label><br />
	        <select class="form-control" name="farbe_id">

	          <?php
	$antwort = mysqli_query($connect, "select * from farbe");

	while($datensatz = mysqli_fetch_array($antwort))
	{
		echo '<option value="'.$datensatz["farbe_id"].'">'.$datensatz["farbe_name"].'</option>';
	}
	?>
	        </select>

	        <br />
	        <br />

	        <label for="laktosefrei_label">Ist das laktosefrei?</label><br />
	        <select class="form-control" name="selektion_id">

	          <?php
	$antwort = mysqli_query($connect, "select * from selektion");

	while($datensatz = mysqli_fetch_array($antwort))
	{
		echo '<option value="'.$datensatz["selektion_id"].'">'.$datensatz["selektion_name"].'</option>';
	}
	?>
	        </select>

	        <br />
	        <br />

	        <label for="geschmack_label">Geschmack?</label><br />
	        <select class="form-control" name="geschmack_id">

	          <?php
	$antwort = mysqli_query($connect, "select * from geschmack");

	while($datensatz = mysqli_fetch_array($antwort))
	{
		echo '<option value="'.$datensatz["geschmack_id"].'">'.$datensatz["geschmack_name"].'</option>';
	}
	?>
	        </select>

	        <br /><br />

	        <label for="bild_label">Bilddatei:</label><br />
	        <input type="file" name="rezeptbild1" />

	        <br /><br />

	        <input class="btn btn-light" data-toggle="collapse" type="submit" role="button" aria-expanded="false" aria-controls="collapseExample" />
	      </form>
	    </div>
	  </div>
	</div>
	<?php
} # ende der if abfrage
?>
	<!-- ----------------------------------------------------------- -->
	<?php
// Programm ausführen, wenn das Formular verschickt wurde
if(isset($_POST["rezept_name"]))
{	
	echo "<pre>";
	print_r($_POST); 
	print_r($_FILES); 
	echo "</pre>";

					
	$datei_original = $_FILES["rezeptbild1"]["name"]; // So heißt die Datei in echt	
				
	$datei_tempname = $_FILES["rezeptbild1"]["tmp_name"]; // Wie heißt die Datei auf dem Server?

	$neuer_dateiname = uniqid("smoothiebild_").".png"; // smoothiebild_5dfghac34.png

	// Kopiervorgang von A nach Ziel)
	move_uploaded_file($datei_tempname, "uploads/".$neuer_dateiname);

	$rezension 				= 1;
	$bearbeitung_id			= 1;
	$user_id 				= 4;
	$rezept_name 			= $_POST["rezept_name"];
	$zutaten_list 			= $_POST["zutaten_list"];
	$rezept_beschreibung	= $_POST["rezept_beschreibung"];
	$zutat_typ				= $_POST["zutat_typ"];
	$farbe_id				= $_POST["farbe_id"];
	$selektion_id			= $_POST["selektion_id"]; 
	$geschmack_id			= $_POST["geschmack_id"];
	
	// Zutat abholen
	$sql = "select zutat_name from zutat where zutat_id = $zutat_typ";
	$antwort = mysqli_query($connect, $sql);
	
	$datensatz = mysqli_fetch_array($antwort);	
	print_r($datensatz);
	$zutat_name 				= $datensatz["zutat_name"];
	
	//Farbe abholen
	
	$sql = "select farbe_name from farbe where farbe_id = $farbe_id";
	$antwort = mysqli_query($connect, $sql);
	
	$datensatz = mysqli_fetch_array($antwort);	
	print_r($datensatz);
	$farbe_name 				= $datensatz["farbe_name"];
	
	//Selection abholen
	
	$sql = "select selektion_name from selektion where selektion_id = $selektion_id";
	$antwort = mysqli_query($connect, $sql);
	print_r($datensatz);
	$datensatz = mysqli_fetch_array($antwort);	
	
	$selektion_name 				= $datensatz["selektion_name"];
	
	//Geschmack abholen
	
	$sql = "select geschmack_name from geschmack where geschmack_id = $geschmack_id";
	$antwort = mysqli_query($connect, $sql);
	print_r($datensatz);
	$datensatz = mysqli_fetch_array($antwort);	
	
	$geschmack_name 				= $datensatz["geschmack_name"];
	
	
	// Daten in Tabelle speichern
	$sql = "insert into rezepte 
			(rezension, bearbeitung_id, user_id, rezept_name, zutaten_list, rezept_beschreibung, zutat_typ, farbe_id, selektion_id, geschmack_id, rezeptbild)
			values
			($rezension, $bearbeitung_id, $user_id, '$rezept_name', '$zutaten_list', '$rezept_beschreibung', $zutat_typ, $farbe_id, $selektion_id, $geschmack_id,
			'$neuer_dateiname')";
	
	// Print
	mysqli_query($connect, $sql);	
	
	echo "<h1>Ausgewählte Dominierte Zutat ist</h1>";
	echo $zutat_name;	
	echo "<h1>Ausgewählte Farbe ist</h1>";
	echo $farbe_name;	
	echo "<h1>Smoothie ist laktosefrei?</h1>";
	echo $selektion_name;
	echo "<h1>Ausgewählte Geschmack ist</h1>";
	echo $geschmack_name;
	
	echo "<pre>";
	print_r($connect); // Prüfen ob Fehlertext enthalten ist !!!
	echo "</pre>";		
}
?>

	<?php
mysqli_close($connect);
?>

	<br />
	<br /> <br />
	<br />
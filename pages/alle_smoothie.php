<?php
$connect = mysqli_connect("localhost","root","","_smoothie_maker");
mysqli_query($connect, "SET NAMES utf8");
?>
<table class="table">
  <thead>
    <form action='?seite=alle_smoothie' method='post'>
      <tr>

        <th><input type='text' class="form-control" name='suche_rezeptname' placeholder="Name" value='<?= @$_POST["suche_rezeptname"];?>' /></th>
        <th><input type='submit' class="btn btn-light btn-lg btn-block" /></th>
        <th><input type='reset' class="btn btn-light btn-lg btn-block" /></th>
        <th><button type="submit" class="btn btn-secondary btn-lg btn-block"><a style="color:white" href='?seite=alle_smoothie'>Suche beenden</a></button></th>

      </tr>
    </form>
  </thead>
</table>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>Rezept Name</th>
      <th>Zutaten List</th>
      <th>Beschreibung</th>
      <th></th>
      <th></th>
      <th>Bearbeiten</th>
      <th>Löschen</th>
    </tr>
  </thead>

  <?php

$sql = 	"select * from rezepte LEFT JOIN rezension 
									ON rezepte.rezension = rezension.rezension_id";
$array = array();	
if(isset($_POST["suche_rezeptname"]) && $_POST["suche_rezeptname"] != "")
{
	$array[] = "rezept_name LIKE '%".$_POST["suche_rezeptname"]."%'";
}
if(count($array) > 0)
{
	$string = implode(" AND ", $array);
	$sql .= " WHERE ".$string;
}


$antwort = mysqli_query($connect, $sql);
																		  
while($datensatz = mysqli_fetch_array($antwort))
{
	// Prüfen, ob die Datei vorhanden ist
	if(file_exists('uploads/'.$datensatz["rezeptbild"]))
	{
		$bild = "<img src='uploads/".$datensatz["rezeptbild"]."' height='300' />";
	}
	else
	{
		// $bild = "KEIN BILD"; // nicht vorhanden
		$bild = "<img src='uploads/dummy.png' height='300' />"; // leeres Bild
	}		

	if(isset($_POST["rezept_name"]) && $_POST["rezept_name"] == $datensatz["rezept_name"])
	{
		$auftrag = "<div style='color:red'>".$datensatz["rezept_name"]."</div>";
	}
	else
	{
		$auftrag = "<div style='color:green'>".$datensatz["rezept_name"]."</div>";
	}

	$string = "
				<tr>
					<td >".$datensatz["rezept_name"]."</td>
					<td>".$datensatz["zutaten_list"]."</td>
					<td>".$datensatz["rezept_beschreibung"]."</td>
					<td>$bild</td>
					<td><a href='?seite=alle_smoothie&rezept_id=".$datensatz["rezept_id"]."&modus=anschauen'>Mehr anschauen</a></td>
					<td><a href='?seite=alle_smoothie&rezept_id=".$datensatz["rezept_id"]."&modus=bearbeiten'>Bearbeiten</a></td>
					<td><a href='?seite=alle_smoothie&rezept_id=".$datensatz["rezept_id"]."&modus=loeschen'>Löschen</a></td>
				</tr>";
	echo $string;	
}
?>
</table>
<?php
mysqli_close($connect);
?>
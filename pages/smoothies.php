<?php
$connect = mysqli_connect("localhost","root","","_smoothie_maker");
mysqli_query($connect, "SET NAMES utf8");
?>
<!--Sucher Tabelle-->

<!--Smoothies Tabelle-->
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>Rezept Name</th>
      <th>Zutaten List</th>
      <th>Beschreibung</th>
      <th></th>
      <th></th>
    </tr>
  </thead>

  <?php
// Suchen
$sql = 	"select * from rezepte LEFT JOIN rezension 
									ON rezepte.rezension = rezension.rezension_id";


// Datensatz rausholen Datei
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
// Datensatz rausholen in Tabelle
	if($datensatz["rezension"] == "6")
	{
	$string = "
				<tr>
					<td >".$datensatz["rezept_name"]."</td>
					<td>".$datensatz["zutaten_list"]."</td>
					<td>".$datensatz["rezept_beschreibung"]."</td>
					<td>$bild</td>
				</tr>";
	echo $string;
    }
}
?>
</table>
<?php
mysqli_close($connect);
?>
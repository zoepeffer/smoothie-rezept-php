<div class="container">
<div class="row">
<div class="col">
      <h1 class="display-2">Anschauen </h1>
      <h2>Rezept Details, schmeckt gut? </h2>
      <br />
</div>	
</div>
</div>
<div class="container">
  <div class="row">
    <div class="col">
<?php
$connect = mysqli_connect("localhost","root","","_smoothie_maker");
mysqli_query($connect, "SET NAMES utf8");
$antwort = mysqli_query($connect, "select * from rezepte 
									where rezept_id=".$_GET["rezept_id"]);   
$smoothie = mysqli_fetch_array($antwort);

echo "<a href='?seite=alle_smoothie'>Zurück</a>";
	echo "<br />";


echo "<h2>Rezept Name</h2>";
echo $smoothie["rezept_name"];

echo "<h2>Rezension</h2>";
												
$antwort = mysqli_query($connect, "select * from rezension where rezension_id=".$smoothie["rezension"]);
$rezensioninfo = mysqli_fetch_array($antwort); 
echo $rezensioninfo["rezension_beschreibung"];
echo "<br /><br />";

$ende = $rezensioninfo["ende"]; 

if($ende == 1)
{
	echo "<div style='color:red'>Der Rezension kann nicht mehr geändert werden!</div><br />";
}
else
{
	?>
<form  action="?seite=alle_smoothie" method="post">
  <select class="form-control" name="rezension_id">
    <?php
		// Rezensionen abfragen 
		$antwort = mysqli_query($connect, "
		select rezension_id, rezension_beschreibung, ende 
		from rezension
		where rezension_id > ".$smoothie["rezension"]."
		order by rezension_id"); 
		
		while($rezensionzeile = mysqli_fetch_array($antwort))
		{
			echo '<option value="'.$rezensionzeile["rezension_id"].'">'.$rezensionzeile["rezension_beschreibung"].'</option>';
		}	
		?>
  </select>
  <!-- Rezept Name wird versteckt mitgeschickt -->
  <input type="hidden" name="rezept_id" value="<?php echo $smoothie["rezept_id"];?>"><br />
  <input class="btn btn-light" data-toggle="collapse" type="submit" role="button" aria-expanded="false" aria-controls="collapseExample" value="Ändern" /> <br /><br />     
</form>
<?php
} 


echo "<h2>Zutaten List</h2>";
echo $smoothie["zutaten_list"];


echo "<h2>Zutaten Beschreibung</h2>";
echo $smoothie["rezept_beschreibung"];

								
$antwort = mysqli_query($connect, "select geschmack_name from geschmack where geschmack_id=".$smoothie["geschmack_id"]);
$smoothie_geschmack = mysqli_fetch_array($antwort);  
echo "<h2>Geschmack</h2>";
echo "Geschmack: ".$smoothie_geschmack["geschmack_name"];

$antwort = mysqli_query($connect, "select zutat_name from zutat where zutat_id=".$smoothie["zutat_typ"]);
$smoothie_zutat = mysqli_fetch_array($antwort);  
echo "<h2>Dominierte Zutat</h2>";
echo "Dominierte ist ".$smoothie_zutat["zutat_name"];

?>    </div>
    <div class="col">
	<br />
<?php
	echo "<br />";	
echo "<img src='uploads/".$smoothie["rezeptbild"]."' width='300' />";
	echo "<br />";	
		echo "<br />";	
echo "<h2>Bearbeitung</h2>";

														
$antwort = mysqli_query($connect, "select * from bearbeitung 
									where bearbeitung_id = ".$smoothie['bearbeitung_id']."
									order by datum desc");
while($datensatz = mysqli_fetch_array($antwort))
{
	echo $datensatz["datum"]. " | ";
	echo $datensatz["art_bearbeitung"];
	echo "<br />";
}	

	
mysqli_close($connect);
?>
    </div>
  </div>


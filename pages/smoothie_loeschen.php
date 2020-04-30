	<br />
	<br />
	<div class="container">
	  <div class="row">
	    <div class="col">
	      <h1 class="display-2">Löschen </h1>
	      <h2>gibt es nicht mehr</h2>
	      <br />

	      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
	        sed diam voluptua.Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
	        sed diam voluptua.Lorem ipsum dolor sit amet.</p>

	    </div>
	    <div class="col">
	      <br /> <br />
	      <br />
	      <br />
	      <br />
	      <?php
$connect = mysqli_connect("localhost","root","","_smoothie_maker");
mysqli_query($connect, "SET NAMES utf8");

// Einen Smoothie abfragen
$antwort = mysqli_query($connect, "select * from rezepte where rezept_id=".$_GET["rezept_id"]); 
$smoothie = mysqli_fetch_array($antwort);

echo "<a href='?seite=alle_smoothie'>Zurück</a>";

echo "<h1>Löschen</h1>";

echo "<h2>Rezept Name</h2>";
echo $smoothie["rezept_name"];

echo "<h2>Rezept Datum</h2>";
echo $smoothie["rezeptdatum"];
?>

	      <form action='?seite=alle_smoothie' method='post'>
	        <h1>Wollen Sie wirklich löschen?</h1>
	        <input class="btn btn-light" data-toggle="collapse" type="submit" role="button" aria-expanded="false" aria-controls="collapseExample" value='JA' name='loeschen_bestaetigen' />
	        <input class="btn btn-dark" data-toggle="collapse" type="submit" role="button" aria-expanded="false" aria-controls="collapseExample" value='NEIN' name='loeschen_bestaetigen' />
	        <input type='hidden' name='rezept_id' value='<?= $smoothie["rezept_id"];?>' />
	      </form>

	      <?php
mysqli_close($connect);
?>

	    </div>
	  </div>
	  <br />
	  <br />
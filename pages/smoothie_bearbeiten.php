<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="display-2">Bearbeiten </h1>
      <h2>Rezept ändern</h2>
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

// Einen Smoothie abfragen
$antwort = mysqli_query($connect, "select * from rezepte where rezept_id=".$_GET["rezept_id"]); 
$smoothie = mysqli_fetch_array($antwort);


echo "<a href='?seite=alle_smoothie'>Zurück</a>";


echo "<h2>Rezept Name</h2>";
echo $smoothie["rezept_name"];

echo "<h2>Rezept Datum</h2>";
echo $smoothie["rezeptdatum"];


?>

    </div>
    <div class="col">
      <br />

      <form action="?seite=alle_smoothie" method="post">

        <label for="smoothie_beschreibung_label">Rezept Name</label><br />
        <input class="form-control" type="text" name="rezept_name" value="<?= $smoothie["rezept_name"]; ?>" /><br />

        <label for="smoothie_beschreibung_label">Zutaten List</label><br />
        <textarea class="form-control" id="exampleFormControlTextarea1" name="zutaten_list"><?= $smoothie["zutaten_list"]; ?></textarea><br />

        <label for="smoothie_beschreibung_label">Rezept Beschreibung:</label><br />
        <textarea class="form-control" id="exampleFormControlTextarea1" name="rezept_beschreibung"><?= $smoothie["rezept_beschreibung"]; ?></textarea><br />

        <!-- Für die Zuordnung -->
        <input type="hidden" name="rezept_id" value="<?= $smoothie["rezept_id"]; ?>" />
        <input value="Speichern" name="bearbeiten_speichern" class="btn btn-light" data-toggle="collapse" type="submit" role="button" aria-expanded="false" aria-controls="collapseExample" />
        <input name="bearbeiten_speichern" class="btn btn-dark" data-toggle="collapse" type="reset" value="Zurücksetzen" role="button" aria-expanded="false" aria-controls="collapseExample" />
      </form>
      <?php
mysqli_close($connect);
?>

    </div>
  </div>